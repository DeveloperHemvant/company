<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class specializations extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'specialization_name',
        'course_id'
    ];
    public function cousre(): belongsTo
    {
        return $this->belongsTo(Cousre::class);
    }
    public function students():hasMany
    {
        return $this->hasMany(Students::class,'specialization_id');
    }
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
