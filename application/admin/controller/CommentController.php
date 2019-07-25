<?php


namespace app\admin\controller;

use app\common\model\Comment;
use think\Controller;

/**
 * 评论提交控制器，使用ajax提交
 * Class Comment
 * @package app\admin\controller
 */
class CommentController extends Controller
{
    protected function _initialize()
    {
        if (!request()->isAjax()) {
            returnJson('请使用ajax提交', AJAX_SUBMIT);
        }
    }

    /*保存评论*/
    public function save()
    {
        $data = [
            'nickname' => '游客' . time(),
            'ip' => request()->ip(),
            'body' => input("body"),
            'post_id' => input('post_id')
        ];
        $comment = new Comment($data);
        $comment->save();

        $data['create_time'] = $comment->create_time;

        returnJson('提交成功', NORMAL, $data);
    }

    public function delete(){
        Comment::destroy(input('id'));
        $this->success("删除成功",'/admin/comment/all');
    }
}