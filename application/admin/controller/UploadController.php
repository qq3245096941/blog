<?php


namespace app\admin\controller;


use think\Request;

class UploadController extends BaseController
{
    /**
     * 文件上传
     */
    public function img()
    {
        // 获取表单上传文件
        $file = request()->file('file');

        if (empty($file)) {
            $this->error('请选择上传文件');
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
        $filename = $info->getSaveName();
        if ($filename) {
            $this->success('文件上传成功！','',['img_url'=>DS."static".DS."upload".DS.$filename]);
        } else {
            $this->error($file->getError());
        }
    }
}