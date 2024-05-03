<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'university_name',
        'university_code'
        // Add more columns here as needed
    ];
    public function admissionsesssion()
    {
        return $this->hasMany(admission_session::class,'u_id','id');
    }
}
