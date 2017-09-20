<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Conpon as ConponModel;
use app\user\model\Conpontepy as ConpontepyModel;
use app\user\model\Member as MemberModel;
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
        $c1 = ConponModel::where('conpon_status',0)->count();
        $c2 = ConponModel::where('conpon_status',1)->count();
        // 分页数据
        $page = $data_list->render();

        $btn_1 = [
            'title' => '分配',
            'icon'  => 'fa fa-fw fa-newspaper-o',
            'href'  => url('conpon', ['cid' => '__id__'])
        ];

        $list_module = ConpontepyModel::where(1)->order('id desc')->column('id,conpon_name');
        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('优惠券列表') // 设置页面标题
            ->setTableName('Conpon') // 设置数据表名
            ->setExtraHtml('<strong style="color:red">未分配数量'.$c1.'&nbsp;&nbsp;分配数量'.$c2.'</strong>', 'toolbar_top')
            ->hideCheckbox()
             ->addFilter('conpon_type', $list_module) // 添加筛选
            ->addFilter('conpon_status', [0 => '未分配', 1 => '分配']) // 添加筛选
            ->addColumns([ // 批量添加列
                ['conpon_type', '类型','','',$list_module],
                ['conpon_no', '券号'],
                ['conpon_password', '密码'],
                ['conpon_status', '状态','','',[0 => '未分配', 1 => '分配']],
                ['right_button', '操作', 'btn']
            ])
            // ->addTopButton('custom', $btn_1) // 批量添加顶部按钮
            ->addRightButton('custom', $btn_1) // 添加导入按钮
            ->addRightButtons('delete') // 批量添加右侧按钮
            ->replaceRightButton(['conpon_status' => 1], '<button class="btn btn-danger btn-xs" type="button" disabled>不可操作</button>') // 修改id为1的按钮
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染页面
    }

    public function conpon($cid)
    {
        if ($cid === null) $this->error('缺少参数');
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $f['id'] = $cid;
            $f['conpon_status'] = 0;
            if(!db('conpon')->where($f)->find()){
               $this->error('已分配或优惠券不存在'); 
            }
            //uid
            if ($data['uid']) {
                $save['user_id'] = $data['uid'];
                $save['conpon_id'] = $cid;
                $save['create_time'] = time();
                db('recode')->insert($save);

                //分配更新
                $cpm['id'] = $cid;
                $cp['conpon_status'] = 1;
                db('conpon')->where($cpm)->update($cp);
                $this->success('分配成功', cookie('__forward__'));
            }else{
                $this->error('分配失败');
            }
        }

        // 获取数据
        $member = MemberModel::where(1)->select();
        $o = [];
        foreach ($member as $key => $value) {
            $o[$value['id']]= "用户名：".$value['username']." |手机号：".$value['contact'];
        }
        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('分配优惠券') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['select', 'uid', '会员', '' ,$o],
            ])
            ->setFormData() // 设置表单数据
            ->fetch();
    }
    /**
     * 删除用户
     * @param array $record 行为日志

     * @return mixed
     */
    public function delete($record = [])
    {
        //是否分配
        
        
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

        $type_name = ConponModel::where('id', 'in', $ids)->column('conpon_no');

        return parent::setStatus($type, ['conpon_'.$type, 'conpon', 0, UID, implode('、', $type_name)]);
    }
   
}
