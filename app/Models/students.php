<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\University;
class students extends Model
{
    use HasFactory;

    //relation with university
            Public function university():BelongsTo
			{
                    return $this->BelongsTo(University::class,'UNIVERSITY','id');
            }
            Public function associate():BelongsTo
			{
                    return $this->BelongsTo(Associate::class,'ASSOCIATE','id');
            }
            Public function course():BelongsTo
			{
                    return $this->BelongsTo(Cousre::class,'COURSE','id');
            }
            Public function session():BelongsTo
			{
                    return $this->BelongsTo(admission_session::class,'SESSION','id');
            }
           


    
}
