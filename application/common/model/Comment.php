<?php


namespace app\common\model;
use think\Model;

class Comment extends Model
{
    protected $name = 'comment';
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;


    /**
     * 创建一个表中不存在的字段，通过对象的post属性获取
     */
    public function getPostAttr($data,$value){
        return Post::get($value[$data]);
    }
}