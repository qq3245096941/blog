<?php


namespace app\admin\controller;

use app\common\model\Post;
use think\Controller;

class PostController extends BaseController
{
    protected $methods = [
        'admin'=>['save','delete']
    ];

    /*保存帖子*/
    public function save()
    {
        $post = new Post();
        /*过滤非数据表字段*/
        $post = $post->allowField(true);

        if (input('id')) {
            $post->save($_POST, input('id'));
        } else {
            $post->data($_POST);
            $post->save();
        }
        $this->success("保存成功","/admin/post/all");
    }

    /*删除帖子*/
    public function delete(){
        Post::destroy(input('id'));
        $this->success("删除成功",'/admin/post/all');
    }
}