<div>
    <h3>Profile</h3>
    @if(session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="update">
        <label>Name:</label>
        <input type="text" wire:model="name"><br>
        <label>Email:</label>
        <input type="email" wire:model="email"><br>
        <button type="submit">Update Profile</button>
    </form>
</div>
