<?php


namespace app\common\model;
use think\Model;

class Comment extends Model
{
    protected $name = 'comment';
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;

    public function getPostAttr($data,$value){
        return Post::get($value['post_id']);
    }
}