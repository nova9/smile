{{-- Lawyer Organization Verification Details --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Organization Details</h1>
    {{-- Organization details and verification actions go here --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Organization Name</h5>
            <p class="card-text">Organization details will be displayed here.</p>
            <form class="mt-3">
                <button type="submit" class="btn btn-success me-2">Approve</button>
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        </div>
    </div>
</div>
@endsection
