<?php

namespace App\Http\Controllers\API;

use App\Exports\BrandAlternativeExport;
use App\Trait\AHM_Response;
use Illuminate\Http\Request;
use App\Models\BrandAlternative;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\BrandAlternativeResource;
use App\Http\Requests\API\BrandAlternative\createRequest;
use App\Http\Requests\API\BrandAlternative\updateRequest;
use App\Imports\BrandAlternativeImport_3;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BrandAlternativeController extends Controller
{
    use AHM_Response;
    
    public function export_example(){
        return $this->GetDataResponse(['file_link' => asset('brand_alternative.xlsx')]);
    }
    public function export(Request $request){
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:brand_alternatives,id'
        ]) ;
        return (new BrandAlternativeExport)->forIds($request->ids)->download('alternative.xlsx');
    }

    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        Excel::import(new BrandAlternativeImport_3, $request->file('file'));
        return $this->okResponse('Succes Imported',null);
    }

    public function index(Request $request)
    {
        $countryName = $request->query('country_name');
        $countryId = $request->query('country_id');
        $query = BrandAlternative::where('status', 'approved')->with([
            'user',
            'category',
            'country',
            'locations',
            'city'
        ]);
        
        // Apply filter by country name if provided
        if ($countryName) {
            $query->whereHas('country', function ($query) use ($countryName) {
                $query->where('name', $countryName);
            });
        }

        // Apply filter by country ID if provided
        if ($countryId) {
            $query->whereHas('country', function ($query) use ($countryId) {
                $query->where('id', $countryId);
            });
        }

        $brands = $query->paginate((int) $request->query('per_page'));
        return BrandAlternativeResource::collection($brands);
    }
    public function show(Request $request,$id)
    {
        $countryName = $request->query('country');
        $countryId = $request->query('location_id');
        $query = BrandAlternative::where('status', 'approved')->with([
            'user',
            'category',
            'country',
            'locations',
            'city'
        ]);
        if ($countryName) {
            $query->whereHas('country', function ($query) use ($countryName) {
                $query->where('name', $countryName);
            });
        }
        if ($countryId) {
            $query->where('country_id', $countryId); 
        }
        $brand = $query->find($id);
        if ($brand) {
            return $this->GetDataResponse(BrandAlternativeResource::make($brand));
        }
        return $this->NotFoundResponse();
    }
    public function search(Request $request,$keyword)
    {
        $locationId = $request->query('location_id');
        if (BrandAlternative::exists()) {
            $query  = BrandAlternative::with([
                'user',
                'category',
                'country',
                'locations',
                'city'
            ])->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('barcode', 'like', '%' . $keyword . '%');
            });
            if ($locationId) {
                $query->where('country_id', $locationId); 
            }
            $brands = $query->paginate();
            return $this->paginateResponse(BrandAlternativeResource::collection($brands));
        }
        return $this->NotFoundResponse();
    }
    public function store(createRequest $request)
    {
        $data = $request->validated();
        
        $brand = BrandAlternative::create($data);

        $brand->update([
            'status'=>'pending'
        ]);

        // if($request->hasFile('image')) {
        //     $brand->addMediaFromRequest('image')->toMediaCollection('brand_alternative');
        // }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('brand_alternative_image', 'public');
            $brand->image = $filePath;
            $brand->save();
        }

        if($brand) {
            return $this->CreateResponse(BrandAlternativeResource::make($brand));
        }
        
    }
    public function update(updateRequest $request, $id)
    {
        $brand = BrandAlternative::find($id);
        if(!$brand) {
            return $this->NotFoundResponse();
        }
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $brand->clearMediaCollection('brand');
            $brand->addMediaFromRequest('image')->toMediaCollection('brand_alternative');
        }

        $brand->update($data);
        return $this->UpdateResponse(BrandAlternativeResource::make($brand));
    }
}
