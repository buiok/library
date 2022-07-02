@extends('layouts.main')

@section('title')
    Изменить категорию
@endsection

@section('content')
    <div class="container">
        <h1 class="my-md-5 my-4">Изменить категорию</h1>
        @include('inc.messages')

        <div class="row">
            <div class="col-lg-5 col-md-8">
                <form method="POST" action="{{ route('categories.update', $category) }}">
                @csrf
                @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Напишите название" id="floatingName" name="name" required value='{{ $category->name }}'>
                        <label for="floatingName">Название</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Изменить</button>
                </form>
            </div>
        </div>
    </div>
@endsection