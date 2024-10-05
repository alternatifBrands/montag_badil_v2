@extends('web.pages.montag_layout')
@section('title', 'About Page')
@section('content')
    <div class="page-wrapper">
        @include('web.pages.header')
       {!! App\Models\Setting::where('key','terms_and_conditions')->pluck('value')->first() !!}
        @include('web.pages.footer')
    </div><!-- /.page-wrapper -->
    @include('web.pages.mob_header')
@endsection
