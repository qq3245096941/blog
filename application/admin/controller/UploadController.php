<?php


namespace app\admin\controller;

use think\Controller;

class UploadController extends Controller
{
    use \RequestIntercept;

    protected $admin_methods = ['img'];

    /**
     * 文件上传
     */
    public function img()
    {
        // 获取表单上传文件
        $file = request()->file('file');

        if (empty($file)) {
            json(['message' => "您没有登录，或没有权限", 'status' => NO_FILE])->send();
            exit();
        }
        /*移动文件到指定目录*/
        $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');

        json(['message' => '文件上传成功', 'status'=>NORMAL,'img_url'=>DS . "static" . DS . "upload" . DS . $info->getSaveName()])->send();
        exit();
    }
}