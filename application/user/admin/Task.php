<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Task as TaskModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 任务默认控制器
 * @package app\user\admin
 */
class Task extends Admin
{
    /**
     * 任务首页
     * @return mixed
     */
    public function index()
    {
        cookie('__forward__', $_SERVER['REQUEST_URI']);

        // 获取查询条件
        $map = $this->getMap();

        // 数据列表
        $data_list = TaskModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();

        // 按钮
        $btn_1 = [
            'title' => '数据导入',
            'icon'  => 'fa fa-fw fa-cloud-download',
            'href'  => url('edit', ['id' => '__id__'])
        ];

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('任务管理') // 设置页面标题
            ->setTableName('task') // 设置数据表名
            ->addColumns([ // 批量添加列
                ['id', '编号'],
                ['task_name', '任务名称'],
                ['task_describe', '任务描述'],
                ['create_time', '创建时间', 'datetime'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add') // 批量添加顶部按钮
            ->addRightButton('custom', $btn_1) // 添加授权按钮
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
            $result = $this->validate($data, 'Task');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);

            if ($user = TaskModel::create($data)) {
                $this->success('新增成功', url('index'));
            } else {
                $this->error('新增失败');
            }
        }

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('新增') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['hidden', 'id'],
                ['text', 'task_name', '任务名'],
                ['text', 'task_introduce', '奖品说明']
            ])
            ->addUeditor('task_describe', '任务描述')
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
            $result = $this->validate($data, 'Task');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);

            if ($user = TaskModel::update($data)) {
                $this->success('编辑成功', cookie('__forward__'));
            } else {
                $this->error('编辑失败');
            }
        }

        // 获取数据
        $info = TaskModel::where('id', $id)->find();

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('编辑') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['text', 'task_name', '任务名'],
                ['text', 'task_introduce', '奖品说明']
            ])
            ->addUeditor('task_describe', '任务描述')
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
     * 设置用户状态：删除、禁用、启用
     * @param string $type 类型：delete/enable/disable
     * @param array $record

     * @return mixed
     */
    public function setStatus($type = '', $record = [])
    {
        $ids       = $this->request->isPost() ? input('post.ids/a') : input('param.ids');

        $type_name = TaskModel::where('id', 'in', $ids)->column('task_name');

        return parent::setStatus($type, ['task_'.$type, 'task', 0, UID, implode('、', $type_name)]);
    }

}
