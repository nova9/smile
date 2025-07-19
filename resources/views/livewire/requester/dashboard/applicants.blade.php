<div>
    <h3>Applicants</h3>
    <ul>
        @forelse($applicants as $application)
            <li>
                {{ $application->user->name }} applied for "{{ $application->event->title }}"
                (Status: {{ ucfirst($application->status) }})
            </li>
        @empty
            <li>No applicants yet.</li>
        @endforelse
    </ul>
</div>
