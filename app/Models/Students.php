<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Students extends Model
{
        protected $fillable = [
                'id',
                'university',
                'source',
                'associate',
                'sr_no',
                'uni_reg_no',
                'password',
                'name',
                'father_name',
                'mother_name',
                'dob',
                'aadhar_no',
                'email_id',
                'mob_no',
                'address',
                'course',
                'spl',
                'type',
                'sem_year',
                'session',
                'previous_migration',
                'fee',
                'exam_status',
                'project_status',
                'uni_visit_date',
                'pass_back',
                'documents',
                'created_at',
                'updated_at'
                
            ];
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
    public function specialization(): BelongsTo
    {
        return $this->BelongsTo(specializations::class,'spl','id');
    }
}
