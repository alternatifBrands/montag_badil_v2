<?php

namespace App\Imports;

use App\Models\BrandMapAlternative;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MapImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!BrandMapAlternative::
                    where('brand_id', $row['brand_id'])
                    ->Where('alternative_id', $row['alternative_id'])
                    ->first()) {
            return new BrandMapAlternative($row);
        }
    }
}
