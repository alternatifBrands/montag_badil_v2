<?php

namespace App\Imports;

use App\Models\BrandAlternative;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BrandAlternativeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!BrandAlternative::where('name', $row['name'])->first()) {
            return new BrandAlternative($row);
        }
    }
}