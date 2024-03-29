<?php


namespace app\admin\controller;

use app\common\model\Classify;
use think\Controller;

class ClassifyController extends BaseController
{
    protected $methods = [
        'admin'=>['save','delete']
    ];

    /*创建，或者修改一个分类*/
    public function save()
    {
        $classify = new Classify();
        $classify = $classify->allowField(true);

        if (input('id')) {
            $classify->save($_POST, input('id'));
        } else {
            $classify->data($_POST);
            $classify->save();
        }
        $this->success("保存成功", "/admin/classify/all");
    }

    /**
     * 删除一个分类
     */
    public function delete()
    {
        Classify::destroy(['id' => input('id')]);
        $this->success("删除成功", '/admin/classify/all');
    }
}