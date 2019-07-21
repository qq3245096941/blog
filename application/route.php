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

/*登录*/
Route::rule('login','admin/url/login');

/*分类*/
Route::group('admin/classify', [
    /*页面*/
    'all' => 'admin/url/classify_all',
    'create/[:id]' => 'admin/url/classify_create',
    /*删除*/
    'delete/:id' => 'admin/classify/delete',
    /*保存*/
    'save' => ['admin/classify/save', ['method' => 'post']]
]);

/*帖子*/
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

/*接口*/
Route::group('admin/url',[
    'create/[:id]'=>'admin/url/url_create',
]);

/*后台首页*/
Route::get("admin",'admin/url/main');

/*前台首页*/
Route::get("/[:page]",'index/index/home');

/*关于作者*/
Route::get("author",'index/index/author');

