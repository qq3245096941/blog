<?php


namespace app\admin\controller;

use app\common\model\Img;
use think\Controller;
use think\File;

class UploadController extends BaseController
{
    protected $methods = [
        'ajax'=>['img',"delete"],
        'admin'=>['img',"delete"]
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
        $img_url = DS . "static" . DS . "upload" . DS . $info->getSaveName();

        /*将图片保存进数据库*/
        $img = new Img([
            "url"=>$img_url
        ]);
        $img->save();
        returnJson('文件上传成功',NORMAL,["img"=>$img]);
    }

    /**
     * 获取所有图片
     */
    public function all(){
        $img = new Img();
        $img_list = $img->order('create_time',"desc")->select();
        returnJson("保存成功",NORMAL,["img_list"=>$img_list]);
    }

    /**
     * 删除指定的文件
     */
    public function delete(){
        $img = Img::get(input("id"));

        /*删除文件*/
        unlink(__DIR__.'/../../../public'.$img->url);

        /*删除数据库数据*/
        Img::destroy(input("id"));

        returnJson("删除成功",NORMAL,["id"=>input('id')]);
    }
}