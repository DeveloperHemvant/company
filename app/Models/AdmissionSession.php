<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_name',
        'month',
        'year',
        'university_id'
    ];
}
