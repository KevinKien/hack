@extends('layouts.fronts', array(
    'title'=>$item->title,
    'description'=>$item->description,
    'keyword'=>$item->keyword
    ))

@section('content')

<article class="article">
    <div id="content_box">
          <div class="post">
                <div class="single_post">

                    <div class="breadcrumb"><a href="/">Home</a>   »   <a title="View all posts in Internet" href="/{{$category->alias}}">{{$category->name}}</a>   »   {{$item->title}}</div>

                    <header>
                        <h1 class="title single-title">{{$item->title}}</h1>
                        <span class="theauthor single-postmeta">Đăng tại <a href="/{{$category->alias}}" title="Xem tất cả bài viết về {{$category->name}}" rel="nofollow">{{$category->name}}</a> vào lúc {{$item->created_at->format('l, d/m/Y')}}</span>
                    </header><!--.headline_area-->

                    <div class="post-single-content box mark-links">
                      {{$item->content}}
                    </div>

                    <div class="download" style="margin-top: 30px">
                        <h3 style="padding: 1px solid #e2e2e2; padding-bottom: 10px">TẢI VỀ</h3>
                        @foreach($item->links as $aLink)
                        <a href="{{$aLink->content}}">{{$aLink->text}}</a>
                        @endforeach
                    </div>

                </div> <!-- .single_post -->

                <div id="cphContent_ucPost1_div_post_tags" class="tags">
                    <span class="tagtext">Tags:</span>
                    @foreach(explode(',',$item->keyword) as $aKey)
                    <a rel="tag" href="/tag/{{$aKey}}">{{$aKey}}</a>
                    @endforeach
                </div> <!-- End .tags -->

                 <!-- .keywords -->

                <div id="cphContent_ucPost1_div_related_posts" class="related-posts">
                    <div class="postauthor-top"><h3>Bài viết liên quan</h3></div>
                    <ul>
                    <?php $count=0 ?>
                    @foreach($allRelatedArticles as $aRelatedArticle)
                    <?php $count++ ?>
                    <li @if($count % 3 == 1) class="first" @elseif($count % 3 == 0) class="last" @endif>
                        <a class="relatedthumb" href="#" title="{{$aRelatedArticle->title}}">
                            <span class="rthumb">
                                <img width="200" height="125" src="{{$aRelatedArticle->thumb}}" alt="{{$aRelatedArticle->title}}" title="{{$aRelatedArticle->title}}" />
                            </span>
                        </a>
                    </li>
                    @endforeach
                    </ul>
                </div> <!-- .related-posts -->

            </div><!-- End .post-->
    </div>
</article>

@endsection