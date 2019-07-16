<?php


namespace app\admin\model;

use think\Db;
use think\Model;

class Base extends Model
{
    protected function initialize()
    {
        $this->v1();
    }

    /*1.0版本*/
    private function v1()
    {
        if (!Db::query("show databases like 'blog'")) {
            /*创建数据库*/
            Db::query("create database 'blog'");
            /*创建数据表*/
            Db::query("CREATE TABLE `blog_classify` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(15) NOT NULL DEFAULT '',
                  `sort` tinyint(4) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
        }
    }
}