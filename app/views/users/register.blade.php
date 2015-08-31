@extends('layouts.fronts', array(
    'title'=>'Đăng ký',
    'description'=>'Mô tả',
    'keyword'=>'Từ khoá'
    ))

@section('content')

<article class="article">
    <div id="content_box">
        <div class="post">
            <div class="single_post">
                <div class="breadcrumb"><a href="/">Home</a>   »   Đăng ký</div>
                <header>
                    <h1 class="title single-title page-header">Đăng ký</h1>
                </header>
                <div class="post-single-content box mark-links">
                    <div class="row">
                    {{Form::open(array('url'=>'/user/create', 'class'=>'col-md-8 col-xs-12'))}}
                            @include('layouts._messages')
                            <div class="form-group">
                                <label for="username">Tên đăng nhập</label>
                                {{Form::text('username', null, array('class'=>'form-control', 'autofocus'))}}
                            </div>
                             <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                {{Form::password('password', array('class'=>'form-control'))}}
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Nhập lại mật khẩu</label>
                                {{Form::password('password_confirmation', array('class'=>'form-control'))}}
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Đăng ký</button>
                            <button type="reset" class="btn btn-default">Nhập lại</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection