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
                @include('layouts._breadcrumb', array(
                       'lv3' => 'Đăng ký'
                   ))
                <header>
                    <h1 class="title single-title page-header">Đăng ký</h1>
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
                            <div class="form-group">
                                <label for="password_confirmation">Nhập lại mật khẩu</label>
                                {{Form::password('password_confirmation', array('class'=>'form-control', 'id'=>'passwordConfirmationOnPage'))}}
                            </div>
                            <img src="/images/loading.gif" alt="" style="display: none" id="loadingImgOnPage" />
                            <button type="button" class="btn btn-primary" onclick="registerOnPage()" id="regBtnOnPage"><i class="glyphicon glyphicon-ok"></i> Đăng ký</button>
                            <button type="reset" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Nhập lại</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<script>
    function registerOnPage(){
        username = $('#usernameOnPage').val();
        password = $('#passwordOnPage').val();
        password_confirmation = $('#passwordConfirmationOnPage').val();
        $('#loadingImgOnPage').show();
        $('#regBtnOnPage').hide();
        $.post('/user/create',
            { username:username, password:password, password_confirmation:password_confirmation }
            ,function(result){
                $('#ajaxMsgOnPage').show();
                $('#ajaxMsgOnPage label').html(result.msg);
                if(result.success){
                    location.reload();
                }else{

                }
                $('#loadingImgOnPage').hide();
                $('#regBtnOnPage').show();
            }, 'json');
    }
</script>
@endsection