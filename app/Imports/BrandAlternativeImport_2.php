<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\BrandAlternative;
use App\Models\BrandMapAlternative;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BrandAlternativeImport_2 implements ToCollection
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
                $name = $row[0];
                $category_name = $row[4];
                $is_alternative = $row[5];
                $brand_name = $row[6];

                $brand = Brand::where('name','like','%'.$brand_name.'%')->first(); 
                
                $brand_id = $brand->id ?? 100;
                if($is_alternative){
                    $category = Category::where('name','like','%'.$category_name.'%')->first();

                    $brandAlt = BrandAlternative::where('name','like','%'.$name.'%')->first();
                    if(!$brandAlt){ 
                        $brandAlt = BrandAlternative::create([
                            'name' => $name,
                            'status' => 'approved',
                            'image' => 'brand_alternative_image/' . str_replace(' ','_',$row[0]) . '.jpg',
                            'category_id' => $category->id ?? 16,
                            'country_id' => 65,
                            'user_id' => 1
                        ]);  
                    }
                        
                    $brandmap = BrandMapAlternative::where('brand_id',$brand_id)->where('alternative_id',$brandAlt->id)->first();
                    
                    if(!$brandmap){
                        BrandMapAlternative::create([
                            'brand_id' => $brand_id,
                            'alternative_id' => $brandAlt->id
                        ]);
                    } 
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
