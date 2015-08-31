<?php

class UsersController extends \BaseController {

	public function __construct(){

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



}