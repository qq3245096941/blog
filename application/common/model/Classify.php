<?php


namespace app\common\model;

use think\Db;
use think\Model;

class Classify extends Model
{
    protected $name = 'classify';

    /*帖子数量属性*/
    public function getPostNumAttr($value, $data)
    {
        return count(Post::all(['classify_id' => $data['id']]));
    }
}