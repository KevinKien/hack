@extends('layouts.fronts', array(
    'title'=>'Đăng nhập',
    'description'=>'Mô tả',
    'keyword'=>'Từ khoá'
    ))

@section('content')

    <article class="article">
        <div id="content_box">
            <div class="post">
                <div class="single_post">
                    <div class="breadcrumb"><a href="/">Home</a>   »   Đăng nhập</div>
                    <header>
                        <h1 class="title single-title page-header">Đăng nhập</h1>
                    </header>
                    <div class="post-single-content box mark-links">
                        <div class="row">
                            {{Form::open(array('url'=>'#', 'class'=>'col-md-8 col-xs-12'))}}
                            <div class="form-group has-error" style="margin-bottom: 0; display: none" id="ajaxMsgOnPage">
                                <label class="control-label" for="inputError" ></label>
                            </div>
                            <div class="form-group">
                                <label for="username">Tên đăng nhập</label>
                                {{Form::text('username', null, array('class'=>'form-control', 'autofocus' ,'id'=>'usernameOnPage'))}}
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                {{Form::password('password', array('class'=>'form-control', 'id'=>'passwordOnPage'))}}
                            </div>
                            <img src="/images/loading.gif" alt="" style="display: none" id="loadingImgOnPage" />
                            <button type="button" class="btn btn-primary" onclick="loginOnPage()" id="logBtnOnPage"><i class="glyphicon glyphicon-ok"></i> Đăng nhập</button>
                            <button type="reset" class="btn btn-default">Nhập lại</button>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <script>
        function loginOnPage(){
            username = $('#usernameOnPage').val();
            password = $('#passwordOnPage').val();
            remember = $('#chkRemember').is(':checked')?1:0;
            $('#loadingImgOnPage').show();
            $('#logBtnOnPage').hide();
            $.post('/user/login',
                    { username:username, password:password, remember:remember }
                    ,function(result){
                        console.log(result);
                        $('#ajaxMsgOnPage').show();
                        $('#ajaxMsgOnPage label').html(result.msg);
                        if(result.success){
                            location.reload();
                        }else{

                        }
                        $('#loadingImgOnPage').hide();
                        $('#logBtnOnPage').show();
                    }, 'json');
        }
    </script>
@endsection