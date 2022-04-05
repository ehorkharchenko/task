@extends('layouts.basic_layout')

@section('content')
   <div class="d-grid mt-2 m-5">
       <h1>{{ $company->name }}</h1>
       <p class="w-50">{{ $company->description }}</p>
       <h2> Добавить отзыв </h2>
       <form method="post" action="/review">
           @csrf
           @guest
           @else
               <input class="d-none" type="text" name="id" value="{{$company->id}}">
               <input class="d-none" type="text" name="name" value="{{ Auth::user()->name }}">
               <input class="d-none" type="email" name="email" value="{{ Auth::user()->email }}">
           @endguest
           <div class="mb-3">
               <label for="exampleFormControlTextarea1" class="form-label">Введите текст</label>
               <textarea class="form-control w-50" id="exampleFormControlTextarea1" name="text" rows="5" style="resize: none;"></textarea>
           </div>
           @guest
               <p class="w-50 alert alert-danger"> Чтобы оставить отзыв нужно <a href="{{ route('register') }}">зарегистрироватся</a> или <a href="{{ route('login') }}">войти</a> в аккаунт </p>
           @else
               <button class="btn btn-success" type="submit"> Отправить </button>
           @endguest
       </form>
       <h2 class="mt-3"> Отзывы о компании </h2>
       @foreach( $reviews as $review )
           @if ( $review->confirmed )
               <div class="mt-4">
                   <h3>{{ $review->name }} {{ $review->email }}</h3>
                   <p>{{ $review->text }}</p>
                   <p>{{ $review->created_at }}</p>
               </div>
           @endif;
       @endforeach
   </div>
@endsection
