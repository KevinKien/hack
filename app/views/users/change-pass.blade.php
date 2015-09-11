@extends('layouts.fronts', array(
'title'=>'Đổi mật khẩu',
'description'=>'Mô tả',
'keyword'=>'Từ khoá'
))

@section('content')

<article class="article">
    <div id="content_box">
        <div class="post">
            <div class="single_post">
                <div class="breadcrumb"><a href="/">Home</a>   »   Đổi mật khẩu</div>
                <header>
                    <h1 class="title single-title page-header">Đổi mật khẩu</h1>
                </header>
                <div class="post-single-content box mark-links">
                    <div class="row">
                        {{Form::open(array('url'=>'/user/change-pass', 'class'=>'col-md-8 col-xs-12'))}}
                        @include('layouts._messages')
                        <div class="form-group has-error" style="margin-bottom: 0; display: none" id="ajaxMsgOnPage">
                            <label class="control-label" for="inputError" ></label>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu cũ</label>
                            {{Form::password('old_password', array('class'=>'form-control'))}}
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu mới</label>
                            {{Form::password('password', array('class'=>'form-control'))}}
                        </div>
                        <div class="form-group">
                            <label for="password">Xác nhận mật khẩu mới</label>
                            {{Form::password('password_confirmation', array('class'=>'form-control'))}}
                        </div>
                        <img src="/images/loading.gif" alt="" style="display: none" id="loadingImgOnPage" />
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Xác nhận</button>
                        <button type="reset" class="btn btn-default">Nhập lại</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

@endsection