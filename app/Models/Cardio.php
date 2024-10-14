<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'degree', 'city',
    'visiting_place',  'day', 'time'];
}
