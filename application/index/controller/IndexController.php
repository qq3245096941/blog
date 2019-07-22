<?php


namespace app\index\controller;

use app\common\model\Post;
use think\Controller;

class IndexController extends Controller
{
    public function home(){
        /*当前点击的页码数*/
        $current_page = 1;

        if(input("page")!=null){
            $current_page = input("page");
        }

        $post = new Post();
        /*获取分页总数*/
        $count = ceil(count($post->select())/4);

        /*查询当前页码数的数据*/
        $post_list = $post->page($current_page,5)->order("create_time","desc")->select();

        $this->assign('post_list',$post_list)->assign('count',$count)->assign('current_page',$current_page);

        return $this->fetch('home');
    }

    /**
     * 关于作者
     */
    public function author(){
        return $this->fetch('author');
    }

    /**
     * 帖子详情
     */
    public function post_particulars(){
        return $this->assign('post',Post::get(input('id')))->fetch('particulars');
    }
}