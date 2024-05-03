<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Programme;
class Cousre extends Model
{
    use HasFactory;
    public function programmes(): BelongsTo
    {
        return $this->belongsTo(Programme::class,'programmes_id','id');
    }
}
