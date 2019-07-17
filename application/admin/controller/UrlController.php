<?php


namespace app\admin\controller;

use app\admin\model\Classify;
use http\Client\Curl\User;
use think\Controller;
use think\Db;

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

        return $this->create_url('总览', 'index', "index/index");
    }

    /**
     * 所有帖子
     */
    public function post_all()
    {

    }

    public function post_create(){
        /*获取所有分类*/
        $this->assign("classify_list",Classify::all());

        return $this->create_url('创建帖子','post','post/create');
    }

    /**
     * 获取所有的分类
     * @return UrlController
     * @throws \think\exception\DbException
     */
    public function classify_all()
    {
        $classify_list = Db::table(config('database')['prefix'].'classify')->order('sort')->select();
        $this->assign("classify_list", $classify_list);
        return $this->create_url('所有分类', 'classify', 'classify/all');
    }

    /**
     * 创建分类
     */
    public function classify_create()
    {
        /*判断参数中是否有id字段，从而判断是否是修改*/
        if (input('id')) {
            $this->assign('classify', Classify::get(input('id')));
            return $this->create_url('修改分类', 'classify', 'classify/create');
        }
        return $this->create_url('创建分类', 'classify', 'classify/create');
    }

    /**
     * @param string $title 传入模板的标题
     * @param string $nav_title 当前导航的标示
     * @return UrlController
     */
    private function create_url($title = '', $nav_title = '', $url = '')
    {
        return $this->assign("title", $title)->assign("nav", [$nav_title => 'active open'])->fetch($url);
    }
}