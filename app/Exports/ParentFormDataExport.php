<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class ParentFormDataExport implements FromCollection, WithHeadings, WithMapping
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
            'Parent Name',
            'Parent Email',
            'Parent Mobile',
            'Student Name',
            'Has Laptop/Desktop',
            
        ];
    }
    public function map($row): array
    {
        // dd($row);
        return [
            $this->counter++,
            $row['parent_full_name'],
            $row['parent_email'],
            $row['parent_mobile'],
           $row['student_name'],
           $row['has_laptop_desktop'] == 0 ? 'No' : 'Yes',

        ];
    }
}
