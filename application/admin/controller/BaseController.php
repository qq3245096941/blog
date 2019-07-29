<?php


namespace app\admin\controller;

use think\Controller;
use think\Session;

class BaseController extends Controller
{
    protected $methods = [];

    protected function _initialize()
    {
        /*操作方法名称*/
        $action = request()->action();
        /**
         * ajax检测
         */
        if (array_key_exists('ajax', $this->methods)) {
            if (in_array($action, $this->methods['ajax'])) {
                if (!request()->isAjax()) {
                    returnJson('请使用ajax提交', AJAX_SUBMIT);
                }
            }
        }

        /**
         * 管理员检测
         */
        if (array_key_exists('admin', $this->methods) == true) {
            if (in_array($action, $this->methods['admin'])) {
                if (Session::get('user') == null) {
                    /*是否是ajax请求*/
                    if (request()->isAjax()) {
                        returnJson('需要管理员权限，请登录', NO_ADMIN_AUTHORITY);
                    } else {
                        $this->redirect("/admin");
                    }
                }
            }
        }
    }
}