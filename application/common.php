<?php

use think\Session;

define("NORMAL", 10000); //正常
define("NO_ADMIN_AUTHORITY", 10001); /*没有管理员权限或者未登录*/
define("NO_FILE", 10002);//没有指定上传文件
//评论
define("AJAX_SUBMIT", 10003);//请使用ajax提交

function returnJson($message = '', $status = NORMAL, $data = [])
{
    json(['message' => $message, 'status' => $status, 'data' => $data])->send();
    exit();
}