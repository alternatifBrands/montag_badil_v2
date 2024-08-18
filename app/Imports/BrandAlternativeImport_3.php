<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\BrandAlternative;
use App\Models\BrandMapAlternative;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;

class BrandAlternativeImport_3 implements ToCollection
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
                $name = preg_replace("/[^\w\s]+/", "", $row[0]);
                $category_name = preg_replace("/[^\w\s]+/", "", $row[4]);
                $is_alternative = $row[5];
                $brand_id = $row[6];

                $brand_id = Brand::find($brand_id)->id ?? 632;  
                $image = $this->downloadImage($row[1]);  
                if($is_alternative){
                    $category = Category::where(DB::raw('UPPER(name)'),strtoupper($category_name))->first();

                    $brandAlt = BrandAlternative::where(DB::raw('UPPER(name)'),strtoupper($name))->first();
                    if(!$brandAlt){ 
                        $brandAlt = BrandAlternative::create([
                            'name' => $name,
                            'status' => 'approved',
                            'image' => $image,
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

    public function downloadImage($url)
    {  

        if (filter_var($url, FILTER_VALIDATE_URL)) { 
            $response = Http::get($url);

            if ($response->ok()) {
                $imageContents = $response->body();
                $filename = basename(parse_url($url, PHP_URL_PATH)) . '.jpg'; 
            } else {
                return null; 
            }
        } else {  
            if (file_exists($url)) {
                $imageContents = file_get_contents($url);
                $filename = basename(parse_url($url, PHP_URL_PATH));
            } else {
                return null; 
            }
        } 
            

        // Define the path where the image will be saved
        $path = 'brand_alternative_image/' . $filename;

        // Save the image to local storage
        Storage::put($path, $imageContents);

        return $filename; 
    }
    
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1'
        ];
    }
}
