@extends('layouts.admin')

@section('content')
 <!-- Page Heading -->
    <div class="row" style="margin-bottom: 15px">
        <div class="col-lg-12">
            <h1 class="page-header">
                Bài viết
                <small>Bài viết mới</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/admin">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>  <a href="/admin/articles/list">Bài viết</a>
                </li>
                <li class="active">
                    Bài viết mới
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            {{Form::open(array('url'=>'/admin/articles/new', 'class'=>'' , 'role'=>'form'))}}
@include('layouts._messages')
                <div class="form-group">
                    <label>Tiêu đề</label>
                    {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control required' , 'placeholder'=>'Nhập tiêu đề' ) ) }}
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    {{ Form::textarea( "description" , Input::old( "description" ) , array( 'class'=>'form-control' , 'rows'=>'2' ) ) }}
                </div>
                <div class="form-group">
                    <label>Từ khoá</label>
                    {{ Form::text( "keyword" , Input::old( "keyword" ) , array( 'class'=>'form-control' , 'placeholder'=>'Cách nhau bởi dấu phẩy' ) ) }}
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    {{ Form::textarea( "content" , Input::old( "content" ) , array( 'id'=>'contentContainer' , 'rows'=>'10' ) ) }}
                </div>

                 <div class="form-group">
                        <label>Active {{Form::checkbox('active', 1, 'checked')}}</label>
                    </div>

                <div class="form-group">
                    <div class="col-lg-5">
                        <a href="javascript:getTopicImg();" class="btn btn-info btn-sm" >Chọn ảnh chủ đề</a>
                        &nbsp;
                        <a id="btnRemoveTopicImg" href="javascript:removeTopicImg();" class="btn btn-danger btn-sm" >Xóa ảnh</a>
                        <div style="background: #F8F8F8; margin: 0 auto; padding: 5px">
                            <img id = "imgTopic" style="max-width: 180px; max-height: 180px">
                        </div>
                        <div>
                            <span id="spnFileName" class="bg-info"></span>
                        </div>
                    </div>
                    <input type="hidden" name="topicImg" id="topicImg" />
                </div>

                <div class="form-group" style="clear: both">
                    <label>Danh Mục <a data-toggle="modal" data-target="#addCate">[Thêm]</a></label><br>
                    {{ Form::select('categories[]', $allCates, null, array('multiple', 'class'=>'selectpicker show-tick', 'title'=>'Chọn 1 hoặc nhiều', 'id'=>'cboCates')) }}
                </div>
                <div class="form-group" style="width: 50%" id="block">
                    <label>Link tải</label>
                    <div class="old">
                    {{ Form::text( "text-link[]" , Input::old( "text-link" ) , array( 'class'=>'form-control' , 'placeholder'=>'Nhập tiêu đề' ) ) }}
                    {{ Form::text( "content-link[]" , Input::old( "content-link" ) , array( 'class'=>'form-control' , 'placeholder'=>'Nhập Link' ) ) }}
                    {{ Form::text( "price-link[]" , Input::old( "price-link" ) , array( 'class'=>'form-control' , 'placeholder'=>'Nhập giá' ) ) }}
                    <hr/>
                    </div>
                </div>
                <button type="button" id="addLink" class="btn btn-success">Thêm link mới</button>
                <div style="clear: both"></div>
                <hr/>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Lưu lại</button>
                    <button type="reset" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reset</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addCate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Thêm danh mục</h4>
          </div>
          <div class="modal-body">
            {{Form::open(array('url'=>'#'))}}
            <div class="form-group has-error">
                <label class="control-label" for="inputError" id="ajaxMsgCate"></label>
            </div>
            <div class="form-group">
                {{Form::text('cate_name', null, array('class'=>'form-control', 'id'=>'txtCatename', 'placeholder'=>'Tên danh mục'))}}
            </div>
            <div class="form-group">
                {{Form::text('cate_alias', null, array('class'=>'form-control', 'id'=>'txtCateAlias', 'placeholder'=>'Dạng url (VD: tin-tuc)'))}}
            </div>
            {{Form::close()}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" onclick="saveCate();">Lưu lại</button>
          </div>
        </div>
      </div>
    </div>
<script>
        $(function() {
            $('#txtTitle').focus();
            $('.selectpicker').selectpicker();
            $('#btnRemoveTopicImg').hide();
            $('#addLink').click(function(){
                var html = $('#block .old:last').html();
                $('#block').append(html);
            });
        });

        function saveCate(){
            cate_name = $('#txtCatename').val();
            cate_alias = $('#txtCateAlias').val();
            $.post('/admin/categories/new',
             { cate_name:cate_name, cate_alias:cate_alias },
             function(result){
                if(result.success){
                    addCateToSelect(cate_name, result.id);
                    $('#addCate').modal('hide');
                    refeshAddCate();
                }else{
                    $('#ajaxMsgCate').html(result.msg);
                }
             },
             'json');
        }

        function addCateToSelect(cateName, cateId){
            $('#cboCates').append('<option value="'+cateId+'">'+cateName+'</option>');
            inner = $('button[data-id="cboCates"]').parent('.btn-group').find('.inner');
            lastRel = inner.children().last().attr('rel');
            nextRel = parseFloat(lastRel) + 1;
            text = '<li rel="'+(nextRel)+'">' +
                         '<a tabindex="0" class="" style="">' +
                          '<span class="text">'+cateName+'</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i>' +
                           '</a>' +
                           '</li>';
            inner.append(text);
        }

        function refeshAddCate(){
            $('#txtCatename').val('');
            $('#txtCateAlias').val('');
            $('#ajaxMsgCate').html('');
        }

        function getTopicImg(){
            //alert('222');

            try{
                var finder = new CKFinder();
                finder.basePath = '/lib/ckfinder/';	// The path for the installation of CKFinder (default = "/ckfinder/").
                finder.selectActionFunction = setTopicFile;
                finder.popup();
            }catch(err){
                alert(err);
            }
        }

        function setTopicFile(fileUrl){
            $("#imgTopic").attr("src",  fileUrl );
            $("#btnRemoveTopicImg").show();
            $('#spnFileName').html(fileUrl);
            $('#topicImg').val(fileUrl);
        }

        function removeTopicImg(){
            $("#imgTopic").removeAttr("src");
            $("#btnRemoveTopicImg").hide();
            $('#spnFileName').html('');
            $('#topicImg').val('');
        }

        var editor;
        tougleEditor();

        function tougleEditor(){
            if ( editor )
                editor.destroy();
            editor = CKEDITOR.replace( "contentContainer" ,{
                filebrowserBrowseUrl : '/lib/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : '/lib/ckfinder/ckfinder.html?Type=Images',
                filebrowserFlashBrowseUrl : '/lib/ckfinder/ckfinder.html?Type=Flash',
                filebrowserUploadUrl : '/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : '/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                customConfig : '/lib/ckeditor/config.js',
                language: 'vi'
            });
        }
</script>
@endsection