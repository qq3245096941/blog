<?php


namespace app\admin\controller;

use think\Controller;
use think\Session;

class BaseController extends Controller
{
    protected function _initialize()
    {
        if (Session::get("user") == null) {
            /*如果是ajax请求则返回json*/
            if (request()->isAjax()) {
                json(["message" => '您没有登录', "status" => NO_ADMIN_AUTHORITY])->send();
                exit();
            }

            $this->redirect('/admin');
        }
    }
}