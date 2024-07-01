<?php

namespace App\Exports;

use App\Models\Feedetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class FeeDetailsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $counter=1;
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $feeDetails;

    public function __construct( $feeDetails)
    {
        $this->feeDetails = $feeDetails;
    }

    public function collection()
    {
        return $this->feeDetails;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Received From',
            'Received Amount',
            'Description',
            'Mode',
            'Remark',
            'Created At',
            'Updated At'
        ];
    }
    public function map($row): array
    {
        // dd($row);
        return [
            $this->counter++,
            $row['date'],
            $row['received_from'],
            $row['received_amount'],
           $row['description'],
           $row['mode'],

           $row['remark'],

        ];
    }
}
