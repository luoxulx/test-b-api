@extends('front.blog.layout')
@section('meta_title', $article->title)
@section('main')
    <div class="container">
        <header></header>
        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between"></nav>
        </div>
    </div>

    <main role="main" class="container">
        <div class="row bg-light">
            <div class="col-md-9 blog-detail">
                <h3 class="pb-3 mb-4 font-italic border-bottom">{{ $article->title }}</h3>
                <p class="blog-post-meta">
                    <small class="margin-r-15">{{ date('F j, Y', strtotime($article->published_at)) }}</small>
                    <small class="margin-r-15">{{ $article->view_count }}</small>
                    <small class="margin-r-15">
                        @if($article->source)
                            <cite>转自&nbsp;</cite><a href="{{ $article->source }}" target="_blank"><em>{{ $article->source }}</em></a>
                        @endif
                    </small>
                </p>
                <article class="blog-detail">{!! $article->content !!}</article>
            </div>
            <aside class="col-md-3 blog-sidebar">
                @include('front.blog.aside')
            </aside>
        </div>
    </main>
    @include('front.blog.foot')
@stop
