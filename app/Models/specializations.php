<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

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
}
