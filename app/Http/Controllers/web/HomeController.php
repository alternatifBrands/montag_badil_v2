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
        with(['brands'=>function($q){
            $q->where('status','approved');
        }])
        ->get();
        $users = User::count();
        $categories_count = Category::count();
        $brands = Brand::count();
        $brand_alternatives = BrandAlternative::count();
        return view('web.pages.home', compact('categories','categories_count','users','brands','brand_alternatives'));
    }
    public function show($id)
    {
        $brand = Brand::where('status','approved')->with('brandAlternatives')->findOrFail($id);
        return view('web.pages.brand_details', compact('brand'));
    }
    public function showAlt($id)
    {
        $brand_alt = BrandAlternative::where('status','approved')->findOrFail($id);
        return view('web.pages.brand_alter_details', compact('brand_alt'));
    }
    public function aboutPage() {
        return view('web.pages.about');
    }
    public function contactPage() {
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
        return view('web.pages.insertBrand',compact('categories','countries'));
    }
    public function store_brand(Request $request)
    {
        $brand = Brand::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'url'=>$request->url,
            'category_id'=>$request->category_id,
            'country_id'=>$request->country_id,
            'is_alternative'=>0,
            'status'=>'pending',
            'user_id'=>auth()->user()->id
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
        return view('web.pages.insertAlternativeBrand',compact('categories','countries'));
    }
    public function store_alternative_brand(Request $request)
    {
        $brand = BrandAlternative::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'url'=>$request->url,
            'category_id'=>$request->category_id,
            'country_id'=>$request->country_id,
            'status'=>'pending',
            'user_id'=>auth()->user()->id
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('brand_alternative_image', 'public');
            $brand->image = $filePath;
            $brand->save();
        }
        return redirect()->route('home');
    }
    public function attachBrandWithAltView()
    {
        $brands = Brand::
        where('user_id',auth()->user()->id)
        ->where('status','pending')
        ->get();
        $brand_alternatives = BrandAlternative::
        where('user_id',auth()->user()->id)
        ->where('status','pending')
        ->get();
        return view('web.pages.mapBrand',compact('brands','brand_alternatives'));
    }
    public function attach_brand_with_alt(Request $request) {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'alternative_id' => 'required|exists:brand_alternatives,id'
        ]);
        DB::table('brands_alternatives')->insert([
            'brand_id' => $request->brand_id,
            'alternative_id'=>$request->alternative_id,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        return redirect()->route('home');
    }
}
