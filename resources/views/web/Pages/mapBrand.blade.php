@extends('web.pages.montag_layout')
@section('title', 'Insert Brand Page')
@section('content')
    @include('web.Pages.header')
    <div class="container">
        <h2 class="mt-5">Map Brand With Alternative Brand</h2>
        <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="brand_id" style="font-weight: bold">Brand:</label>
                <select class="form-control" id="brand_id" name="brand_id" required>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="brand_alternative_id" style="font-weight: bold">Brand:</label>
                <select class="form-control" id="brand_alternative_id" name="brand_alternative_id" required>
                    @foreach($brand_alternatives as $brand_alternative)
                        <option value="{{ $brand_alternative->id }}">{{ $brand_alternative->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="button-3">Submit</button>
        </form>
    </div>
    @include('web.Pages.footer')
    @include('web.Pages.mob_header')
@endsection