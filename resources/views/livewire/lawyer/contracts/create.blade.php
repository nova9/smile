{{-- Lawyer Draft Contract --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Draft New Contract</h1>
    {{-- Contract draft form goes here --}}
    <div class="card">
        <div class="card-body">
            <form>
                {{-- Form fields for contract drafting --}}
                <div class="mb-3">
                    <label for="volunteer" class="form-label">Volunteer</label>
                    <input type="text" class="form-control" id="volunteer" placeholder="Volunteer Name">
                </div>
                <div class="mb-3">
                    <label for="requestor" class="form-label">Requestor</label>
                    <input type="text" class="form-control" id="requestor" placeholder="Requestor Name">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contract Content</label>
                    <textarea class="form-control" id="content" rows="6" placeholder="Enter contract details..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Draft Contract</button>
            </form>
        </div>
    </div>
</div>
@endsection
