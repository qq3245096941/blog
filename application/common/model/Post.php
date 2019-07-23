<?php

namespace app\common\model;

use think\Db;
use think\Model;

class Post extends Model
{
    protected $name = 'post';

    /*自动写入时间戳*/
    protected $autoWriteTimestamp = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    /*分类名称*/
    public function getClassifyNameAttr($value, $data)
    {
        return Classify::get($data['classify_id'])->name;
    }
}