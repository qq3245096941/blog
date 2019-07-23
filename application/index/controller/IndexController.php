<?php


namespace app\index\controller;

use app\common\model\Classify;
use app\common\model\Post;
use think\Controller;

class IndexController extends Controller
{
    public function home(){
        /*当前点击的页码数*/
        $current_page = 1;
        /*每页的帖子条数*/
        $current_page_num = 6;

        if(input("page")!=null){
            $current_page = input("page");
        }

        $post = new Post();
        /*获取分页总数*/
        $count = ceil(count($post->select())/$current_page_num);

        /*查询当前页码数的数据*/
        $post_list = $post->page($current_page,$current_page_num)->order("create_time","desc")->select();

        $this->assign('post_list',$post_list)->assign('count',$count)
            ->assign('current_page',$current_page)->assign("classify_list",Classify::all());//所有分类

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
        $post = Post::get(input('id'));
        $classify = Classify::get(['id'=>$post->classify_id]);
        return $this->assign('post',$post)->assign('classify',$classify)->fetch('particulars');
    }
}