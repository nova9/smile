<div>
    <h3>My Events</h3>
    <a href="{{ route('requester.create-event') }}">Create New Event</a>
    <ul>
        @forelse($events as $event)
            <li>
                <strong>{{ $event->title }}</strong> ({{ ucfirst($event->status) }})
                <a href="{{ route('requester.event.show', $event->id) }}">View</a>
            </li>
        @empty
            <li>No events found.</li>
        @endforelse
    </ul>
</div>
