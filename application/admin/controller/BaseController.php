<?php


namespace app\admin\controller;
use think\Controller;
use think\Session;

class BaseController extends Controller
{

    protected function _initialize()
    {
        if(Session::get("user")==null){
            $this->redirect('/admin');
        }
    }
}