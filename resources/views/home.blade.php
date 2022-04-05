@extends('layouts.basic_layout')

@section('content')

        @foreach( $companies as $company )
            <div class="w-75 bg-white border m-3 align-self-center d-grid">
                <h2 class="m-3">{{ $company->name }}</h2>
                <p class="m-3">{{ $company->description }}</p>
                <a class="m-4 mw-100 link-primary" href="/company/{{$company->id}}"> посмотреть отзывы </a>
            </div>
        @endforeach

@endsection
