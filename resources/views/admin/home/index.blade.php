@extends("layouts.admin")

@section('dashboard_title', 'Домашняя')

@section('main_content')
    <h2> Добро пожаловать! {{ Auth::user()->name }} </h2>
@endsection
