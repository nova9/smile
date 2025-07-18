<x-requester.dashboard-layout>
    <h2>Requester Dashboard</h2>
    <div>
        <strong>Total Events:</strong> {{ $totalEvents }}<br>
        <strong>Active Events:</strong> {{ $activeEvents }}<br>
        <strong>Pending Applications:</strong> {{ $pendingApplications }}
    </div>
    <hr>
    <a href="{{ route('requester.events') }}">My Events</a> |
    <a href="{{ route('requester.create-event') }}">Create Event</a> |
    <a href="{{ route('requester.applicants') }}">Applicants</a> |
    <a href="{{ route('requester.feedback') }}">Feedback</a> |
    <a href="{{ route('requester.profile') }}">Profile</a>

</x-requester.dashboard-layout>



