<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Adv as AdvModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 用户默认控制器
 * @package app\user\admin
 */
class Adv extends Admin
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

        // 数据列表
        $data_list = AdvModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();

        // $list_role = Db::name('admin_role')->column('id,name');

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('公告管理') // 设置页面标题
            ->setTableName('announcement') // 设置数据表名
            ->addTimeFilter('create_time') // 添加时间段筛选
            ->addTopSelect('adv_type', '公告类型', [0 => '游戏介绍', 1 => '游戏公告'])
            ->setSearch([ 'adv_title' => '标题']) // 设置搜索参数
            ->addFilter('adv_title') // 添加筛选
            ->addColumns([ // 批量添加列
                ['id', '编号'],
                ['adv_type', '公告类型','','', [0 => '游戏介绍', 1 => '游戏公告']],
                ['adv_title', '标题'],
                // ['adv_content', '内容'],
                ['create_time', '创建时间', 'datetime'],
                ['publish_time', '发布时间', 'datetime'],
                ['adv_status', '状态', 'switch'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add') // 批量添加顶部按钮
            ->addRightButtons('edit,delete') // 批量添加右侧按钮
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
            $result = $this->validate($data, 'Adv');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            $data['publish_time'] = strtotime($data['publish_time']);
            if ($user = AdvModel::create($data)) {
                $this->success('新增成功', url('index'));
            } else {
                $this->error('新增失败');
            }
        }

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('新增') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['select', 'adv_type', '公告类型', '' ,['游戏介绍', '游戏公告']],
                ['text', 'adv_title', '公告标题'],
                ['radio', 'adv_status', '状态', '', ['停用', '启用'], 1]
            ])
            ->addDatetime('publish_time', '发布时间', '', '', 'YYYY-MM-DD HH:mm')
            ->addUeditor('adv_content', '内容')
            ->fetch();
    }

    /**
     * 编辑
     * @param null $id 用户id

     * @return mixed
     */
    public function edit($id = null)
    {
        if ($id === null) $this->error('缺少参数');

        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();

           
            // 验证
            $result = $this->validate($data, 'Adv');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            $data['publish_time'] = strtotime($data['publish_time']);
            if ($user = AdvModel::update($data)) {
                $this->success('编辑成功', cookie('__forward__'));
            } else {
                $this->error('编辑失败');
            }
        }

        // 获取数据
        $info = AdvModel::where('id', $id)->find();
        $info['publish_time'] = date('Y-m-d H:i',$info['publish_time']);
        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('编辑') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['hidden', 'id'],
                ['select', 'adv_type', '公告类型', '' ,['游戏介绍', '游戏公告']],
                ['text', 'adv_title', '公告标题'],
                ['radio', 'adv_status', '状态', '', ['停用', '启用'], 1]
            ])
            ->addDatetime('publish_time', '发布时间', '', '', 'YYYY-MM-DD HH:mm')
            ->addUeditor('adv_content', '内容')
            ->setFormData($info) // 设置表单数据
            ->fetch();
    }


    /**
     * 删除用户
     * @param array $record 行为日志

     * @return mixed
     */
    public function delete($record = [])
    {
        return $this->setStatus('delete');
    }

    /**
     * 启用用户
     * @param array $record 行为日志

     * @return mixed
     */
    public function enable($record = [])
    {
        return $this->setStatus('enable');
    }

    /**
     * 禁用用户
     * @param array $record 行为日志

     * @return mixed
     */
    public function disable($record = [])
    {
        return $this->setStatus('disable');
    }

    /**
     * 设置用户状态：删除、禁用、启用
     * @param string $type 类型：delete/enable/disable
     * @param array $record

     * @return mixed
     */
    public function setStatus($type = '', $record = [])
    {
        $ids       = $this->request->isPost() ? input('post.ids/a') : input('param.ids');

        $type_name = AdvModel::where('id', 'in', $ids)->column('adv_title');

        return parent::setStatus($type, ['game_announcement_'.$type, 'announcement', 0, UID, implode('、', $type_name)]);
    }

}
