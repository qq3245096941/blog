<?php


namespace app\admin\controller;

use app\admin\model\Classify;
use http\Client\Curl\User;
use think\Controller;

/**
 * 路径跳转专用控制器，传入两个参数，$title，$nav
 */
class UrlController extends Controller
{
    /**
     * 跳转到总览
     */
    public function index()
    {

        return $this->create_url('总览','index')->fetch("index/index");
    }

    /**
     * 创建帖子
     */
    public function post_all()
    {

    }

    public function classify_all(){
        /*获取所有的类*/
        $classify_list = Classify::all();
        $this->assign("classify_list",$classify_list);

        return $this->create_url('所有分类','classify')->fetch('classify/all');
    }

    /**
     * 创建分类
     */
    public function classify_create(){
        if(input('id')){
            $this->assign('classify',Classify::get(input('id')));
        }

        return $this->create_url('创建分类','classify')->fetch('classify/create');
    }

        /**
     * @param string $title 传入模板的标题
     * @param string $nav_title 当前导航的标示
     * @return UrlController
     */
    public function create_url($title = '', $nav_title = '')
    {
        return $this->assign("title", $title)->assign("nav", [$nav_title => 'active open']);
    }
}