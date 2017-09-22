<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Rank as RankModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 用户默认控制器
 * @package app\user\admin
 */
class Rank extends Admin
{
    /**
     * 用户首页
     * @return mixed
     */
    public function index()
    {
        cookie('__forward__', $_SERVER['REQUEST_URI']);

        // 获取查询条件
        $map = $this->getMap();
        $order = $this->getOrder();
        
        
        // 数据列表
        $data_list = RankModel::where($map)->order($order)->paginate();
        foreach ($data_list as $key => $value) {
            $rank = $key+1;
            $data_list[$key]['rank'] = $rank;

            $data_list[$key]['green_max'] = _getGreen($value['user_id']);
            $data_list[$key]['share'] = _getShare($rank);
            $data_list[$key]['total_time'] = _getTime($rank);

        }

        // 分页数据
        $page = $data_list->render();


        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('排行榜') // 设置页面标题
            ->setTableName('rank') // 设置数据表名
            ->addOrder('green') // 添加排序
            ->hideCheckbox()
            ->setSearch([ 'name' => '名称']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['rank', '名次'],
                ['type', '类型','','', [0 => '个人排名', 1 => '班组排名']],
                ['name', '名称'],
                ['green', '树苗数量'],

                ['green_max', '综合绿值'],
                ['share', '成长币'],
                ['total_time', '答题时间']
            ])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }


}
