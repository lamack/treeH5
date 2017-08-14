<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\User as UserModel;
use app\user\model\Member as MemberModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;

/**
 * 会员默认控制器
 * @package app\user\admin
 */
class Member extends Admin
{
    /**
     * 会员首页
     * @return mixed
     */
    public function index()
    {
        cookie('__forward__', $_SERVER['REQUEST_URI']);

        // 获取查询条件
        $map = $this->getMap();

        // 数据列表
        $data_list = MemberModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();

        // 授权按钮
        $btn_1 = [
            'title' => '查看祥情',
            'icon'  => 'fa fa-fw fa-binoculars',
            'href'  => url('edit', ['uid' => '__id__'])
        ];
        $btn_2 = [
            'title' => '查看记录',
            'icon'  => 'fa fa-fw fa-newspaper-o',
            'href'  => url('recode', ['uid' => '__id__'])
        ];
        $btn_3 = [
            'title' => '同步',
            'icon'  => 'fa fa-fw fa-copy',
            'class' => 'btn btn-primary ajax-post',
            'href'  => url('synchro')
        ];

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('会员管理') // 设置页面标题
            ->setTableName('member') // 设置数据表名
            ->setSearch(['username' => '用户名', 'contact' => '手机号']) // 设置搜索参数
            ->addColumns([ // 批量添加列
                ['id', 'ID'],
                ['username', '用户名'],
                ['contact', '手机号'],
                ['area', '所在区域'],
                ['company', '所在企业'],
                ['class', '所在班组'],
                ['mileage', '里程数'],
                ['green', '绿值'],
                ['share', '成长币'],
                ['trees', '树苗总数'],
                ['right_button', '操作', 'btn']
            ])
            ->addRightButton('custom', $btn_1) // 添加查看祥情按钮
            ->addRightButton('custom', $btn_2) // 添加查看记录按钮
            ->addTopButton('custom', $btn_3) // 批量添加顶部按钮
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
            $result = $this->validate($data, 'User');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);

            if ($user = UserModel::create($data)) {
                // 记录行为
                action_log('user_add', 'admin_user', $user['id'], UID);
                $this->success('新增成功', url('index'));
            } else {
                $this->error('新增失败');
            }
        }

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('新增') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['text', 'username', '用户名', '必填，可由英文字母、数字组成'],
                ['text', 'nickname', '昵称', '可以是中文'],
                ['select', 'role', '角色', '', RoleModel::getTree(null, false)],
                ['text', 'email', '邮箱', ''],
                ['password', 'password', '密码', '必填，6-20位'],
                ['text', 'mobile', '手机号'],
                ['image', 'avatar', '头像'],
                ['radio', 'status', '状态', '', ['禁用', '启用'], 1]
            ])
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

            // 禁止修改超级管理员的角色和状态
            if ($data['id'] == 1 && $data['role'] != 1) {
                $this->error('禁止修改超级管理员角色');
            }

            // 禁止修改超级管理员的状态
            if ($data['id'] == 1 && $data['status'] != 1) {
                $this->error('禁止修改超级管理员状态');
            }

            // 验证
            $result = $this->validate($data, 'User.update');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);

            // 如果没有填写密码，则不更新密码
            if ($data['password'] == '') {
                unset($data['password']);
            }

            if ($user = UserModel::update($data)) {
                // 记录行为
                action_log('user_edit', 'admin_user', $user['id'], UID, get_nickname($user['id']));
                $this->success('编辑成功', cookie('__forward__'));
            } else {
                $this->error('编辑失败');
            }
        }

        // 获取数据
        $info = UserModel::where('id', $id)->field('password', true)->find();

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('编辑') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['hidden', 'id'],
                ['static', 'username', '用户名', '不可更改'],
                ['text', 'nickname', '昵称', '可以是中文'],
                ['select', 'role', '角色', '', RoleModel::getTree(null, false)],
                ['text', 'email', '邮箱', ''],
                ['password', 'password', '密码', '必填，6-20位'],
                ['text', 'mobile', '手机号'],
                ['image', 'avatar', '头像'],
                ['radio', 'status', '状态', '', ['禁用', '启用']]
            ])
            ->setFormData($info) // 设置表单数据
            ->fetch();
    }

    public function synchro(){
        exit('synchro');
    }
}
