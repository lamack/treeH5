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
        // $order = $this->getOrder();
        $page = 1;
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
        }
        if(isset($_GET['list_rows'])){
            // $limit = $page*$_GET['list_rows'];
            $limit = ($page-1)*$_GET['list_rows'] + 1;
        }else{
            
            $limit = ($page-1)*20 + 1;
            
        }

        $btn_3 = [
            'title' => '同步',
            'icon'  => 'fa fa-fw fa-copy',
            'class' => 'btn btn-primary ajax-get confirm',
            'data-title' => '确定更新排行数据吗？',
            'data-tips' => '同步数据量非常大，确认在网络不拥挤下执行操作',
            'href'  => url('synchro')
        ];

        // 数据列表
        $data_list = RankModel::where($map)->order('green DESC')->paginate();
        foreach ($data_list as $key => $value) {
            $rank = ($key)+$limit;
            // $data_list[$key]['rank'] = $rank;

            $data_list[$key]['green_max'] = _getGreen($value['user_id']);
            $data_list[$key]['share'] = _getShare($value['user_id']);
            $data_list[$key]['total_time'] = intval(_getTime($value['user_id']));

        }

        // 分页数据
        $page = $data_list->render(); 


        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('排行榜') // 设置页面标题
            ->setTableName('rank') // 设置数据表名
            // ->addOrder('green') // 添加排序
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
            ->addTopButton('custom', $btn_3) // 批量添加顶部按钮
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    public function synchro(){
        $sql = 'truncate table game_rank_temp';
        db("rank_temp")->execute($sql);

        $sql = 'INSERT INTO game_rank_temp
            (user_id)
  select user_id from game_rank';
        db("rank_temp")->execute($sql);
        $sql = 'UPDATE game_rank  a SET a.rank = (SELECT id FROM game_rank_temp WHERE user_id = a.user_id)';
        db("rank_temp")->execute($sql);
        
        $this->success('同步成功');
    }


}
