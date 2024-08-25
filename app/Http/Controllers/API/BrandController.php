<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use App\Trait\AHM_Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\BrandResource;
use App\Http\Requests\API\Brand\createRequest;
use App\Http\Requests\API\Brand\updateRequest;


class BrandController extends Controller
{
    use AHM_Response;
    public function index(Request $request)
    {
        $countryName = $request->query('country');
        $countryId = $request->query('location_id');
        $query = Brand::where('status', 'approved')->with([
            'user',
            'category',
            'locations',
            'country',
            'city',
            'brandAlternatives' => function ($query) {
                $query->with(['country', 'category']);
            }
        ]);
        if ($countryName) {
            $query->whereHas('country', function ($query) use ($countryName) {
                $query->where('name', $countryName);
            });
        }
        if ($countryId) {
            $query->whereHas('locations', function ($query) use ($countryId) {
                $query->where('country_id', $countryId);
            });
        }
        $brands = $query->paginate();
        return BrandResource::collection($brands);
    }

    public function show(Request $request, $id)
    {
        $countryName = $request->query('country');
        $countryId = $request->query('location_id');
        $query = Brand::where('status', 'approved')->with([
            'user',
            'category',
            'country',
            'locations',
            'city',
            'brandAlternatives' => function ($query) {
                $query->with(['country', 'category']);
            }
        ]);
        if ($countryName) {
            $query->whereHas('country', function ($query) use ($countryName) {
                $query->where('name', $countryName);
            });
        }
        if ($countryId) {
            $query->whereHas('locations', function ($query) use ($countryId) {
                $query->where('country_id', $countryId);
            });
        }
        $brand = $query->find($id);
        if ($brand) {
            return $this->GetDataResponse(BrandResource::make($brand));
        }
        return $this->NotFoundResponse();
    }
    public function search(Request $request, $keyword)
    {
        $locationId = $request->query('location_id');
        if (Brand::exists()) {
            $query  = Brand::with([
                'user',
                'category',
                'country',
                'locations',
                'city',
                'brandAlternatives' => function ($query) {
                    $query->with(['country', 'category']);
                }
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
            return $this->paginateResponse(BrandResource::collection($brands));
        }
        return $this->NotFoundResponse();
    }
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        $brand = Brand::create($data);

        $brand->update([
            'status' => 'pending'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('brand_image', 'public');
            $brand->image = $filePath;
            $brand->save();
        }

        if ($brand) {
            return $this->createResponse(BrandResource::make($brand));
        }
    }
    public function update(updateRequest $request, $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return $this->NotFoundResponse();
        }
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $brand->clearMediaCollection('brand');
            $brand->addMediaFromRequest('image')->toMediaCollection('brand');
        }

        $brand->update($data);
        return $this->UpdateResponse(BrandResource::make($brand));
    }
}
