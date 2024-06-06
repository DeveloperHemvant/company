<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Students extends Model
{
        use SoftDeletes;
        protected $fillable = [
                'id',
                'university_id',
                'source',
                'associate',
                'user_id',      
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
                'course_id',
                'spl',
                'type',
                'sem_year',
                'session_id',
                'previous_migration',
                'fee',
                'specialization_id',
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
            return $this->BelongsTo(Cousre::class);
    }
    Public function session():BelongsTo
    {
            return $this->BelongsTo(admission_session::class,'session_id','id');
    }
    public function university(): BelongsTo
    {
        return $this->BelongsTo(University::class);
    }
    public function specialization(): BelongsTo
    {
        return $this->BelongsTo(specializations::class);
    }
}
