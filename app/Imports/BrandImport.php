<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BrandImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // if($row['done'] == 1) {
            if (!Brand::where('name', $row['name'])->first()) {
                return new Brand($row);
            }
        // } 
    }
}
