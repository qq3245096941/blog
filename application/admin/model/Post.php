<?php


namespace app\admin\model;


class Post extends Base
{
    protected $name = 'post';
    /*自动写入时间戳*/
    protected $autoWriteTimestamp = true;
}