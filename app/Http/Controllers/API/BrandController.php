<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use App\Trait\AHM_Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Brand\createRequest;
use App\Http\Requests\API\Brand\updateRequest;
use App\Http\Resources\API\BrandResource;


class BrandController extends Controller
{
    use AHM_Response;
    public function index()
    {
        if (Brand::exists()) {
            // $brands = Brand::with(['user', 'category', 'country','city'])->paginate();
            $brands = Brand::where('status','approved')->with(['user', 'category', 'country', 'city', 'brandAlternatives.country','brandAlternatives.category'])->get();
            // return $this->paginateResponse(BrandResource::collection($brands));
            return BrandResource::collection($brands);
        }
        return $this->NotFoundResponse();
    }
    public function show($id)
    {
        $brand = Brand::where('status','approved')->with(['user', 'category', 'country', 'city', 'brandAlternatives'])->find($id);
        if ($brand) {
            return $this->GetDataResponse(BrandResource::make($brand));
        }
        return $this->NotFoundResponse();
    }
    public function search($keyword)
    {
        if (Brand::exists()) {
            $brands = Brand::with(['user', 'category', 'country', 'city'])
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('barcode', 'like', '%' . $keyword . '%')
                ->paginate();
            return $this->paginateResponse(BrandResource::collection($brands));
        }
        return $this->NotFoundResponse();
    }
    // public function store(createRequest $request)
    // {
    //     $data = $request->validated();

    //     $brand = Brand::create($data);

    //     $brand->update([
    //         'status'=>'pending'
    //     ]);

    //     if($request->hasFile('image')) {
    //         $brand->addMediaFromRequest('image')->toMediaCollection('brand');
    //     }

    //     if($brand) {
    //         return $this->CreateResponse(BrandResource::make($brand));
    //     }

    // }
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
