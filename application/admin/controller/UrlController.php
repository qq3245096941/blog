<?php

namespace app\admin\controller;
use app\common\model\Classify;
use app\common\model\Post;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

/**
 * 路径跳转专用控制器，传入两个参数，$title，$nav
 */
class UrlController extends Controller
{
    private $user = ['email'=>"3245096941@qq.com",'password'=>'miao1995'];

    /**
     * 登录
     */
    public function login(){
        $request = Request::instance();

        /*判断请求是否是post请求，如果是则说明是信息提交*/
        if($request->method('true')=='POST'){
            if(input('email')==$this->user['email']&&input('password')==$this->user['password']){
                /*将用户信息保存在session中*/
                Session::set("user",$this->user);
                $this->success("登录成功",'/admin');
            }
        }

        return $this->fetch('common@public/login');
    }

    /**
     * 跳转到总览
     */
    public function main()
    {
        $this->assign("post_list",Post::all())->assign("classify_list",Classify::all());
        return $this->create_url('总览', 'main', 'main/index');
    }

    /**
     * 所有帖子
     */
    public function post_all()
    {
        $post = new Post();
        $post_list = $post->order("create_time",'desc')->select();
        //classify_id表示点击“全部”标签
        $this->assign('post_list', $post_list)->assign("classify_list",Classify::all())->assign('classify_id',-1);
        return $this->create_url('所有帖子', 'post', 'post/all');
    }

    /**
     * 通过类获取当前所有帖子
     */
    public function post_by_classify(){
        $post = new Post();

        if(input('id')){
            $post_list = $post->where(['classify_id'=>input("id")])->order('create_time')->select();
            $this->assign('classify_id',input('id'));
        }else{
            $post_list = $post->order('create_time')->select();
            $this->assign('classify_id',-1);
        }

        $this->assign('post_list', $post_list)->assign("classify_list",Classify::all());

        return $this->create_url('所有帖子', 'post', 'post/all');
    }

    /**
     * 创建帖子
     */
    public function post_create()
    {
        $classify_list = Classify::all();
        $this->assign("classify_list", $classify_list);
        $this->assign("currentClassify",$classify_list[0]);

        if (input('id')) {
            $post = Post::get(input('id'));
            $currentClassify = Classify::get(['id'=>$post->classify_id]);

            $this->assign('post', $post)->assign('currentClassify',$currentClassify);
        }
        return $this->create_url('创建帖子', 'post', 'post/create');
    }

    /**
     * 所有分类
     */
    public function classify_all()
    {
        $classify_list = Db::table(config('database')['prefix'] . 'classify')->order('sort')->select();
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
    private function create_url($title = '', $nav_title = '', $template_url = '')
    {
        return $this->assign("title", $title)->assign("nav", [$nav_title => 'active open'])->fetch($template_url);
    }
}