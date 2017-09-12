<?php


namespace app\user\admin;

use app\admin\controller\Admin;
use app\common\builder\ZBuilder;
use app\user\model\Conpontepy as ConpontepyModel;
use app\user\model\Role as RoleModel;
use app\admin\model\Module as ModuleModel;
use app\admin\model\Access as AccessModel;
use util\Tree;
use think\Db;
/**
 * 优惠券类型默认控制器
 * @package app\user\admin
 */
class Conpontepy extends Admin
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
        $data_list = ConpontepyModel::where($map)->order('id desc')->paginate();

        // 分页数据
        $page = $data_list->render();
        $btn_1 = [
                'title' => '导入',
                'icon'  => 'fa fa-fw fa-copy',
                // 'class' => 'ajax-post',
                'href'  => url('import', ['id' => '__id__'])
            ];
        
        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('优惠券类型列表') // 设置页面标题
            ->setTableName('Conpontepy') // 设置数据表名
            ->addColumns([ // 批量添加列
                ['conpon_name', '名称'],
                ['conpon_parnter', '合作伙伴'],
                ['conpon_code', '代号'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons('add') // 批量添加顶部按钮
            ->addRightButton('custom', $btn_1) // 添加导入按钮
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
            $result = $this->validate($data, 'Conpontepy');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            $data['create_time'] = time();
            if ($user = ConpontepyModel::create($data)) {
                $this->success('新增成功', url('index'));
            } else {
                $this->error('新增失败');
            }
        }

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('新增') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['text', 'conpon_name', '优惠券名'],
                ['text', 'conpon_parnter', '合伙伙伴'],
                ['text', 'conpon_code', '代号'],
            ])
            ->addUeditor('conpon_introduce', '使用说明')
            // ->addTextarea('conpon_introduce', '使用说明')
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
            $result = $this->validate($data, 'Conpontepy');
            // 验证失败 输出错误信息
            if(true !== $result) $this->error($result);
            if (ConpontepyModel::update($data)) {
                
                $this->success('编辑成功', cookie('__forward__'));
            } else {
                $this->error('编辑失败');
            }
        }

        // 获取数据
        $info = ConpontepyModel::where('id', $id)->find();

        // 使用ZBuilder快速创建表单
        return ZBuilder::make('form')
            ->setPageTitle('编辑') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['hidden', 'id'],
                ['text', 'conpon_name', '优惠券名'],
                ['text', 'conpon_parnter', '合伙伙伴'],
                ['text', 'conpon_code', '代号'],
            ])
            ->addUeditor('conpon_introduce', '使用说明')
            // ->addTextarea('conpon_introduce', '使用说明')
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

        $type_name = ConpontepyModel::where('id', 'in', $ids)->column('conpon_name');

        return parent::setStatus($type, ['conponType_'.$type, 'conponType', 0, UID, implode('、', $type_name)]);
    }

    public function import($id = null){
        if ($id === null) $this->error('缺少参数');
        // 提交数据
        if ($this->request->isPost()) {
            // 接收附件 ID
            $excel_file = $this->request->post('excel');
            // 获取附件 ID 完整路径
            $full_path = getcwd() . get_file_path($excel_file);
            // 只导入的字段列表
            $fields = [
                'conpon_no' => '代号',
                'conpon_password' => '密码',
                'conpon_type' => '优惠券类型'
            ];
            $extra = [
                'conpon_type' => $id
            ];
            // 调用插件('插件',[路径,导入表名,字段限制,类型,条件,重复数据检测字段])
            $import = plugin_action('Excel/Excel/import', [$full_path, 'conpon', $fields, $type = 0, $where = null, $main_field = 'conpon_no', $extra]);
            
            // 失败或无数据导入
            if ($import['error']){
                $this->error($import['message']);
            }

            // 导入成功
            $this->success($import['message']);
        }

        $excel_url = '/data/conpon.xlsx';
        // 创建演示用表单
        return ZBuilder::make('form')
            ->setPageTitle('导入Excel')
            ->setPageTips('<a href="'.$excel_url.'">点击下载示例excel</a>', 'danger')
            ->addFormItems([ // 添加上传 Excel
                ['file', 'excel', '上传文件'],
            ])
            ->fetch();
    }
}
