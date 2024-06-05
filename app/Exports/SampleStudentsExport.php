<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
class SampleStudentsExport implements FromArray, WithHeadings
{
   /**
     * Return an array of data to be exported.
     *
     * @return array
     */
    public function array(): array
    {
        // Add a sample row if needed
        return [
            [
                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
            ]
        ];
    }
    /**
     * Return the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'UNIVERSITY', 'ASSOCIATE', 'SOURCE', 'SR NO', 'UNI. REG NO.', 'PASSWORD', 'NAME', 'FATHER NAME',
            'MOTHER NAME', 'DOB', 'AADHAR NO', 'EMAIL ID', 'ADDRESS', 'MOB NO', 'COURSE', 'SPL', 'TYPE',
            'SEM/YEAR', 'SESSION', 'PREVIOUS MIGRATION', 'FEE', 'EXAM STATUS', 'PROJECT STATUS', 'UNI. VISIT DATE',
            'PASS/BACK', 'MARKSHEET 1ST SEM', 'MARKSHEET 2ND SEM', 'MARKSHEET 3RD SEM', 'MARKSHEET 4TH SEM',
            'MARKSHEET 5TH SEM', 'MARKSHEET 6TH SEM', 'MARKSHEET 8TH SEM', 'PROVISIONAL/DIPLOMA/DEGREE',
            'ADDITIONAL DOCS', 'ADDITIONAL REMARKS', 'NC'
        ];
    }
    
}
