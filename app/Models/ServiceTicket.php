<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTicket extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_name',
        'service_type',
        'appointment_datetime',
        'contact_number',
        'description',
        'ticket_number',
        'status',
    ];

}

