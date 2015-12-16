@extends('layouts.fronts', array(
    'title'=>'Nạp sò Garena x10',
    'description'=>'Hack nạp thẻ garena, hack sò garena, nap so garena bằng thẻ điện thoại, nạp sò garena x10, nap so the viettel, vinaphone, mobiphone',
    'keyword'=>'hack so garena, hack nap so x10, hack rp lien minh, nap so bang the dien thoai'
    ))

@section('content')
    <article class="article">
        <div id="content_box">
            <div class="post">
                <div class="single_post">
                    @include('layouts._breadcrumb', array(
                        'lv3' => 'Nạp sò Garena x10'
                    ))
                    <header>
                        <h1 class="title single-title">Nạp sò Garena x10</h1>
                        <span class="theauthor single-postmeta" style="font-style: italic">
                            <b><i class="fa fa-star"></i> Tỷ lệ nạp:</b> 10.000đ = 200 Sò (100RP)
                        </span>
                    </header><!--.headline_area-->
                    <div class="post-single-content box mark-links">
                        <p><i>Nhập thông tin tài khoản Garena và thẻ nạp để được x10 giá trị Sò nhận được.</i></p>
                        {{Form::open(array('url'=>'charge/charge-garena', 'role'=>'form'))}}
                        @include('layouts._messages')
                        <div class="form-group">
                            <label for="card_type">Tên đăng nhập Garena:</label>
                            {{Form::text('garena_id', null, array('class'=>'form-control', 'required'))}}
                        </div>
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