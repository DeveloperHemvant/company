<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parentcontact extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_full_name',
        
        'parent_email',
        'parent_mobile',
        'student_name',
        'has_laptop',
    ];
}
