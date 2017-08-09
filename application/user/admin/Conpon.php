<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Conpon as ConponModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 优惠券类型默认控制器
 * @package app\user\admin
 */
class Conpon extends Admin
{
    /**
     * 养成首页
     * @return mixed
     */
    public function index()
    {
        cookie('__forward__', $_SERVER['REQUEST_URI']);

        // 获取查询条件
        $map = $this->getMap();

        // 数据列表
        $data_list = ConponModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();

        $btn_1 = [
                'title' => '导入',
                'icon'  => 'fa fa-fw fa-copy',
                'class' => 'btn btn-primary ajax-post',
                'href'  => url('import')
            ];
        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('优惠券列表') // 设置页面标题
            ->setTableName('Conpon') // 设置数据表名
            ->addColumns([ // 批量添加列
                ['conpon_type', '类型'],
                ['conpon_no', '券号'],
                ['conpon_password', '密码'],
                ['conpon_status', '状态'],
            ])
            ->addTopButton('custom', $btn_1) // 批量添加顶部按钮
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    public function import()
    {
        echo json_encode('value');exit;
        $this->success('备份完成！');
    }
   
}
