<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'university_name',
        'university_code'
        // Add more columns here as needed
    ];
    public function post(): BelongsTo
    {
        return $this->belongsTo(students::class,'UNIVERSITY','id');
    }

    
}
