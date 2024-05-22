<?php

namespace App\Imports;

use App\Models\BrandMapAlternative;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MapImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return BrandMapAlternative::firstOrCreate(
            [
                'brand_id' => $row['brand_id'],
                'alternative_id' => $row['alternative_id']
            ],
            $row
        );
    }
}
