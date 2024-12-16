<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Tickets</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Service Tickets</h2>

        <!-- Filter and Search Form -->
        <form method="GET" action="{{ route('service-tickets.index') }}" class="mb-4">
            <div class="row">
                <!-- Status Filter -->
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Filter by Status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Date Range Filter -->
                <div class="col-md-3">
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Start Date">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="End Date">
                </div>

                <!-- Search Field -->
                <div class="col-md-3 mt-3 mt-md-0">
                    <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search by Customer Name or Ticket Number">
                </div>
            </div>

            <div class="row mt-3">
                <!-- Filter and Reset Buttons -->
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('service-tickets.index') }}" class="btn btn-secondary w-100">Reset Filters</a>
                </div>
            </div>
        </form>

        <!-- Tickets Table -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered table-responsive">
                    <thead class="table-dark">
                        <tr>
                            <th>Ticket Number</th>
                            <th>Customer Name</th>
                            <th>Service Type</th>
                            <th>Appointment Date and Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->ticket_number }}</td>
                                <td>{{ $ticket->customer_name }}</td>
                                <td>{{ $ticket->service_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($ticket->appointment_datetime)->format('Y-m-d H:i') }}</td>
                                <td>
                                    <span class="badge {{ $ticket->status == 'open' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    <a href="{{ route('service-tickets.create') }}" class="btn btn-primary btn-sm">Add</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $tickets->links() }}
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
