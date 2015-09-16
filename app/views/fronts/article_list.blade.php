@extends('layouts.fronts', array(
    'title'=>$category->name,
    'description'=>'Các bài viết về '.$category->name,
    'keyword'=>$category->name
    ))

@section('content')

<article class="article">
    <h1 class="postsby"><span>{{$category->name}}</span></h1>
    <div id="content_box" class="home_page">
    @foreach($allArticles as $anArticle)
            <div class="post excerpt">
                <header>
                    <h2 class="title">
                        <a href="{{$anArticle->getUrl($category->alias)}}" title="{{$anArticle->title}}" rel="bookmark">{{$anArticle->title}}</a>
                    </h2>
                    <div class="post-info">
                        <div class="time_mt hp_meta">{{$anArticle->created_at->format('d/m/Y')}}</div>
                        <div class="cat_mt hp_meta">
                            <i class="fa fa-file" style="margin: 0 3px 0 7px"></i>
                            <a href="{{$category->getLink()}}" title="Xem tất cả bài viết trong {{$category->name}}">{{$category->name}}</a>
                        </div>
                    </div>
                </header>
                <a rel="nofollow" href="{{$anArticle->getUrl($category->alias)}}" title="{{$anArticle->title}}" class="featured-thumbnail-a">
                    <div class="featured-thumbnail">
                        <img width="150" height="150" src="{{$anArticle->thumb}}" class="attachment-featured wp-post-image" alt="{{$anArticle->title}}" title="{{$anArticle->title}}">
                    </div>
                </a>
                <div class="post-content">
                    {{$anArticle->description}}
                </div>
            </div>
            <!--.post excerpt-->
        @endforeach
        <div class="pagination-home">
            {{$allArticles->links()}}
        </div>
    </div>
</article>

@endsection