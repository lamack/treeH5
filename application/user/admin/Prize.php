<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Prize as PrizeModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 奖品默认控制器
 * @package app\user\admin
 */
class Prize extends Admin
{
    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        cookie('__forward__', $_SERVER['REQUEST_URI']);

        // 获取查询条件
        $map = $this->getMap();

        // 数据列表
        $data_list = PrizeModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();

        
        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('奖品列表') // 设置页面标题
            ->setTableName('Prize') // 设置数据表名
            ->addColumns([ // 批量添加列
                ['user_id', '会员名称'],
                ['create_time', '获奖时间'],
                ['status', '状态'],
            ])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

   
}
