<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\BrandAlternative;
use App\Mail\web\ContactFormMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::
            with([
                'brands' => function ($q) {
                    $q->where('status', 'approved');
                }
            ])
            ->get();
        $users = User::count();
        $categories_count = Category::count();
        $brands = Brand::count();
        $brand_alternatives = BrandAlternative::count();
        return view('web.pages.home', compact('categories', 'categories_count', 'users', 'brands', 'brand_alternatives'));
    }
    public function show($id)
    {
        $brand = Brand::where('status', 'approved')->with('brandAlternatives')->findOrFail($id);
        return view('web.pages.brand_details', compact('brand'));
    }
    public function showAlt($id)
    {
        $brand_alt = BrandAlternative::where('status', 'approved')->findOrFail($id);
        return view('web.pages.brand_alter_details', compact('brand_alt'));
    }
    public function aboutPage()
    {
        return view('web.pages.about');
    }
    public function contactPage()
    {
        return view('web.pages.contact');
    }
    public function sendMessage(Request $request)
    {
        $formData = [
            'Name' => $request->input('name'),
            'Email' => $request->input('email'),
            'Phone' => $request->input('phone'),
            'Message' => $request->input('message'),
        ];

        Mail::to('admin@gmail.com')->send(new ContactFormMail($formData));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function insertBrandView()
    {
        $categories = Category::get();
        $countries = Country::get();
        return view('web.pages.insertBrand', compact('categories', 'countries'));
    }
    public function store_brand(Request $request)
    {
        $brand = Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'is_alternative' => 0,
            'status' => 'pending',
            'user_id' => auth()->user()->id
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('brand_image', 'public');
            $brand->image = $filePath;
            $brand->save();
        }
        return redirect()->route('home');
    }
    public function insertAlternativeBrandView()
    {
        $categories = Category::get();
        $countries = Country::get();
        $brands = Brand::get();
        return view('web.pages.insertAlternativeBrand', compact('categories', 'countries', 'brands'));
    }
    public function store_alternative_brand(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'brand_id' => 'required|array',
            'brand_id.*' => 'exists:brands,id',  // Ensure each brand_id exists in brands table
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // Create the BrandAlternative record
        $brandAlternative = BrandAlternative::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'status' => 'pending',
            'user_id' => auth()->user()->id
        ]);
        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('brand_alternative_image', 'public');
            $brandAlternative->image = $filePath;
            $brandAlternative->save();
        }
        // Insert brand IDs into the brands_alternatives table
        foreach ($request->brand_id as $brandId) {
            DB::table('brands_alternatives')->insert([
                'alternative_id' => $brandAlternative->id,
                'brand_id' => $brandId
            ]);
        }
        return redirect()->route('home');
    }
}
