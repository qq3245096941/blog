<?php


namespace app\index\controller;

use think\Controller;

class IndexController extends Controller
{
    public function home(){
        return $this->fetch('home');
    }
}