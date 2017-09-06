<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Prize as PrizeModel;
use app\user\model\Member as MemberModel;
use app\user\model\Conpon as ConponModel;
use app\user\model\Conpontepy as ConpontepyModel;
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
        if ($map) {
            if (isset($map['create_time'])) {
                $map['a.create_time'] = $map['create_time'];
                unset($map['create_time']);
            }
            
        }
        // 数据列表
        $data_list = db('recode')->alias('a')->join('game_conpon ct','a.conpon_id = ct.id')->join('game_member m','a.user_id = m.id')->where($map)->field('a.*,ct.conpon_no,ct.conpon_password,m.username,m.contact')->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();

        $list_module = MemberModel::where(1)->order('id desc')->column('id,username');

        $list_module1 = db('conpon')->alias('a')->join('game_conpon_type ct','a.conpon_type = ct.id')->column('a.id as id,ct.conpon_name as name');
        // $list_module2 = ConponModel::where(1)->column('id,conpon_no');
        // $list_module3 = ConponModel::where(1)->column('id,conpon_password');
        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('奖品列表') // 设置页面标题
            ->setTableName('Prize') // 设置数据表名
            ->hideCheckbox()
            ->addTimeFilter('create_time') // 添加时间段筛选
            ->setSearch(['username' => '用户名', 'contact' => '手机号']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['user_id', '会员名称','','',$list_module],
                ['create_time', '获奖时间','datetime'],
                ['conpon_id', '类型','','',$list_module1],
                ['conpon_no', '券号','',''],
                ['conpon_password', '密码','',''],
                ['status', '状态','','',[0 => '未使用', 1 => '使用']],
            ])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

   
}
