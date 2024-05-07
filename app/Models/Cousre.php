<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Cousre extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name',
    ];
    public function specializations(): hasMany
    {
        return $this->hasMany(specializations::class,'course_id','id');
    }
}
