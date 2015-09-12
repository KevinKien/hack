<div class="breadcrumb">
    <a href="/"><i class="fa fa-home"></i> Home</a>
    @if(isset($lv2))
    »   <a title="View all posts in Internet" href="/{{$lv2['url']}}">{{$lv2['title']}}</a>
    @endif
    »   {{$lv3}}
</div>
