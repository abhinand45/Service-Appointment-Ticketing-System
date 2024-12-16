<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceTicketApiController extends Controller
{
    // Create a new service ticket
    public function store(Request $request)
    {

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'service_type' => 'required|string|in:Electrical,Plumbing,HVAC',
            'appointment_datetime' => 'required|date|after:now',
            'contact_number' => 'required|regex:/^[0-9]{10}$/',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        // Create the service ticket
        $ticket = ServiceTicket::create([
            'customer_name' => $request->customer_name,
            'service_type' => $request->service_type,
            'appointment_datetime' => $request->appointment_datetime,
            'contact_number' => $request->contact_number,
            'description' => $request->description,
            'ticket_number' => 'TICKET-' . strtoupper(uniqid()),
            'status' => 'open',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Service ticket created successfully!',
            'data' => $ticket
        ], 201);
    }

    // Get all service tickets (with optional filters)
    public function index(Request $request)
    {
        // $status = $request->input('status');
        // $start_date = $request->input('start_date');
        // $end_date = $request->input('end_date');
        // $search = $request->input('search');

        // $query = ServiceTicket::query();

        // if ($status) {
        //     $query->where('status', $status);
        // }

        // if ($start_date && $end_date) {
        //     $query->whereBetween('appointment_datetime', [
        //         \Carbon\Carbon::parse($start_date)->startOfDay(),
        //         \Carbon\Carbon::parse($end_date)->endOfDay(),
        //     ]);
        // }

        // if ($search) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('customer_name', 'like', "%$search%")
        //           ->orWhere('ticket_number', 'like', "%$search%");
        //     });
        // }

        // $tickets = $query->paginate(10);
        $tickets = ServiceTicket::paginate(10);


        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ], 200);
    }




    // Show a specific service ticket by ID
    public function show($id)
    {
        $ticket = ServiceTicket::find($id);

        if (!$ticket) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service ticket not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $ticket
        ], 200);
    }

    // Update a specific service ticket by ID

    public function update(Request $request ,$id)
    {

       
        $ticket = ServiceTicket::find($id);

        if (!$ticket) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service ticket not found'
            ], 404);
        }

        // Validate the incoming request
       $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'service_type' => 'required|string|in:Electrical,Plumbing,HVAC',
            'appointment_datetime' => 'required|date|after:now',
            'contact_number' => 'required|regex:/^[0-9]{10}$/',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        // Update the ticket with validated data
        $ticket->update([
            'customer_name' => $request->customer_name,
            'service_type' => $request->service_type,
            'appointment_datetime' => $request->appointment_datetime,
            'contact_number' => $request->contact_number,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Service ticket updated successfully!',
            'data' => $ticket
        ], 200);
    }

    // Delete a specific service ticket by ID
    public function destroy($id)
    {
        $ticket = ServiceTicket::find($id);

        if (!$ticket) {
            return response()->json([
                'status' => 'error',
                'message' => 'Service ticket not found'
            ], 404);
        }

        $ticket->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Service ticket deleted successfully!'
        ], 200);
    }
}
