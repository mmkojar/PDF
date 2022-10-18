<?php

namespace App\Imports;

use App\Models\Weight;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class WeightImport implements ToModel
{
    
    public function model(array $row)
    {
        $datemod = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]);
        $check = Weight::where('date',$datemod)->get();
        // if(count($check) < 1) {
            return new Weight([
                'product_name'     => $row[0],
                'product_no'    => $row[1],
                'morning' => $row[2],
                'evening' => $row[3],
                'date' => $datemod,
                'month_year' => $row[5].'-'.$row[6],
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ]);
        // }
        
    }
}
