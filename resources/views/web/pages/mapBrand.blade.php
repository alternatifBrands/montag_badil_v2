@extends('web.pages.montag_layout')
@section('title', 'Map Brand Alternative Page')
@section('content')
    @include('web.pages.header')
    <div class="container">
        <h2 class="mt-5">Map Brand With Alternative Brand</h2>
        <form method="POST" action="{{ route('map.store') }}" enctype="multipart/form-data">
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
                <label for="alternative_id" style="font-weight: bold">Alternative Brand:</label>
                <select class="form-control" id="alternative_id" name="alternative_id" required>
                    @foreach($brand_alternatives as $brand_alternative)
                        <option value="{{ $brand_alternative->id }}">{{ $brand_alternative->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="button-3">Submit</button>
        </form>
    </div>
    @include('web.pages.footer')
    @include('web.pages.mob_header')
@endsection