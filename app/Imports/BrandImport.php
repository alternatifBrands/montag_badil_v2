<?php

namespace App\Imports;

use App\Models\Brand;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BrandImport implements ToModel ,WithHeadingRow
{
    public function model(array $row)
    {
    if(!Brand::where('name',$row['name'])->first()){
        return new Brand($row);
    }
    }
}
