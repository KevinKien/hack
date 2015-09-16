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
                    @include('layouts._breadcrumb', array(
                        'lv2'=> array(
                            'url'=>$category->getLink(),
                            'title' => $category->name
                        ),
                        'lv3' => $item->title
                    ))
                    <header>
                        <h1 class="title single-title">{{$item->title}}</h1>
                        <span class="theauthor single-postmeta"><i class="fa fa-pencil"></i> Đăng tại <a href="{{$category->getLink()}}" title="Xem tất cả bài viết về {{$category->name}}" rel="nofollow">{{$category->name}}</a> vào ngày {{$item->created_at->format('d/m/Y')}}</span>
                    </header><!--.headline_area-->

                    <div class="post-single-content box mark-links">
                      {{$item->content}}
                    </div>

                    <div class="download" style="margin-top: 30px">
                    @if(count($item->links) > 0)
                        <h3 style="padding: 1px solid #e2e2e2; padding-bottom: 10px">TẢI VỀ</h3>
                        @if(Auth::user())
                            <p style="font-style: italic">Bạn có {{ceil(Auth::user()->account->balance)}} XU để mua Link</p>
                            @foreach($item->links as $aLink)
                                @if($aLink->isBuyByUser())
                                    <a class="btn btn-success" target="_blank" href="{{$aLink->isBuyByUser() ? $aLink->content : 'javascript:buyLink('.$aLink->id.')'}}">
                                        <i class="fa fa-download"></i> {{$aLink->text}} (Đã mua)
                                    </a>
                                @else
                                    <a class="btn btn-primary" href="{{'javascript:buyLink('.$aLink->id.')'}}">
                                        <i class="fa fa-download"></i> {{$aLink->text}} ({{$aLink->price}} XU)
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <p style="font-style: italic">Bạn cần <a href="#modalLogin" data-toggle="modal">đăng nhập</a> để xem</p>
                        @endif
                    @endif
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
                        <a class="relatedthumb" href="{{$aRelatedArticle->getUrlWithMainCate()}}" title="{{$aRelatedArticle->title}}">
                            <span class="rthumb">
                                <img width="200" height="125" src="{{$aRelatedArticle->thumb}}" alt="{{$aRelatedArticle->title}}" title="{{$aRelatedArticle->title}}" />
                            </span>
                            <span class="rp_title">{{$aRelatedArticle->title}}</span>
                        </a>
                    </li>
                    @endforeach
                    </ul>
                </div> <!-- .related-posts -->

            </div><!-- End .post-->
    </div>
</article>
<script>
    function buyLink(id){
        $.post('/charge/buy-link', {
            id: id
        }, function(result){
            if(result.success){
                alert('Thành công!');
                window.location.href = result.link;
            }else{
                alert(result.message);
            }
        }, 'json')
    }
</script>

@endsection