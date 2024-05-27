<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

use Illuminate\Database\Eloquent\SoftDeletes;
class Cousre extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'course_name',
    ];
    public function specializations(): hasMany
    {
        return $this->hasMany(specializations::class);
    }
    public function university(): BelongsTo
    {
        return $this->BelongsTo(University::class);
    }
}
