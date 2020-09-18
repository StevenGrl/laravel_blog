@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-3">{{ $title }}</h1>
    @forelse($articles as $article)
        @include('articles._view_in_list')
    @empty
        <h1 class="text-center">Pas d'article pour le moment</h1>
    @endforelse
    @if($currentPath != 'favorites_index_article' && $articles->total() >= 10)
        @if($currentPath === 'index_article')
            @include('_pagination', ['paginate' => $articles, 'currentPath' => $currentPath])
        @else
            @include('_pagination', ['paginate' => $articles, 'currentPath' => $currentPath, 'category' => $category])
        @endif
    @endif
@endsection