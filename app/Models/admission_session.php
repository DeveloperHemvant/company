<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class admission_session extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_name',
        'month',
        'year',
        'university_id'
    ];
    public function university(): BelongsTo
{
    return $this->belongsTo(University::class, 'u_id','id');
}
}
