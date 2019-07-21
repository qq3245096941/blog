<?php


namespace app\index\controller;

use app\common\model\Post;
use think\Controller;

class IndexController extends Controller
{
    public function home(){
        $this->assign('post_list',Post::all());
        return $this->fetch('home');
    }
}