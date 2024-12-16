@extends('layouts.app')

@section('title', 'Create Service Ticket')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Create Service Ticket</h1>
        <form action="{{ route('service-tickets.store') }}" method="POST" class="p-3 border rounded">
            @csrf
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" id="customer_name" name="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="service_type" class="form-label">Service Type</label>
                <select id="service_type" name="service_type" class="form-select" required>
                    <option value="Electrical">Electrical</option>
                    <option value="Plumbing">Plumbing</option>
                    <option value="HVAC">HVAC</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="appointment_datetime" class="form-label">Appointment Date & Time</label>
                <input type="datetime-local" id="appointment_datetime" name="appointment_datetime" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description of the Issue</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Create Ticket</button>
            </div>
        </form>
    </div>
</div>
@endsection
