<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Cousre;

class Programme extends Model
{
    use HasFactory;
    protected $fillable = [
        'programme_name',
       
    ];

    public function cousre(): HasMany
    {
        return $this->hasMany(Cousre::class,'programmes_id','id');
    }

}
