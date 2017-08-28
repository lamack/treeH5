<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Disaster as DisasterModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 养成默认控制器
 * @package app\user\admin
 */
class Disaster extends Admin
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
        $data_list = DisasterModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();

        // 按钮
        $btn_1 = [
            'title' => '查看祥情',
            'icon'  => 'fa fa-fw fa-binoculars',
            'href'  => url('edit', ['id' => '__id__'])
        ];

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('灾害管理') // 设置页面标题
            ->setTableName('disaster') // 设置数据表名
            ->hideCheckbox()
            ->addColumns([ // 批量添加列
                ['id', '序列'],
                ['disaster_type', '灾害类型','','',[0=>'台风', 1=>'洪水', 2=>'干旱']],
                ['start_time', '灾害触发时间','date'],
                ['push_flish_time', '公告发布时间','date'],
                ['status', '状态'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add') // 批量添加顶部按钮
            ->addRightButton('custom', $btn_1) // 添加授权按钮
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    /**
     * 新增

     * @return mixed
     */
    public function add()
    {
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证
            $result = $this->validate($data, 'Disaster');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $data['push_flish_time'] = strtotime($data['push_flish_time']);
            if ($user = DisasterModel::create($data)) {
                $this->success('新增成功', url('index'));
            } else {
                $this->error('新增失败');
            }
        }

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('新增') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['select', 'disaster_type', '灾害类型', '', ['台风', '洪水', '干旱']],
            ])
            ->addDatetime('start_time', '触发开始时间', '', '', 'yyyy/mm/dd')
            ->addDatetime('end_time', '触发结束时间', '', '', 'yyyy/mm/dd')
            ->addUeditor('push_content', '公告内容')
            ->addDatetime('push_flish_time', '公告发布时间', '', '', 'yyyy/mm/dd')
            ->fetch();
    }

    /**
     * 编辑
     * @param null $id id

     * @return mixed
     */
    public function edit($id = null)
    {
        if ($id === null) $this->error('缺少参数');

        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();

            // 验证
            $result = $this->validate($data, 'Disaster');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $data['push_flish_time'] = strtotime($data['push_flish_time']);
            if (DisasterModel::update($data)) {
                
                $this->success('编辑成功', cookie('__forward__'));
            } else {
                $this->error('编辑失败');
            }
        }

        // 获取数据
        $info = DisasterModel::where('id', $id)->find();
        $info['start_time'] = date('Y-m-d H:i',$info['start_time']);
        $info['end_time'] = date('Y-m-d H:i',$info['end_time']);
        $info['push_flish_time'] = date('Y-m-d H:i',$info['push_flish_time']);
        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('编辑') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['hidden', 'id'],
                ['select', 'disaster_type', '灾害类型', '', ['台风', '洪水', '干旱']],
            ])
            ->addDatetime('start_time', '触发开始时间', '', '', 'YYYY-MM-DD HH:mm')
            ->addDatetime('end_time', '触发结束时间', '', '', 'YYYY-MM-DD HH:mm')
            ->addUeditor('push_content', '公告内容')
            ->addDatetime('push_flish_time', '公告发布时间', '', '', 'YYYY-MM-DD HH:mm')
            ->setFormData($info) // 设置表单数据
            ->fetch();
    }

}
