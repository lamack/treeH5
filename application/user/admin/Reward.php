<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Rward as RwardModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 奖品控制器
 * @package app\user\admin
 */
class Reward extends Admin
{
    /**
     * 道具
     * @return mixed
     */
    public function index()
    {
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证
            $result = $this->validate($data, 'Rward');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            $post = RwardModel::where('id', '1')->find();
            if ($post) {
                $data['id'] = 1;
                if ($develop = RwardModel::update($data)) {
                    $this->success('编辑成功', url('index'));
                } else {
                    $this->error('编辑失败');
                }
            }else{
                if ($develop = RwardModel::create($data)) {
                    $this->success('新增成功', url('index'));
                } else {
                    $this->error('新增失败');
                }
            }
            
        }

        // 获取数据
        $info = RwardModel::where('id', '1')->find();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('form')
            ->setPageTitle('奖品设置') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['text', 'green_limit', '绿值最小值', ''],
                ['text', 'green_max', '绿值最大值', ''],
                // ['text', 'share_limit', '成长币最小值', ''],
                // ['text', 'share_max', '成长币最大值', ''],
            ])
            ->setFormData($info) // 设置表单数据
            ->fetch();
    }

    
}
