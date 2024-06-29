<?php

namespace App\Http\Controllers\API;

use App\Trait\AHM_Response;
use Illuminate\Http\Request;
use App\Models\BrandAlternative;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\BrandAlternativeResource;
use App\Http\Requests\API\BrandAlternative\createRequest;
use App\Http\Requests\API\BrandAlternative\updateRequest;


class BrandAlternativeController extends Controller
{
    use AHM_Response;
    public function index(Request $request)
    {
        $countryName = $request->query('country');
        $countryId = $request->query('location_id');
        $query = BrandAlternative::where('status', 'approved')->with([
            'user',
            'category',
            'country',
            'city'
        ]);
        if ($countryName) {
            $query->whereHas('country', function ($query) use ($countryName) {
                $query->where('name', $countryName);
            });
        }
        $brands = $query->get();
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
            'city'
        ]);
        if ($countryName) {
            $query->whereHas('country', function ($query) use ($countryName) {
                $query->where('name', $countryName);
            });
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
                'city'
            ])->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('barcode', 'like', '%' . $keyword . '%');
            });
            if ($locationId) {
                $query->whereHas('locations', function ($query) use ($locationId) {
                    $query->where('country_id', $locationId);
                });
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
