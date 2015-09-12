<aside class="sidebar c-4-12">
    <div id="sidebars" class="g">
        <div class="sidebar">
            <ul class="sidebar_list">
                <li class="widget widget-sidebar widget-style-1 ">
                    <h3><i class="fa fa-share"></i> Bài Viết Mới</h3>
                    <ul>
                        @foreach($articleNewList as $anArticle)
                        <li>
                            <div class="left">
                                <a href="{{$anArticle->getUrlWithMainCate()}}">
                                    <img src="{{$anArticle->thumb}}" alt="{{$anArticle->title}}" width="65" height="50" class="wp-post-image">
                                </a>
                                <div class="clear"></div>
                            </div>
                            <div class="info">
                                <p class="entry-title">
                                    <a title="{{$anArticle->title}}" href="{{$anArticle->getUrlWithMainCate()}}">{{$anArticle->title}}</a>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </li>
                        @endforeach

                    </ul>
                </li>

                <li class="widget widget-sidebar widget-style-1 ">
                    <h3><i class="fa fa-star"></i> Bài Viết HOT</h3>
                    <ul>
                        @foreach($articleHotList as $anArticle)
                        <li>
                            <div class="left">
                                <a href="{{$anArticle->getUrlWithMainCate()}}">
                                <img src="{{$anArticle->thumb}}" alt="{{$anArticle->title}}" width="65" height="50" class="wp-post-image"></a>
                                <div class="clear"></div>
                            </div>
                            <div class="info">
                                <p class="entry-title">
                                    <a title="{{$anArticle->title}}" href="{{$anArticle->getUrlWithMainCate()}}">{{$anArticle->title}}</a>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</aside>