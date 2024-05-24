<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class University extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'university_name',
        'university_code'
        // Add more columns here as needed
    ];
    // public function post(): BelongsTo
    // {
    //     return $this->belongsTo(Students::class,'university','id');
    // }
    public function courses():hasMany
    {
        return $this->hasMany(Cousre::class,'university_id','id');
    }
    public function students():hasMany
    {
        return $this->hasMany(Students::class,'university_id','id');
    }

    public function admissionSessions():hasMany
    {
        return $this->hasMany(admission_session::class,'university_id','id');
    }
    
}
