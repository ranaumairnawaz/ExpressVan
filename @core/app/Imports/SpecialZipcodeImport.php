<?php

namespace App\Imports;

use App\SpecialZipcode;
use Maatwebsite\Excel\Concerns\ToModel;

class SpecialZipcodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[1] == "Low Emission"){
            $type = 2;
        }
        if($row[1] == "Congession"){
            $type = 1;
        }
        if($row[1] == "Both"){
            $type = 3;
        }
        return new SpecialZipcode([
            'code'     => $row[0],  // Assuming the first column contains the user's name
            'type'    => $type,
        ]);
    }
}
