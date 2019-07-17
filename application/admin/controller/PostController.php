<?php


namespace app\admin\controller;

use app\admin\model\Post;
use think\Controller;

class PostController extends Controller
{
    /**
     * 保存帖子
     */
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
        $this->success('保存成功', '/post/all');
    }

    public function delete(){
        Post::destroy(input('id'));
        $this->success("删除成功",'/post/all');
    }
}