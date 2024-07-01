<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',  // INWARD/OUTWARD
        'form_type', // ASSOCIATE/UNIVERSITY/DIRECT
        'associate_id', // Foreign key for associate
        'university_id', // Foreign key for university
        'direct_data', // Direct data input
        'particular_details', // PARTICULAR DETAILS
        'courier_type', // COURIER/SPEED POST/ BY HAND
        'tracking_no', // TRACKING NO.
        'delivery_status', // Delivered/ undelivered
        'remarks', // REMARKS
    ];
}
