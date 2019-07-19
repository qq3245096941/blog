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

Route::pattern([
    'id'=> '\d+',
]);

Route::group('admin/classify', [
    /*页面*/
    'all' => 'admin/url/classify_all',
    'create/[:id]' => 'admin/url/classify_create',
    /*删除*/
    'delete/:id' => 'admin/classify/delete',
    /*保存*/
    'save' => ['admin/classify/save', ['method' => 'post']]
]);
Route::group('admin/post',[
   /*页面*/
   'all'=>'admin/url/post_all',
   'create/[:id]'=>'admin/url/post_create',
    /*删除*/
    'delete/:id'=>'admin/post/delete',
    /*保存*/
    'save'=>['admin/post/save',['method'=>'post']],
    'classify_id/[:id]'=>['admin/url/post_by_classify']
]);

Route::get("admin",'admin/url/main');

/*前台模块*/
Route::get("/",'index/index/home');

