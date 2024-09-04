<?php

namespace App\Http\Controllers\API; 

use App\Trait\AHM_Response;
use App\Http\Controllers\Controller; 
use App\Http\Resources\API\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    use AHM_Response;

    public function index()
    {
        return CountryResource::collection(Country::all());
    } 
}
