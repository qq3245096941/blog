<?php


namespace app\admin\controller;

use think\Controller;

class UploadController extends BaseController
{
    protected $methods = [
        'ajax'=>['img'],
        'admin'=>['img']
    ];

    /**
     * 文件上传
     */
    public function img()
    {
        // 获取表单上传文件
        $file = request()->file('file');
        if (empty($file)) {
            returnJson('请上传file类型',NO_FILE);

        }
        /*移动文件到指定目录*/
        $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
        returnJson('文件上传成功',NORMAL,['img_url'=>DS . "static" . DS . "upload" . DS . $info->getSaveName()]);
    }
}