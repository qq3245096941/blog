<?php

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

/*文件上传*/
Route::group("upload",[
    /*图片*/
    'img'=>'admin/upload/img'
]);


/*后台首页*/
Route::get("admin",'admin/url/main');

/*前台首页*/
Route::get("/","index/index/home");

Route::get("page/[:page]",'index/index/home');

/*帖子详情*/
Route::get("particulars/:id","index/index/post_particulars");

/*关于作者*/
Route::get("author",'index/index/author');

