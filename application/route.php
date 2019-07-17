<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::rule([
    /*总览*/
    '/'=>'admin/url/index',
    /*分类*/
    'page/classify/create/[:id]'=>'admin/url/classify_create',
    'page/classify/all'=>'admin/url/classify_all',
    'classify/save'=>'admin/classify/save',
    'classify/delete/:id'=>'admin/classify/delete',
    /*帖子*/
    'page/post/create/[:id]'=>'admin/url/post_create'
]);