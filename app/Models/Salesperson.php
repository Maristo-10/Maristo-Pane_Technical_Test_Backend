<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    protected $table = "salespersons";
    protected $fillable = [
        'name',
        'type',
        'is_penalized',
        'last_assigned',
        'penalty_start',
        'penalty_end',
    ];
}
