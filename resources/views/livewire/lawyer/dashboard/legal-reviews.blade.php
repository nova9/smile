<x-lawyer.dashboard-layout>
    <div class="container">
        <h1 class="mb-4">Activities Needing Legal Review</h1>

        {{-- Check if there are any activities --}}
        @if($activities->isEmpty())
            <div class="card">
                <div class="card-body">
                    <p>No activities pending legal review.</p>
                </div>
            </div>
        @else
            @foreach($activities as $activity)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $activity->title }}</h5>
                        <p class="card-text">{{ $activity->description }}</p>

                        <form method="POST" action="{{ route('lawyer.review', $activity->id) }}">
                            @csrf
                            @method('PATCH')

                            <button type="submit" name="action" value="approve" class="btn btn-success me-2">Approve</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-lawyer.dashboard-layout>
