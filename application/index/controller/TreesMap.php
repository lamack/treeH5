<?php


namespace app\index\controller;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class TreesMap extends Home
{

    public function index()
    {
        //取用户
        $member = session('_MEMBER');
        //页面添加token
        if (session('_MEMBER')) {
            $this->assign('_TOKEN_', encrypt(session('_MEMBER')['id']));
        }
        $profile_trees = db('trees')->where('user_id',$member['id'])->count();

        //班级
        $class_count = db('trees')->alias('a')->join(' member b',' b.id = a.user_id','LEFT')->where('b.class_no',$member['class_no'])->count();   
        //公司
        $company_count = db('trees')->alias('a')->join(' member b',' b.id = a.user_id','LEFT')->where('b.company_no',$member['company_no'])->count();  

        //区域
        $areaArr = array(
            'shiqu'=>'上海市区',
            'jiading'=>'嘉定',
            'baoshan'=>'宝山',
            'minhang'=>'闵行',
            'pudong'=>'浦东',
            'nanhui'=>'南汇',
            'fengxian'=>'奉贤',
            'songjiang'=>'松江',
            'jinshan'=>'金山',
            'qingpu'=>'青浦'
        );
        $data = [];
        $i = 0;
        foreach ($areaArr as $key => $value) {
            $data[$i]['name'] = $key;
            $data[$i]['num'] = db('trees')->alias('a')->join(' member b',' b.id = a.user_id','LEFT')->where('b.area',$value)->count();;
            $i++;
        }

        //区域
        $areaArr1 = array(
            'putuo'=>'普陀',
            'changning'=>'长宁',
            'xuhui'=>'徐汇',
            'jingan'=>'静安',
            'hongkou'=>'虹口',
            'yangpu'=>'杨浦',
            'huangpu'=>'黄埔'
        );
        $data1 = [];
        $m = 0;
        foreach ($areaArr1 as $key => $value) {
            $data1[$m]['name'] = $key;
            $data1[$m]['num'] = db('trees')->alias('a')->join(' member b',' b.id = a.user_id','LEFT')->where('b.area',$value)->count();;
            $m++;
        }

        $total = db('member')->count();
        $trees = db('trees')->count();

        //分享url
        $token = encrypt($member['id']);
        $share_url = url('index/share/index','token='.$token,'html',true);

        $this->assign('share_url', $share_url);
        
        $this->assign('profile_trees', $profile_trees);
        $this->assign('class_count', $class_count);
        $this->assign('company_count', $company_count);
        $this->assign('total', $total);
        $this->assign('trees', $trees);
        $this->assign('quyu', json_encode($data));
        $this->assign('area', json_encode($data1));
        return $this->fetch(); // 渲染模板
    }

}
