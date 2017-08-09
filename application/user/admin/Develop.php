<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Develop as DevelopModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 道具控制器
 * @package app\user\admin
 */
class Develop extends Admin
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
            $result = $this->validate($data, 'Develop');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            $post = DevelopModel::where('id', '1')->find();
            if ($post) {
                $data['id'] = 1;
                if ($develop = DevelopModel::update($data)) {
                    $this->success('编辑成功', url('index'));
                } else {
                    $this->error('编辑失败');
                }
            }else{
                if ($develop = DevelopModel::create($data)) {
                    $this->success('新增成功', url('index'));
                } else {
                    $this->error('新增失败');
                }
            }
            
        }

        // 获取数据
        $info = DevelopModel::where('id', '1')->find();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('form')
            ->setPageTitle('养成设置') // 设置页面标题
            ->addText('cash_trees', '', '', '', ['每棵树苗兑换需要', '点绿值'])
            ->addText('lives_tree', '', '', '', ['树苗长成果实树需要', '点生命值'])
            ->addText('develop_day', '', '', '', ['每天自然生长增加', '点生命值'])
            ->addText('lives_drought', '', '', '', ['发生干旱时，没有保护罩道具减掉', '点生命值'])
            ->addText('lives_flood', '', '', '', ['发生洪水时，没有保护罩道具减掉', '点生命值'])
            ->addText('lives_typhoon', '', '', '', ['发生台风时，没有保护罩道具减掉', '点生命值'])
            ->setFormData($info) // 设置表单数据
            ->fetch();
    }

    
}
