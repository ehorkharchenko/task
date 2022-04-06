@extends('layouts.admin')

@section('main_content')
    <form method="post" action="/dashboard/appoint-moderator">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email пользователя</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Назначить</button>
    </form>
@endsection
