<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportStudent implements FromCollection, WithHeadings, WithMapping
{
    protected $data;
    private $counter = 1;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'ID',
            'University Name',
            'Course Name',
            'Session Name',
            'Associate Name',
            'Source',
            'SR No',
            'University Registration No',
            'Password',
            'Name',
            'Father Name',
            'Mother Name',
            'Date of Birth',
            'Aadhar No',
            'Email ID',
            'Address',
            'Mobile No',
            'Specialization',
            'Admission Type',
            'Semester/Year',
            'Previous Migration',
            'Fee',
            'Exam Status',
            'Project Status',
            'University Visit Date',
            'Pass Back',
            'Marksheet 1st Sem',
            'Marksheet 2nd Sem',
            'Marksheet 3rd Sem',
            'Marksheet 4th Sem',
            'Marksheet 5th Sem',
            'Marksheet 6th Sem',
            'Marksheet 7th Sem',
            'Marksheet 8th Sem',
            'Provisional Diploma/Degree',
            'Additional Docs',
            'Additional Remarks',
            'NC',
            'Created At',
            'Updated At',
            'Documents',
        ];
    }

    public function map($row): array
    {


        return [
            $this->counter++,
            $row['university']['university_name'],
            $row['course']['course_name'],
            $row['session']['name'],
            $row['associate']['associate_name'],
            $row['source'],
            $row['sr_no'],
            $row['uni_reg_no'],
            $row['password'],
            $row['name'],
            $row['father_name'],
            $row['mother_name'],
            $row['dob'],
            $row['aadhar_no'],
            $row['email_id'],
            $row['address'],
            $row['mob_no'],
            $row['spl'],
            $row['type'],
            $row['sem_year'],
            $row['previous_migration'],
            $row['fee'],
            $row['exam_status'],
            $row['project_status'],
            $row['uni_visit_date'],
            $row['pass_back'],
            $row['marksheet_1st_sem'],
            $row['marksheet_2nd_sem'],
            $row['marksheet_3rd_sem'],
            $row['marksheet_4th_sem'],
            $row['marksheet_5th_sem'],
            $row['marksheet_6th_sem'],
            $row['marksheet_7th_sem'],
            $row['marksheet_8th_sem'],
            $row['provisional_diploma_degree'],
            $row['additional_docs'],
            $row['additional_remarks'],
            $row['nc'],
            $row['created_at'],
            $row['updated_at'],
            $row['documents'] = 'http://127.0.0.1:8000/storage/' . $row['documents'],
        ];
    }
}

