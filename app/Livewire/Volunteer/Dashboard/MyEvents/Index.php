<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Category;
use App\Models\Event;
use App\Models\Favourites;
use App\Models\ContractRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Url;

class Index extends Component
{
    public $participatingEvents;
    public $favouriteEvents;
    public $totalEvents;
    public $confirmedEvents;
    public $pendingEvents;
    public $completedEvents;
    public $cancelledEvents;
    public $statusFilter = '';
    public $categories;
    public $categoryFilter = '';
    public $favouriteEventsFilter = false;
    public $search = '';

    public function mount()
    {
        $this->loadEvents();
    }

    public function updatedStatusFilter()
    {
        $this->loadEvents();
    }
    public function updatedCategoryFilter()
    {
        $this->loadEvents();
    }
    public function updatedFavouriteEventsFilter()
    {
        $this->loadEvents();
    }

    public function updatedSearch()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->favouriteEvents = Favourites::where('user_id', auth()->id())->get();
        // Load events with contractRequests relationship
        $query = auth()->user()->participatingEvents()
            ->with(['contractRequests' => function ($q) {
                $q->where('status', 'approved')->whereNotNull('signed_at')->with('agreement');
            }, 'user'])
            ->orderBy('created_at', 'desc');
        $this->totalEvents = $query->count();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('events.name', 'like', '%' . $this->search . '%')
                    ->orWhere('events.description', 'like', '%' . $this->search . '%')
                    ->orWhere('events.notes', 'like', '%' . $this->search . '%');
            });
        }
    
    
        if (!empty($this->statusFilter)) {
            $query->wherePivot('status', $this->statusFilter);
        }
        if (!empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }
        if ($this->favouriteEventsFilter) {
            $query->whereIn('events.id', $this->favouriteEvents->pluck('event_id'));
        }
        $this->participatingEvents = $query->get();
        $this->confirmedEvents = auth()->user()->participatingEvents()
            ->wherePivot('status', 'accepted')
            ->wherePivot('ends_at', null)
            ->get();

        $this->completedEvents = auth()->user()->participatingEvents()
            ->wherePivot('status', 'completed')
            ->get();
        $this->pendingEvents = auth()->user()->participatingEvents()
            ->wherePivot('status', 'pending')
            ->get();
        $this->cancelledEvents = auth()->user()
            ->participatingEvents()
            ->wherePivot('status', 'rejected')
            ->get();


        $this->categories = Category::all();
        //    dd($this->participatingEvents);
    }

    /**
     * Download contract as PDF for volunteer
     */
    public function downloadContract($eventId)
    {
        // Find the contract directly - this prevents null errors
        $contract = ContractRequest::whereHas('event', function ($q) use ($eventId) {
            $q->where('id', $eventId);
        })
            ->where('status', 'approved')
            ->whereNotNull('signed_at')
            ->with(['event.category', 'requester', 'agreement', 'lawyer'])
            ->first();

        if (!$contract) {
            session()->flash('error', 'No signed contract found for this event.');
            return;
        }

        $event = $contract->event;
        $volunteer = Auth::user();

        // Prepare volunteer data
        $volunteerData = [
            'name' => $volunteer->name,
            'email' => $volunteer->email,
            'phone' => $volunteer->getCustomAttribute('contact_number') ?? 'N/A',
            'address' => $this->formatVolunteerAddress($volunteer),
        ];

        // Get requester/organization details from contract
        $requesterDetails = $contract->requester_details;
        $organization = $requesterDetails['organization'] ?? $contract->requester->name;
        $contact = $requesterDetails['phone'] ?? 'N/A';
        $email = $requesterDetails['email'] ?? $contract->requester->email;
        $address = $requesterDetails['address'] ?? 'N/A';
        $terms = $contract->customized_terms ?? $contract->agreement->terms;
        $signatureUrl = $contract->signature_path ? Storage::url($contract->signature_path) : null;

        // Generate PDF
        $pdf = Pdf::loadView('pdfs.volunteer-contract', compact(
            'contract',
            'event',
            'volunteer',
            'volunteerData',
            'organization',
            'contact',
            'email',
            'address',
            'terms',
            'signatureUrl'
        ));

        // Generate filename
        $filename = 'Contract_' . $contract->agreement->topic . '_' . $event->name . '_' . $volunteer->name . '.pdf';
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $filename);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    /**
     * Format volunteer address
     */
    private function formatVolunteerAddress($user)
    {
        $city = $user->getCustomAttribute('city');

        if ($city) {
            return $city;
        }

        $lat = $user->getCustomAttribute('latitude');
        $lng = $user->getCustomAttribute('longitude');

        if ($lat && $lng) {
            return "Coordinates: {$lat}, {$lng}";
        }

        return 'N/A';
    }


    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.index');
    }
}
