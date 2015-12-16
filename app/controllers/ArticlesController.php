<?php

class ArticlesController extends AdminBaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getList()
	{
        $query = Article::leftJoin('article_category', 'articles.id', '=', 'article_category.article_id');
        if(Input::has('title'))
        {
            $query->where('title','LIKE','%'.Input::get('title').'%');
        }
        if(Input::has('articles.start_date'))
        {
            $query->where('created_at','>=',date("Y-m-d H:i:s", strtotime(Input::get('start_date'))));
        }
        if(Input::has('articles.end_date'))
        {
            $query->where('created_at','<=',date("Y-m-d 23:59:59", strtotime(Input::get('end_date'))));
        }
        if(Input::has('category_id'))
        {
            $query->where('article_category.category_id','=', Input::get('category_id'));
        }

        $query = $query->groupBy('articles.id')->orderBy('articles.created_at','desc')->select('articles.id as id', 'title', 'articles.created_at as created_at', 'active')->paginate(10);
        $allCates = Category::lists('name','id');

        return View::make('admin.article_list')->with('items',$query)->with('allCates', $allCates);
	}

    public function getNew(){
        $allCates = Category::lists('name','id');
        return View::make('admin.article_new')->with('allCates', $allCates);
    }

    public function postNew(){
        DB::beginTransaction();
        try{
            $newRecord = new Article();
            $newRecord->title = Input::get('title');
            $newRecord->description = Input::get('description');
            $newRecord->keyword = Input::get('keyword');
            $newRecord->content = Input::get('content');
            $newRecord->thumb = Input::get('topicImg');
            $newRecord->active = Input::has('active')? 1: 0;
            $newRecord->is_hot = Input::has('is_hot')? 1: 0;
            $newRecord->slug = CommonHelper::vietnameseToASCII($newRecord->title);
            $newRecord->save();

            //Lưu category
            if(Input::has('categories')){
                foreach(Input::get('categories') as $aCate){
                    $newArticleCategory = new ArticleCategory();
                    $newArticleCategory->article_id = $newRecord->id;
                    $newArticleCategory->category_id = $aCate;
                    $newArticleCategory->save();
                }
            }

            //Lưu link
            if(Input::has('text-link')){
                foreach(Input::get('text-link') as $key=>$val){
                    $newLink = new Link();
                    $newLink->article_id = $newRecord->id;
                    $newLink->text = $val;
                    $newLink->content = Input::get('content-link')[$key];
                    $newLink->price = Input::get('price-link')[$key];
                    $newLink->save();
                }
            }

        }catch (Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error',$e->getMessage())->withInput();
        }
        DB::commit();
        return Redirect::to('/admin/articles/list');
    }

	public function getEdit($id)
	{
		$record = Article::find($id);
        if(!$record)
            throw new Exception('Bài viết không tồn tại!');

        $allCates = Category::lists('name','id');
        $articleCategory = $record->categories()->lists('category_id');
        $allLinks = Link::where('article_id', $id)->get();
        return View::make('admin.article_edit')->with(array(
            'item'=>$record,
            'allCates'=>$allCates,
            'articleCategory'=>$articleCategory,
            'allLinks'=>$allLinks
        ));
	}

	public function postEdit($id){
        DB::beginTransaction();
        try{
            $record = Article::find($id);
            $record->title = Input::get('title');
            $record->description = Input::get('description');
            $record->keyword = Input::get('keyword');
            $record->content = Input::get('content');
            $record->thumb = Input::get('topicImg');
            $record->active = Input::has('active')? 1: 0;
            $record->is_hot = Input::has('is_hot')? 1: 0;

            $record->save();

            //Lưu category
            ArticleCategory::where('article_id', $id)->delete();
            if(Input::has('categories')) {
                foreach (Input::get('categories') as $aCate) {
                    $newArticleCategory = new ArticleCategory();
                    $newArticleCategory->article_id = $id;
                    $newArticleCategory->category_id = $aCate;
                    $newArticleCategory->save();
                }
            }

            $allLinks = Link::where('article_id', $id)->lists('id');
            $allNewLink = array();
            if(Input::has('text-link')){
                foreach(Input::get('text-link') as $key=>$val){
                    if(Input::get('id-link')[$key] != ''){
                        $newLink = Link::find(Input::get('id-link')[$key]);
                    }else{
                        $newLink = new Link();
                    }
                    $newLink->article_id = $id;
                    $newLink->text = $val;
                    $newLink->content = Input::get('content-link')[$key];
                    $newLink->price = Input::get('price-link')[$key];
                    $newLink->save();
                    $allNewLink[] = $newLink->id;
                }
            }
            $allDeletedLink = Link::where('article_id', $id)->whereNotIn('id', $allNewLink);
            $allDeletedLink->delete();
        }catch (Exception $e){
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage())->withInput();
        }
        DB::commit();
        return Redirect::back()->with('success', 'Sửa thành công!');
    }

    public function getDelete($id){
        $record = Article::find($id);
        $record->delete();
        return Redirect::to('/admin/articles/list');
    }

    public function postKeyword(){
        $keyword = Input::get('keyword');
        if(!empty($keyword)){
            $all = CommonHelper::getAllKeyword($keyword);
            return Response::json(array('success'=>true, 'key'=> implode(',', $all)));
        }
        else{
            return Response::json(array('success'=>false));
        }
    }

    public function getTest(){
        var_dump(class_exists('cURL'));
    }

}