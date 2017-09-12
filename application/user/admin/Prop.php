<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Prop as PropModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 道具控制器
 * @package app\user\admin
 */
class Prop extends Admin
{
    /**
     * 道具
     * @return mixed
     */
    public function index()
    {
        cookie('__forward__', $_SERVER['REQUEST_URI']);

        // 获取查询条件
        $map = $this->getMap();

        // 数据列表
        $data_list = PropModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();
        // $btn_1 = [
        //         'title' => '设置',
        //         'icon'  => 'fa fa-fw fa-copy',
        //         'class' => 'btn btn-primary ',
        //         'href'  => url('setting', ['group' => '1'])
        //     ];
        $btn_2 = [
                'title' => '编辑',
                'icon'  => 'fa fa-fw fa-copy',
                'href'  => url('setting', ['group' => '__position__'])
            ];    

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('道具管理') // 设置页面标题
            ->setTableName('prop') // 设置数据表名
            ->hideCheckbox()
            ->addColumns([ // 批量添加列
                ['id', '编号'],
                ['prop_name', '名称'],
                ['prop_affect', '作用'],
                ['cash', '售价'],
                ['right_button', '操作', 'btn']
            ])
            // ->addTopButton('custom', $btn_1) // 批量添加顶部按钮
            ->addRightButton('custom', $btn_2) // 添加授权按钮
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }


    /**
     * 设置
     * @param string $group 分组

     * @return mixed
     */
    public function setting($group = '1')
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //
            $prop = PropModel::where('position', $group)->find();
            if ($prop) {
                if ($develop = PropModel::where('position', $group)->update($data)) {
                    $this->success('编辑成功', url('setting', ['group' => $group]));
                } else {
                    $this->error('编辑失败');
                }
            } else {
                //init
                $list_group = ['1'=>'浇水壶','2'=>'小铲子','3'=>'化肥','4'=>'保护罩'];
                $list_group_affect = ['1'=>'用于给树苗浇水','2'=>'用于给树苗除草','3'=>'用于给树苗施肥','4'=>'可以抵御一次自然灾害'];
                $data['prop_name'] = $list_group[$group];
                $data['prop_affect'] = $list_group_affect[$group];
                $data['position'] = $group;
                if ($develop = PropModel::create($data)) {
                    $this->success('新增成功', url('setting', ['group' => $group]));
                } else {
                    $this->error('新增失败');
                }
            }
            
        } else {
            // 配置分组信息
            $list_group = ['1'=>'浇水壶','2'=>'小铲子','3'=>'化肥','4'=>'保护罩'];
            $list_group_affect = ['1'=>'用于给树苗浇水','2'=>'用于给树苗除草','3'=>'用于给树苗施肥','4'=>'可以抵御一次自然灾害'];
            $tab_list   = [];
            foreach ($list_group as $key => $value) {
                $tab_list[$key]['title'] = $value;
                $tab_list[$key]['url']  = url('setting', ['group' => $key]);
            }
            $prop = PropModel::where('position', $group)->find();

            if ($prop) {
                if ($group==4) {
                    // 使用ZBuilder快速创建表单
                    return ZBuilder::make('form')
                    ->setPageTitle('道具设置')
                    ->setTabNav($tab_list, $group)
                    ->addFormItems([ // 批量添加表单项
                        ['static', 'prop_name', '道具名称','',$list_group[$group]],
                        ['static', 'prop_affect', '道具作用', '',$list_group_affect[$group]],
                    ])
                    ->addText('cash', '购买设置', '', '', ['', '成长币可以购买一个'])
                    // ->addText('use_limit', '使用限制', '', '', ['每天可以使用', '次'])
                    ->setFormData($prop) // 设置表单数据
                    ->fetch();
                }else{
                   // 使用ZBuilder快速创建表单
                    return ZBuilder::make('form')
                    ->setPageTitle('道具设置')
                    ->setTabNav($tab_list, $group)
                    ->addFormItems([ // 批量添加表单项
                        ['static', 'prop_name', '道具名称','',$list_group[$group]],
                        ['static', 'prop_affect', '道具作用', '',$list_group_affect[$group]],
                    ])
                    ->addText('cash', '购买设置', '', '', ['', '成长币可以购买一个'])
                    // ->addText('use_limit', '使用限制', '', '', ['每天可以使用', '次'])
                    // ->addText('lives', '生命值设定', '', '', ['每次使用，可以增加', '点生命值'])
                    ->setFormData($prop) // 设置表单数据
                    ->fetch(); 
                }
                
            } else {
                if ($group==4) {
                    // 使用ZBuilder快速创建表单
                    return ZBuilder::make('form')
                        ->setPageTitle('道具设置')
                        ->setTabNav($tab_list, $group)
                        ->addFormItems([ // 批量添加表单项
                            ['static', 'prop_name', '道具名称','',$list_group[$group]],
                            ['static', 'prop_affect', '道具作用', '',$list_group_affect[$group]],
                        ])
                        ->addText('cash', '购买设置', '', '', ['', '成长币可以购买一个'])
                        ->addText('use_limit', '使用限制', '', '', ['每天可以使用', '次'])
                        ->fetch();
                }else{
                    // 使用ZBuilder快速创建表单
                    return ZBuilder::make('form')
                        ->setPageTitle('道具设置')
                        ->setTabNav($tab_list, $group)
                        ->addFormItems([ // 批量添加表单项
                            ['static', 'prop_name', '道具名称','',$list_group[$group]],
                            ['static', 'prop_affect', '道具作用', '',$list_group_affect[$group]],
                        ])
                        ->addText('cash', '购买设置', '', '', ['', '成长币可以购买一个'])
                        ->addText('use_limit', '使用限制', '', '', ['每天可以使用', '次'])
                        // ->addText('lives', '生命值设定', '', '', ['每次使用，可以增加', '点生命值'])
                        ->fetch();
                }
                
            }
        }
    }

    
}
