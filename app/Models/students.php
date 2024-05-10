<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\University;
class students extends Model
{
    protected $fillable = [
        'UNIVERSITY',
        'ASSOCIATE',
        'SOURCE',
        'SR NO',
        'UNI. REG NO.',
        'PASSWORD',
        'NAME',
        'FATHER NAME',
        'MOTHER NAME',
        'DOB',
        'AADHAR NO',
        'EMAIL ID',
        'ADDRESS',
        'MOB NO',
        'COURSE',
        'SPL',
        'TYPE',
        'SEM/YEAR',
        'SESSION',
        'PREVIOUS MIGRATION',
        'FEE',
        'EXAM STATUS',
        'PROJECT STATUS',
        'UNI. VISIT DATE',
        'PASS/BACK',
        'MARKSHEET 1ST SEM',
        'MARKSHEET 2ND SEM',
        'MARKSHEET 3RD SEM',
        'MARKSHEET 4TH SEM',
        'MARKSHEET 5TH SEM',
        'MARKSHEET 6TH SEM',
        'MARKSHEET 8TH SEM',
        'PROVISIONAL/DIPLOMA/DEGREE',
        'ADDITIONAL DOCS',
        'ADDITIONAL REMARKS',
        'NC',
    ];
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
           

            public function scopesearch($query,$value){
                $query->where('NAME', 'like', '%{$value}%');
            }
    
}
