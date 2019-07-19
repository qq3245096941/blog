<?php


namespace app\admin\controller;
use think\Controller;
use think\Session;

class BaseController extends Controller
{

    protected function _initialize()
    {
        if(Session::get("user")==null){
            $this->error("您未登录，请登录",'/login');
        }
    }
}