<div>
    <h3>Create New Event</h3>
    @if(session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="create">
        <label>Title:</label>
        <input type="text" wire:model="title"><br>
        <label>Description:</label>
        <textarea wire:model="description"></textarea><br>
        <label>Date:</label>
        <input type="date" wire:model="date"><br>
        <button type="submit">Create Event</button>
    </form>
</div>
