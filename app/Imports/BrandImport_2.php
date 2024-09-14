<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\BrandAlternative;
use App\Models\BrandMapAlternative;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class BrandImport_2 implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  collection(Collection $rows)
    {
        foreach($rows as $key => $row){
            if($key != 0){ 
                $brand = Brand::find($row[0]);
                if($brand){  
                    $brand->setTranslation('description','en',$row[1]);
                    $brand->setTranslation('description','ar',$row[2]);
                    $brand->setTranslation('description','tr',$row[3]);
                    $brand->save();
                }
            }
        } 
    }
    
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1'
        ];
    }
}
