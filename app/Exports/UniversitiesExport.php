<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class UniversitiesExport implements FromCollection, WithHeadings, WithMapping
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
            'UNIVERSITY',
            'UNIVERSITY CODE',
            
        ];
    }
    public function map($row): array
    {
        // dd($row);
        return [
            $this->counter++,
            $row['university_name'],
            $row['university_code'],
        ];
    }
}
