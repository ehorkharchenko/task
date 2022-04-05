@extends('layouts.admin_layout')

@section('main_content')

    @foreach( $reviews as $review  )
        <div class="mt-0 m-2 border p-4">
            <div class="d-grid row-2">
                <div class="mb-3">
                    <label for="review_name_{{$review->id}}" class="form-label">Имя</label>
                    <input class="form-control w-100" id="review_name_{{$review->id}}" type="text"  value="{{$review->name}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="review_email_{{$review->id}}" class="form-label">Email</label>
                    <input class="form-control w-100" id="review_email_{{$review->id}}" type="email" value="{{$review->email}}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="review_text_{{$review->id}}" class="form-label">Текст</label>
                <textarea class="form-control" id="review_text_{{$review->id}}" rows="5" readonly>{{$review->text}}</textarea>
            </div>
            <div id="default-panel-{{$review->id}}">
                <button class="btn btn-warning"
                        onclick="
                            document.getElementById('review_name_{{$review->id}}').removeAttribute('readonly');
                            document.getElementById('review_email_{{$review->id}}').removeAttribute('readonly');
                            document.getElementById('review_text_{{$review->id}}').removeAttribute('readonly');
                            document.getElementById('edit-panel-{{$review->id}}').classList.remove('d-none');
                            document.getElementById('default-panel-{{$review->id}}').className += 'd-none';
                            ">Редактировать</button>
                <button class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('delete-review-form').submit();"> удалить </button>
                <form class="d-none" id="delete-review-form" method="post" action="/dashboard/review/delete">
                    @csrf
                    <input type="text" name="id" value="{{$review->id}}">
                </form>
            </div>
            <div class="d-none" id="edit-panel-{{$review->id}}">
                <button class="btn btn-dark"
                        onclick="
                            document.getElementById('default-panel-{{$review->id}}').classList.remove('d-none');
                            document.getElementById('edit-panel-{{$review->id}}').className += 'd-none';

                            document.getElementById('review_name_{{$review->id}}').setAttribute('readonly', 'readonly');
                            document.getElementById('review_email_{{$review->id}}').setAttribute('readonly','readonly');
                            document.getElementById('review_text_{{$review->id}}').setAttribute('readonly','readonly');
                            "> отмена </button>
                <button class="btn btn-primary"
                        onclick="
                            event.preventDefault();
                            document.getElementById('hidden_review_name_{{$review->id}}').value = document.getElementById('review_name_{{$review->id}}').value;
                            document.getElementById('hidden_review_email_{{$review->id}}').value = document.getElementById('review_email_{{$review->id}}').value;
                            document.getElementById('hidden_review_text_{{$review->id}}').value = document.getElementById('review_text_{{$review->id}}').value;
                            document.getElementById('save-form').submit();
                            "> сохранить </button>
                <form class="d-none" id="save-form" action="/dashboard/review/edit">
                    @csrf
                    <input type="text" name="id" value="{{$review->id}}">
                    <input id="hidden_review_name_{{$review->id}}" type="text" name="name">
                    <input id="hidden_review_email_{{$review->id}}" type="text" name="email">
                    <input id="hidden_review_text_{{$review->id}}" type="text" name="text">
                </form>
            </div>
        </div>
    @endforeach

@endsection
