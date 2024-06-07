<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class admission_session extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function university(): BelongsTo
    {
        return $this->BelongsTo(University::class,'university_id','id');
    }
    public function student(): hasMany
    {
        return $this->hasMany(Students::class,'session_id','id');
    }
}
