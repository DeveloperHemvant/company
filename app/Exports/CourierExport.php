<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\CourierRecord;

class CourierExport implements FromCollection, WithHeadings, WithMapping
{
    private $counter = 1;

    /**
    * @return \Illuminate\Support\Collection
    */
    protected $courierDatails;

    public function __construct( $courierDatails)
    {
        $this->courierDatails = $courierDatails;
    }

    public function collection()
    {
        return $this->courierDatails;
    }
    public function headings(): array
    {
        return [
            'ID',
            'INWARD/OUTWARD',
            'ASSOCIATE/UNIVERSITY/DIRECT',
            'PARTICULAR DETAILS',
            'COURIER/SPEED POST/ BY HAND',
            'TRACKING NO.',
            'Delivered/ undelivered',
            'Remark',
           
        ];
    }
    public function map($row): array
    {
        // dd($row);
        return [
            $this->counter++,
            $row['type'],
            $row['form_type'],
            $row['particular_details'],
            $row['courier_type'],
           $row['tracking_no'],
           $row['delivery_status'],
           $row['remarks'],

        ];
    }
}
