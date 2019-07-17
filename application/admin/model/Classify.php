<?php


namespace app\admin\model;

use think\Db;
use think\Model;

class Classify extends Model
{
    protected $name = 'classify';

    protected function initialize()
    {
        if (!Db::query("show tables like '" . config('database')['prefix'] . 'classify' . "'")) {
            Db::execute("CREATE TABLE `".config('database')['prefix']."blog_classify` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(100) NOT NULL DEFAULT '',
                  `sort` tinyint(4) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;");
        }
    }

}