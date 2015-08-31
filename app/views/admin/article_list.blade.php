@extends('layouts.admin')

@section('content')
 <!-- Page Heading -->
    <div class="row" style="margin-bottom: 15px">
        <div class="col-lg-12">
            <h1 class="page-header">
                Bài viết
                <small>Danh sách</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/admin">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Bài viết
                </li>
            </ol>
        </div>
        <div class="col-lg-12">
            <a href="/admin/articles/new" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i>Thêm mới</a>
        </div>
    </div>
    <!-- /.row -->

     {{Form::open(array('url'=>'/admin/articles/list', 'method'=>'get', 'role'=>'form'))}}
        <div class="form-group">
            <div class="row">
                <div class="col-xs-4">
                    {{Form::text('title',Input::get('title'),array('class'=>'form-control input-sm','placeholder'=>'Tiêu đề:'))}}
                </div>
                <div class="col-xs-2">
                    {{Form::select('category_id', array(''=>'--Tìm theo nhóm--')+$allCates, Input::get('category_id'), array('class'=>'form-control input-sm'))}}
                </div>
                <div class="col-xs-2">
                    {{Form::text('start_time',Input::get('start_time'),array('class'=>'form-control input-sm','placeholder'=>'Từ:', 'id'=>'start_time'))}}
                </div>
                <div class="col-xs-2">
                    {{Form::text('end_time',Input::get('end_time'),array('class'=>'form-control input-sm','placeholder'=>'Đến:', 'id'=>'end_time'))}}
                </div>
                <div class="col-xs-1">
                    {{Form::button('Tìm', array('class'=>'btn btn-success btn-sm', 'type'=>'submit'))}}
                </div>
            </div>
        </div>
        {{Form::close()}}

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Ngày tạo</th>
                        <th>Active</th>
                         <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{($item->active ==1)?'Có': 'Không'}}</td>
                        <td>
                            <div class="pull-right">
                                <a href="/admin/articles/edit/{{$item->id}}" class="btn btn-sm btn-primary">Sửa</a>
                                <a href="javascript:deleteArticle({{$item->id}})" class="btn btn-sm btn-danger">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <section class="text-center">
                {{$items->appends(array(
                'title'=>Input::get('title'),
                'start_date'=>Input::get('start_date'),
                'end_date'=>Input::get('end_date'),
                'category_id'=>Input::get('category_id')
                ))->links()}}
                </section>
        </div>
    </div>
</div>
<!-- /.row -->

<script type="text/javascript">
        function deleteArticle(id){
            bootbox.confirm("Bạn chắc chắn muốn xóa?", function(result) {
                if(result){
                    window.location.href = '/admin/articles/delete/' + id;
                }
            });
            $(function(){
                $('.selectpicker').selectpicker();
            });
        }
    </script>
@endsection