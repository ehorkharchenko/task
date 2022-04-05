@extends('layouts.admin_layout')

@section('main_content')
    <form method="post" action="/dashboard/company/create">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название компании</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Описание компании</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
