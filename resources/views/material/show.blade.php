@extends('layouts.main')

@section('title')
    {{$material->name}}
@endsection

@section('content')

<script>
   
</script>

    <div class="container">
    <h1 class="my-md-5 my-4">{{$material->name}}</h1>
    <div class="row mb-3">
        <div class="col-lg-6 col-md-8">

            @if($material->author != NULL)
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Авторы</p>
                    <p class="col">{{$material->author}}</p>
                </div>
            @endif

            <div class="d-flex text-break">
                <p class="col fw-bold mw-25 mw-sm-30 me-2">Тип</p>
                <p class="col">{{$material->type}}</p>
            </div>
            <div class="d-flex text-break">
                <p class="col fw-bold mw-25 mw-sm-30 me-2">Категория</p>
                <a class="col" href="{{ route('categories.show', $material->category->id) }}">{{$material->category->name}}</a>
            </div>

            @if($material->description != NULL)
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Описание</p>
                    <p class="col">{{$material->description}}</p>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Теги</h3>
            
            @if($errors->form_addTag->all())
                <div class="alert alert-danger">
                  <ul>
                      @foreach($errors->form_addTag->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif

            @if(count($tags)!=0)
                <form method="POST" action="{{ route('addTagMaterial') }}">
                @csrf
                    <input type="hidden" value="{{ $material->id }}" name="material_id">
                    <input type="hidden" value="addTag" name="req">
                    <div class="input-group mb-3">
                        <select class="form-select" id="selectAddTag" aria-label="Добавьте тег" name="tag" required>

                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach

                        </select>
                        <button class="btn btn-primary" type="submit">Добавить</button>
                    </div>
                </form>
            @endif

            @if(count($material->tags)!=0)
                <ul class="list-group mb-4">
                    @foreach($material->tags as $tag)
                        <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <a href="{{ route('tags.show', $tag->id) }}" class="me-3">
                            {{ $tag->name }}
                        </a>

                        <form style='display:inline;' action="{{ route('deleteTagMaterial') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tag" value="{{ $tag->id }}">
                            <input type="hidden" name="material" value="{{ $material->id }}">
                            <button  style='color: #0d6efd;border:0;background:none' type="submit" onclick="return confirm('Вы уверены, что хотите удалить тег?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> 
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                        </li>
                    @endforeach
                </ul>
            @endif
            
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-between mb-3">
                <h3>Ссылки</h3>
                <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Добавить</a>
            </div>
            <ul class="list-group mb-4">

            @if(count($material->links)==0)
                <p>Нет ссылок</p>
            @else
                @foreach($material->links as $link)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <a href="{{ $link->url }}" class="me-3" target="_blank" rel = "noopener noreferrer">
                            @if(isset($link->signature))
                                {{ $link->signature }}
                            @else
                                {{ $link->url }}
                            @endif
                        </a>
                        <span class="text-nowrap">
                            
                        <button style='color: #0d6efd;border:0;background:none' type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggleEdit" data-bs-sign="{{ $link->signature }}" data-bs-url="{{ $link->url }}" data-bs-id_link="{{ $link->id }}" data-bs-id_material="{{ $material->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                       </button>

                        <form style='display:inline;' action="{{ route('deleteLinkMaterial') }}" method="POST">
                            @csrf
                            <input type="hidden" name="link" value="{{ $link->id }}">
                            <button  style='color: #0d6efd;border:0;background:none' type="submit" onclick="return confirm('Вы уверены, что хотите удалить ссылку?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> 
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </span>
                    </li>
                @endforeach
            @endif
            </ul>
        </div>
    </div>
@endsection

@section('hidden')
    @include('inc.link')
@endsection