<?php


namespace app\admin\controller;

use app\admin\model\Classify;
use think\Controller;

class ClassifyController extends Controller
{

    /*创建，或者修改一个分类*/
    public function save()
    {
        $classify = new Classify();

        if (input('id')) {
            $classify->save(
                [
                    'name' => input('name'),
                    'sort' => input('sort')
                ], ['id' => input('id')]
            );
        } else {
            $classify->data([
                'name' => input('name'),
                'sort' => input('sort')
            ]);
            $classify->save();
        }
        $this->success("保存成功", "/classify/all");
    }

    /**
     * 删除一个分类
     */
    public function delete()
    {
        Classify::destroy(['id' => input('id')]);
        $this->success("删除成功", '/classify/all');
    }
}