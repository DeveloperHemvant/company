<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class specializations extends Model
{
    use HasFactory;
    protected $fillable = [
        'specialization_name',
        'course_id'
    ];
    public function cousre(): belongsTo
    {
        return $this->belongsTo(Cousre::class,'course_id','id');
    }
    public function students():hasMany
    {
        return $this->hasMany(Students::class);
    }
}
