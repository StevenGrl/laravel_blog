@extends('layouts.app')

@section('content')
    @if($errors->any())
        <pre>
            {{ var_dump($errors) }}
        </pre>
    @endif
    <div class="card col-9 mx-auto p-0">
        <div class="card-header text-center">
            <h1>Ajout d'un article</h1>
        </div>
        <div class="card-body font-weight-bold">
            {!! Form::open(['route' => 'store_article', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Titre') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="mt-3">
                    <img id="article-image" class="img-fluid" src="{{ asset('images/default.png') }}"  alt="">
                </div>
                <div class="custom-file my-3">
                    {!! Form::file('image', ['id' => 'article_imageFile', 'class' => 'custom-file-input']) !!}
                    {!! Form::label('image', 'Choisir une image..', ['class' => 'custom-file-label']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_id', 'Catégorie') !!}
                    {!! Form::select('category_id', $list_categories, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Contenu') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                </div>
                <div class="custom-control custom-switch">
                    {!! Form::checkbox('published', 1, null, ['id' => 'published', 'class' => 'custom-control-input']) !!}
                    <label for="published" class="custom-control-label">Publier</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Créer l'article</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection