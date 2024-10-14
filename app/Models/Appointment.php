<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['doctors_name', 'name',  'visiting_place',
     'fee', 'day', 'time', 'payment_method', 'appointment_key'];

}
