@extends('layouts.admin')

@section('main_content')

    @foreach( $companies as $company )
        <div class="border ml-1 mr-1 mb-3 p-4">
            <div class="mb-3">
                <label for="company_name_{{$company->id}}" class="form-label">Название компании</label>
                <input type="text" class="form-control" name="name" id="company_name_{{$company->id}}" value="{{ $company->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="company_description_{{$company->id}}" class="form-label">Описание компании</label>
                <textarea class="form-control" name="description"
                          style="height: 200px; resize: none;" id="company_description_{{$company->id}}" readonly>{{$company->description}}</textarea>
            </div>
            <div class="border-top pt-0 pb-0 p-3" id="default-panel-{{$company->id}}">
                <a class="link-primary" href="/dashboard/company/{{$company->id}}"> отзывы о компании </a>
                <button class="btn btn-warning m-2"
                        onclick="
                            document.getElementById('company_name_{{$company->id}}').removeAttribute('readonly');
                            document.getElementById('company_description_{{$company->id}}').removeAttribute('readonly');

                            document.getElementById('edit-panel-{{$company->id}}').classList.remove('d-none');
                            document.getElementById('default-panel-{{$company->id}}').className = 'd-none';

                        ">Редактировать</button>
                <button class="btn btn-danger m-2"
                        onclick=" event.preventDefault(); document.getElementById('delete-company-form-{{$company->id}}').submit() ">Удалить</button>
                <form class="d-none" id="delete-company-form-{{$company->id}}" method="post" action="/dashboard/company/delete">
                    @csrf
                    <input type="text" name="id" value="{{$company->id}}">
                </form>
            </div>
            <div class="d-none" id="edit-panel-{{$company->id}}">
                <button class="btn btn-dark m-2"
                        onclick="
                            document.getElementById('default-panel-{{$company->id}}').classList.remove('d-none');
                            document.getElementById('default-panel-{{$company->id}}').className = 'border-top pt-0 pb-0 p-3';
                            document.getElementById('edit-panel-{{$company->id}}').className += 'd-none';

                            document.getElementById('company_name_{{$company->id}}').setAttribute('readonly', 'readonly');
                            document.getElementById('company_description_{{$company->id}}').setAttribute('readonly','readonly');
                        "> отмена </button>
                <button class="btn btn-primary m-2"
                        onclick="
                            event.preventDefault();
                            document.getElementById('hidden_company_id_{{$company->id}}').value = {{$company->id}};
                            document.getElementById('hidden_company_name_{{$company->id}}').value = document.getElementById('company_name_{{$company->id}}').value;
                            document.getElementById('hidden_company_description_{{$company->id}}').value = document.getElementById('company_description_{{$company->id}}').value;
                            document.getElementById('save-form-{{$company->id}}').submit();
                        " type="submit"> сохранить </button>
                <form class="d-none" id="save-form-{{$company->id}}" method="post" action="/dashboard/company/edit">
                    @csrf
                    <input type="text" name="id" id="hidden_company_id_{{$company->id}}">
                    <input type="text" name="name" id="hidden_company_name_{{$company->id}}">
                    <textarea name="description" id="hidden_company_description_{{$company->id}}"></textarea>
                </form>
            </div>
        </div>
    @endforeach

@endsection
