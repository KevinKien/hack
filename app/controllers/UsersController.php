<?php

class UsersController extends \BaseController {

	public function __construct(){
        $this->beforeFilter('guest', array('only'=>array(
            'getLogin',
            'getRegister',
            'postCreate',
            'postLogin'
        )));
        $this->beforeFilter('auth', array('only'=>array(
            'getChangePass',
            'postChangePass'
        )));
    }

    public function getRegister(){
        return View::make('users.register');
    }

    public function postCreate(){
        $validator = Validator::make(Input::all(), User::$rules);
        if (!$validator->passes()) {
            return Response::json(array('success'=>false, 'msg'=>$validator->errors()->first()));
        }

        $user = new User();
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        if(!$user->save()){
            return Response::json(array('success'=>false, 'msg'=>'Lỗi Database!'));
        }

        Auth::login($user);
        return Response::json(array('success'=>true, 'msg'=>'Đăng ký thành công!'));
    }

    public function getLogin(){
        return View::make('users.login');
    }

    public function postLogin(){
        if(!Input::has('username') || !Input::has('password'))
            return Response::json(array('success'=>false, 'msg'=>'Bạn cần nhập đủ thông tin!'));

        $remember = (Input::get('remember') == 1) ? true : false;
        if ((Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')), $remember))) {
            return Response::json(array('success'=>true, 'msg'=>'Đăng nhập thành công!'));
        } else {
            return Response::json(array('success'=>false, 'msg'=>'Tên đăng nhập/Mật khẩu không đúng!'));
        }
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function getChangePass(){
        return View::make('users.change-pass');
    }

    public function postChangePass(){
        $old_pass = Input::get('old_password');
        if(!Hash::check($old_pass, Auth::user()->password))
           return Redirect::back()->with('error', 'Mật khẩu cũ không chính xác!');

        $rules = User::$rules;
        unset($rules['username']);
        $validator = Validator::make(Input::all(), $rules);
        if (!$validator->passes()) {
            return Redirect::back()->with('error', $validator->errors()->first());
        }

        $user = Auth::user();
        $user->password = Hash::make(Input::get('password'));
        if(!$user->save())
            return Redirect::back()->with('error', 'Có lỗi xảy ra, xin thử lại sau!');

        return Redirect::back()->with('success', 'Bạn đã thay đổi mật khẩu thành công!');
    }
}