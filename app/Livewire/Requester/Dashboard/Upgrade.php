<?php

namespace App\Livewire\Requester\Dashboard;

use App\Services\FileManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upgrade extends Component
{
    use WithFileUploads;

    public $logo;
    public $name;
    public $website = 'http://';

    public $cardNumber;
    public $expiryDate;
    public $cvc;
    public $cardholderName;

    public function rules()
    {
        return [
            'logo' => 'required|image|max:2048', // Max 2MB
            'name' => 'required|string|max:255',
            'website' => 'required|url|max:255',

            'cardNumber' => 'required|digits_between:13,19',
            'expiryDate' => 'required|date_format:m/y|after_or_equal:today',
            'cvc' => 'required|digits_between:3,4',
            'cardholderName' => 'required|string|max:255',
        ];
    }

    public function pay()
    {
        // This is a dummy validation function. Replace with real payment gateway integration.
        if ($this->cardNumber === '4242424242424242' && $this->cvc === '123') {
            return true;
        }
        return false;
    }

    public function upgrade()
    {
        $this->validate();

        $isSuccessful = $this->pay();
        if (!$isSuccessful) {
            $this->addError('payment', 'Payment failed. Please check your card details and try again.');
            return;
        }

        $logoFile = FileManager::store($this->logo);

        auth()->user()->upgrade()->create([
            'organization_name' => $this->name,
            'organization_website' => $this->website,
            'logo_file_id' => $logoFile->id,
        ]);

        session()->flash('success', 'Your account has been upgraded successfully!');
        return redirect('/requester/dashboard/profile');
    }


    public function render()
    {
        return view('livewire.requester.dashboard.upgrade');
    }
}
