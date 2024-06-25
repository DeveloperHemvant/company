<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class SpecializationDataExport implements  FromCollection, WithHeadings, WithMapping
{
    private $counter = 1;
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $universities;

    public function __construct( $universities)
    {
        $this->universities = $universities;
    }

    public function collection()
    {
        return $this->universities;
    }
    public function headings(): array
    {
        return [
            'ID',
            'University',
            'Course Name',
            ' Specialization Name',
            
        ];
    }
    public function map($row): array
    {
        // dd($row);
        return [
            $this->counter++,
            $row['university']['university_name'],
            $row['cousre']['course_name'],
            $row['course_type'],
           $row['specialization_name'],
        ];
    }
}
