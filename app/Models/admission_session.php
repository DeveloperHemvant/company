<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class admission_session extends Model
{
    use HasFactory;
    public function university(): BelongsTo
    {
        return $this->BelongsTo(University::class,'university_id','id');
    }
}
