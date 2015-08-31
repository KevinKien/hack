@extends('layouts.fronts', array(
    'title'=>$category->title,
    'description'=>'Các bài viết về '.$category->title,
    'keyword'=>$category->title
    ))

@section('content')

<article class="article">
    <div id="content_box" class="home_page">
    @foreach($allArticles as $anArticle)
        <div class="post excerpt">
            <header>
                <h2 class="title">
                    <a href="{{$anArticle->getUrl($category->alias)}}"
                       title="{{$anArticle->title}}" rel="bookmark">{{$anArticle->title}}</a>
                </h2>
                <div class="post-info">
                    <div class="time_mt hp_meta">{{$anArticle->created_at->format('d/m/Y')}}</div>
                    <div class="cat_mt hp_meta"><span class="mt_icon"> </span><a
                            href="#" title="View all posts in Word">{{$category->name}}</a>
                    </div>
                </div>
            </header>
            <a rel="nofollow" href="{{$anArticle->getUrl($category->alias)}}"
               title="{{$anArticle->title}}" class="featured-thumbnail-a">
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