<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cousre extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name',
    ];
    public function specializations(): BelongsTo
    {
        return $this->BelongsTo(specializations::class,'course_id','id');
    }
    public function university(): BelongsTo
    {
        return $this->BelongsTo(University::class,'university_id','id');
    }
}
