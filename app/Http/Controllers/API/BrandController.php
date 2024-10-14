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
        // Retrieve query parameters with default values
        $countryName = $request->query('country_name');
        $countryId = $request->query('country_id');
        $perPage = (int) $request->query('per_page', 15); // Default to 15 items per page if not specified

        // Initialize the query for brands
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

        // Apply filter by country name if provided
        if ($countryName) {
            $query->whereHas('country', function ($query) use ($countryName) {
                $query->where('name','Like', $countryName);
            });
        }

        // Apply filter by country ID if provided
        if ($countryId) {
            $query->whereHas('country', function ($query) use ($countryId) {
                $query->where('id', $countryId);
            });
        }

        // Fetch the brands with pagination
        $brands = $query->paginate($perPage);


        // Return the response including recently viewed products
        return BrandResource::collection($brands);
    }

    public function recentlyViewed(Request $request)
    {
        // Fetch recently viewed products from the session
        $recentlyViewedProductIds = $request->session()->get('recently_viewed', []);
        $recentlyViewedProducts = [];
        if (!empty($recentlyViewedProductIds)) {
            $recentlyViewedProducts = Brand::whereIn('id', $recentlyViewedProductIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $recentlyViewedProductIds) . ')') // Maintain order of IDs
                ->get();
        }

        return BrandResource::collection($recentlyViewedProducts);
    }

    public function show(Request $request, $id)
    {
        // Retrieve the country name and location ID from the request query parameters
        $countryName = $request->query('country');
        $countryId = $request->query('location_id');

        // Query to retrieve the brand with the associated relations and filters
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

        // Apply filters based on the country name and location ID if provided
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

        // Find the brand by ID
        $brand = $query->find($id);

        if ($brand) {
            // Store the recently viewed brand in the session
            $this->storeRecentlyViewed($id);

            // Return the brand data
            return $this->GetDataResponse(BrandResource::make($brand));
        }

        // Return a "not found" response if the brand is not found
        return $this->NotFoundResponse();
    }

    /**
     * Store the recently viewed brand in the session.
     *
     * @param int $brandId
     */
    protected function storeRecentlyViewed($brandId)
    {
        // Retrieve the recently viewed brands from the session or initialize as an empty array
        $recentlyViewed = session()->get('recently_viewed', []);

        // Check if the brand is already in the recently viewed array
        if (!in_array($brandId, $recentlyViewed)) {
            // Add the brand ID to the recently viewed array
            array_unshift($recentlyViewed, $brandId);

            // Limit the recently viewed items to the last 5
            $recentlyViewed = array_slice($recentlyViewed, 0, 5);

            // Store the updated recently viewed array back in the session
            session()->put('recently_viewed', $recentlyViewed);
        }
    }

    /**
     * Retrieve recently viewed brands.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRecentlyViewed()
    {
        $recentlyViewed = session()->get('recently_viewed', []);
        return Brand::whereIn('id', $recentlyViewed)->get();
    }

    public function search(Request $request, $keyword)
    {
        $locationId = $request->query('location_id');
        if (Brand::exists()) {
            $query = Brand::with([
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
