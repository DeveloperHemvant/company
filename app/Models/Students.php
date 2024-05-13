<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Students extends Model
{
    use HasFactory;
    // Public function university():BelongsTo
    // {
    //         return $this->BelongsTo(University::class,'university','id');
    // }
    Public function associate():BelongsTo
    {
            return $this->BelongsTo(Associate::class,'associate','id');
    }
    Public function course():BelongsTo
    {
            return $this->BelongsTo(Cousre::class,'course','id');
    }
    Public function session():BelongsTo
    {
            return $this->BelongsTo(admission_session::class,'session','id');
    }
    public function university(): BelongsTo
    {
        return $this->BelongsTo(University::class,'university','id');
    }
}
