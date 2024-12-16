<?php

namespace App\Http\Controllers;

use App\Models\ServiceTicket;
use Illuminate\Http\Request;

class ServiceTicketController extends Controller
{

    public function create()
    {
        return view('service-tickets.create');
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'service_type' => 'required|string|in:Electrical,Plumbing,HVAC',
            'appointment_datetime' => 'required|date|after:now',
            'contact_number' => 'required|regex:/^[0-9]{10}$/',
            'description' => 'nullable|string',
        ]);


        $validatedData['ticket_number'] = 'TICKET-' . strtoupper(uniqid());
        $validatedData['status'] = 'open';


        ServiceTicket::create($validatedData);

        return redirect()->route('service-tickets.index')->with('success', 'Service ticket created successfully!');
    }


    public function index(Request $request)
    {

        $status = $request->input('status');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $search = $request->input('search');
        $query = ServiceTicket::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($start_date && $end_date) {
            $query->whereBetween('appointment_datetime', [$start_date, $end_date]);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%$search%")
                    ->orWhere('ticket_number', 'like', "%$search%");
            });
        }

        $tickets = $query->paginate(10);

        return view('service-tickets.index', compact('tickets'));
    }
}
