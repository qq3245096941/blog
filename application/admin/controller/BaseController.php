<?php


namespace app\admin\controller;


use think\Controller;
use think\Session;

class BaseController extends Controller
{
    protected $methods = [];

    protected function _initialize()
    {
        /*判断当前方法是否存在于数组中*/
        if (!in_array(request()->action(), $this->methods)) {
            return;
        }
        /**
         * ajax检测
         */
        if($this->methods[request()->action()]['ajax']){
            if (!request()->isAjax()) {
                returnJson('请使用ajax提交', AJAX_SUBMIT);
                exit();
            }

        }
        /**
         * 管理员检测
         */
        if($this->methods[request()->action()]['admin']){
            if (Session::get('user') == null) {
                if (request()->isAjax()) {
                    json(["message" => '您没有登录', "status" => NO_ADMIN_AUTHORITY])->send();
                    exit();
                } else {
                    $this->redirect('/admin');
                }
            }
        }
    }
}