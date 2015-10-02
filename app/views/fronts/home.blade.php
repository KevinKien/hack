@extends('layouts.fronts', array(
    'title'=>'Trùm Hack | Thủ thuật hack Webgame, game di động, game Online và Offline',
    'description'=>'Website chia sẻ những thủ thuật hay về hack game online, hack game điện thoại, hack game offline, hack game Android, iOS',
    'keyword'=>'Hack game online, hack game offline, hack game android, hack game ios, hack webgame mới nhất, hack liên minh, hack mu, hack đột kích'
    ))

@section('content')
<article class="article">
    <div id="content_box" class="home_page">
    @foreach($allArticles as $anArticle)
        <div class="post excerpt">
            <header>
                <h2 class="title">
                    <a href="{{$anArticle->getUrlWithMainCate()}}" title="{{$anArticle->title}}" rel="bookmark">{{$anArticle->title}}</a>
                </h2>
                <div class="post-info">
                    <div class="time_mt hp_meta">{{$anArticle->created_at->format('d/m/Y')}}</div>
                    <div class="cat_mt hp_meta">
                        <i class="fa fa-file" style="margin: 0 3px 0 7px"></i>
                        <a href="{{$anArticle->getMainCate()->getLink()}}" title="Xem tất cả bài viết trong {{$anArticle->getMainCate()->name}}">{{$anArticle->getMainCate()->name}}</a>
                    </div>
                </div>
            </header>
            <a rel="nofollow" href="{{$anArticle->getUrlWithMainCate()}}" title="{{$anArticle->title}}" class="featured-thumbnail-a">
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