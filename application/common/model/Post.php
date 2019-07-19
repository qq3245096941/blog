<?php

namespace app\common\model;

use think\Db;
use think\Model;

class Post extends Model
{
    protected $name = 'post';

    protected function initialize()
    {
        if (!Db::query("show tables like '" . config('database')['prefix'] . 'post' . "'")) {
            Db::execute("CREATE TABLE `".config('database')['prefix']."post` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `title` varchar(15) NOT NULL DEFAULT '',
                  `intro` varchar(150) NOT NULL,
                  `body` text NOT NULL,
                  `classify_id` int(11) NOT NULL COMMENT '当前帖子所属分类',
                  `comment_array` text NOT NULL,
                  `create_time` int(11) NOT NULL DEFAULT '0',
                  `update_time` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
        }
    }

    /*自动写入时间戳*/
    protected $autoWriteTimestamp = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    /*分类名称属性*/
    public function getClassifyNameAttr($value, $data)
    {
        return Classify::get($data['classify_id'])->name;
    }
}