@extends('layouts.app')

@section('content')
    <div class="jumbotron mb-3 bg-light p-0 pb-4" id="view_jumbotron">
        <div class="row mb-3">
            <div class="col-12">
                <img src="{{ asset('images/upload/' . $article->image) }}" class="img-fluid rounded-top img-cover" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-10 mx-auto">
                <div class="row">
                    <h2 class="d-inline-block col-10 pl-0">{{ $article->title }}</h2>
                    @if(isset($user))
                        <div class="d-inline-block my-auto ml-3">
                            <a href="{{ route('edit_article', ['id' =>  $article->id]) }}" class="btn btn-primary">
                                <i class="far fa-edit"></i>
                            </a>
                            <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                             aria-labelledby="deleteModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered  " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Confirmation de suppression !
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer cet article ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Annuler
                                        </button>
                                        <a href="{{ route('delete_article', ['id' => $article->id]) }}"
                                           class="btn btn-danger">
                                            Supprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <p class="col-12 pl-0 mb-0">
                        <small class="font-italic text-muted">
                            Date de création : {{ $article->created_at->format('Y-m-d H:i') }}
                            @if($article->created_at != $article->updated_at)
                            | Dernière mise à jour : {{ $article->updated_at->format('Y-m-d H:i') }}
                            @endif
                            |
                        </small>
                        <a class="badge badge-info" href="{{ route('index_article_by_category', ['category' => $article->category->id, 'page' => 1]) }}">
                            {{ $article->category->name }}
                        </a>
                        <span>
                            {{ $article->nbViews }} <i class="far fa-eye fa-sm"></i> |
                            {{ count($article->comments) }} <i class="far fa-comments"></i>
                            {{--@if($article->user !== Auth::user()))--}}
                                @if($isLiked)
                                    <i class="fas fa-heart fa-lg"></i> <small id="remove_fav">(Enlever des favoris)</small>
                                @else
                                    <i class="far fa-heart fa-sm"></i> <small id="add_fav">(Ajouter en favori)</small>
                                @endif
                            {{--@endif--}}
                        </span>
                    </p>
                    <div class="col-12 pl-0">
                        <div class="dropdown-divider border border-secondary col-3"></div>
                    </div>
                    <p class="mb-0">{{ $article->content }}</p>
                    <div class="dropdown-divider mx-auto border border-secondary col-2 mt-3"></div>
                    <h2 class="mt-0 col-12 pl-0 text-center">~ Commentaires ~</h2>
                    @forelse($article->comments as $comment)
                        <div class="col-12">
                            <div class="border-left border-secondary mb-3">
                                <blockquote class="blockquote ml-4">
                                    <div class="font-weight-bold">
                                        {{ $comment->title }} |
                                        <span class="font-italic font-weight-normal">{{ $comment->user->name }} :</span>
                                        <small>{{ $comment->created_at }}</small>
                                    </div>
                                    <footer class="blockquote-footer">
                                        <div class="font-italic">
                                            {{ $comment->message }}
                                        </div>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    @empty
                        <p>Aucun commentaire pour le moment.</p>
                    @endforelse
                    <div class="card col-12">
                        <div class="card-header">
                            <h3 class="text-center">Ajouter un commentaire</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'store_comment']) !!}
                            <div class="form-group">
                                    {!! Form::label('title', 'Titre') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('message', 'Message') !!}
                                    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                                </div>
                            {!! Form::hidden('article_id', $article->id) !!}
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">Envoyer mon commentaire</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ $article->id }}" id="idArticle">
    </div>
@endsection