@extends('layouts.main')

@section('title')
    Изменить материал
@endsection

@section('content')
<div class="container">
    <h1 class="my-md-5 my-4">Изменить материал</h1>

     @include('inc.messages')

    <div class="row">
        <div class="col-lg-5 col-md-8">

            <form method="POST" action=" {{ route('materials.update', $material->id) }} ">
            @csrf
            @method('PUT')
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelectType" name="type" required>
                        <option value="{{ old('type', $material->type) }}" selected>{{ old('type', $material->type) }}</option>
                        <option value="Книга">Книга</option>
                        <option value="Статья">Статья</option>
                        <option value="Видео">Видео</option>
                        <option value="Сайт/Блог">Сайт/Блог</option>
                        <option value="Подборка">Подборка</option>
                        <option value="Ключевые идеи книги">Ключевые идеи книги</option>
                    </select>
                    <label for="floatingSelectType">Тип</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelectCategory" name="category_id" required> 

                        @foreach($categories as $category)
                            @if(old('category_id'))
                                @if($category->id == old('category_id'))
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @else
                                @if($category->id == $material->category_id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endif
                        @endforeach

                    </select>
                    <label for="floatingSelectCategory">Категория</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Напишите название" id="floatingName" value="{{ old('name', $material->name) }}" name="name" required>
                    <label for="floatingName">Название</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor" value="{{ old('author', $material->author) }}" name="author">
                    <label for="floatingAuthor">Авторы</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Напишите краткое описание" id="floatingDescription"
                      style="height: 100px" name="description">{{ old('description', $material->description) }}</textarea>
                    <label for="floatingDescription">Описание</label>
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