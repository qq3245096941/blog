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

    }
}