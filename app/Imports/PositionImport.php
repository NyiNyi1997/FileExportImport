<?php

namespace App\Imports;

use App\Position;
use Maatwebsite\Excel\Concerns\ToModel;

class PositionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Position([
            //
            'position_name' => $row[0],
            'department_id'=>$row[1]
        ]);
    }
}
