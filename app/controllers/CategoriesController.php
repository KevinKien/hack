<?php

class CategoriesController extends AdminBaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function postNew(){
        if(!Input::has('cate_name') || !Input::has('cate_alias'))
            return Response::json(array('success'=>false, 'msg'=>'Thiếu thông tin!'));
        $checkCate = Category::where('alias', Input::get('alias'))->first();
        if($checkCate)
            return Response::json(array('success'=>false, 'msg'=>'Danh mục trùng lặp!'));

        $newRecord = new Category();
        $newRecord->name = Input::get('cate_name');
        $newRecord->alias = Input::get('cate_alias');
        if(!$newRecord->save())
            return Response::json(array('success'=>false, 'msg'=>'Lỗi DB!'));

        return Response::json(array('success'=>true, 'id'=>$newRecord->id));
    }
}