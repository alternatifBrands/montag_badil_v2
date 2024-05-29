@extends('web.pages.montag_layout')
@section('title', 'Insert Brand Page')
@section('content')
    @include('web.pages.header')
    <div class="container">
        <h2 class="mt-5">Insert Brand</h2>
        <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            {{-- <div class="form-group">
                <label for="url">url:</label>
                <input type="url" class="form-control" id="url" name="url" required>
            </div> --}}
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="country_id">Country:</label>
                <select class="form-control" id="country_id" name="country_id" required>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="button-3">Submit</button>
        </form>
    </div>
    @include('web.pages.footer')
    @include('web.pages.mob_header')
@endsection