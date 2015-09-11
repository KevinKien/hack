@extends('layouts.fronts', array(
    'title'=>'Nạp xu',
    'description'=>'',
    'keyword'=>''
    ))

@section('content')
    <article class="article">
        <div id="content_box">
            <div class="post">
                <div class="single_post">
                    <div class="breadcrumb"><a href="/">Home</a>   »   Nạp xu</div>
                    <header>
                        <h1 class="title single-title">Nạp xu</h1>
                        <span class="theauthor single-postmeta" style="font-style: italic"><b>Tỷ lệ nạp:</b> 1000đ = 1XU</span>
                    </header><!--.headline_area-->
                    <div class="post-single-content box mark-links">
                        {{Form::open(array('url'=>'charge/new', 'role'=>'form'))}}
                        @include('layouts._messages')
                        <div class="form-group">
                            <label for="card_type">Loại thẻ:</label>
                            {{Form::select('card_type', array(''=>'Chọn loại thẻ')+$allCardTypes, null, array('class'=>'form-control'))}}
                        </div>
                        <div class="form-group">
                            <label for="pin">Mã thẻ:</label>
                            {{Form::text('pin', null, array('class'=>'form-control', 'required'))}}
                        </div>
                        <div class="form-group">
                            <label for="seri">Seri:</label>
                            {{Form::text('seri', null, array('class'=>'form-control', 'required'))}}
                        </div>
                        <div class="form-group ">
                            <label for="captcha">Mã xác thực:</label>
                            <div class="row">
                                <div style="clear:both;"></div>
                                <div class="col-lg-8">
                                    {{Form::text('captcha', null, array('class'=>'form-control', 'required'))}}
                                </div>
                                <div class="col-lg-4">
                                    @captcha()
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Đồng ý</button>
                            <button type="reset" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Nhập lại</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div> <!-- .single_post -->

            </div><!-- End .post-->
        </div>
    </article>

@endsection