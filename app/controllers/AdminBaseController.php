<?php

class AdminBaseController extends \BaseController {

    protected $whitelist = array(

    );

    public function __construct(){
        $this->beforeFilter('auth', array('except'=> $this->whitelist ));
        $this->beforeFilter('permission', array('except'=> $this->whitelist ));
    }

    public function index()
    {
        return View::make('admin.dashboard');
    }

}