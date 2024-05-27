<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Students;
class UniqueAadharNoSessionCourse implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    protected $aadhar_no;
    protected $session_id;
    protected $course_id;

    public function __construct($aadhar_no, $session_id, $course_id)
    {
        $this->aadhar_no = $aadhar_no;
        $this->session_id = $session_id;
        $this->course_id = $course_id;
    }

    public function passes($attribute, $value)
    {
        return !Students::where('aadhar_no', $this->aadhar_no)
            ->where('session_id', $this->session_id)
            ->where('course_id', $this->course_id)
            ->whereNull('deleted_at') // Ensure only non-deleted records are considered
            ->exists();
        // dd($data);
    }

    public function message()
    {
        return 'The combination of aadhar_no, session, and course already exists.';
    }
}
