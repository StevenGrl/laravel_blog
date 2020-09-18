<div class="jumbotron mb-3 bg-white border p-0">
    <div class="row p-3">
        <div class="col-3 my-auto">
            <img src="{{ asset('images/upload/' . $article->image) }}"
                 class="img-fluid rounded" alt="image en chargement ou corompue">
        </div>
        <div class="col-9">
            <h2>
                <a href="{{ route('show_article', ['id' => $article->id ]) }}"
                   class="text-decoration-none text-primary font-weight-normal font-italic">
                    {{ $article->title }}
                </a>
            </h2>
            <div class="details">
                <p class="font-weight-light font-italic text-muted mb-0">
                    <small>Date de création : {{ $article->created_at->format('Y-m-d H:i') }}
                        @if($article->created_at < $article->updated_at)
                            | Dernière mise à jour : {{ $article->updated_at->format('Y-m-d H:i') }}
                        @endif
                    </small>
                </p>
            </div>
            <div>
                {{--<a class="badge badge-info" href="{{ route('category_article_index', ['id' => $category->id]) }}">--}}
                <a class="badge badge-info" href="#">
                    {{ $article->category->name }}
                </a>
                <span class="ml-2">
                        {{ $article->nbViews }} <i class="far fa-eye fa-sm"></i> |
                        {{--{{ count($article->comments) }} <i class="far fa-comments"></i>--}}
                        50 <i class="far fa-comments"></i>
                    </span>
            </div>
            <span class="text-muted">{{ Str::limit($article->content, 150) }}</span>
            <a class="text-decoration-none move-arrow"
               href="{{ route('show_article', ['id' => $article->id]) }}" role="button">
                Voir plus <i class="fas fa-arrow-right fa-sm"></i>
            </a>
        </div>
    </div>
</div>