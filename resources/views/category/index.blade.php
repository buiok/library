@extends('layouts.main')

@section('title')
    Категории
@endsection

@section('content')
    <div class="container">
        <h1 class="my-md-5 my-4">Категории</h1>
        <a class="btn btn-primary mb-4" href="{{ route('categories.create') }}" role="button">Добавить</a>
        @if (count($categories) == 0 )
            <div><b>Категории отсутствуют</b></div>
        @else
            <div class="row">
            <div class="col-md-6">
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Название</strong>
                    </li>


                    @foreach($categories as $category)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <a class="me-3" href="{{ route('categories.show', $category->id) }}">
                            {{ $category->name }}
                        </a>
                        <span class="text-nowrap">

                        <a href="{{ route('categories.edit', $category->id) }}" class="text-decoration-none me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>

                        <form style='display:inline;' action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  style='color: #0d6efd;border:0;background:none' type="submit" onclick="return confirm('Вы уверены, что хотите удалить категорию?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                            </button>
                        </form>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
    </div>
@endsection