@extends('layouts.admin_layout')

@section('main_content')

    @foreach( $reviews as $review )
        <div class="border-bottom p-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Имя</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$review->name}}" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" value="{{$review->email}}" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Текст</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>{{$review->text}}</textarea>
            </div>
            <button class="btn btn-danger m-2"
                    onclick="event.preventDefault(); document.getElementById('delete-review-form-{{$review->id}}')"> удалить </button>
            <form class="d-none" id="delete-review-form-{{$review->id}}" method="post" action="/dashboard/review/delete">
                @csrf
                <input type="text" name="id" value="{{$review->id}}">
            </form>
            <button class="btn btn-primary m-2"
                    onclick=" event.preventDefault(); document.getElementById('confirm-form-{{$review->id}}').submit(); "> утвердить </button>
            <form class="d-none" id="confirm-form-{{$review->id}}" method="post" action="/dashboard/review/confirm">
                @csrf
                <input type="text" name="id" value="{{$review->id}}">
            </form>
        </div>
    @endforeach

@endsection
