<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"/data/httpd/treeH5/application/index/view/index/index.html";i:1502679009;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/index.css">
</head>

<body>
    <div class="container">
        <div class="blur_container hei">
            <div class="blur_bg"></div>
            <div class="blur_box none">
                <div class="item_row flex flex-justify-arround">
                    <div class="">
                        <img src="<?php echo $static_dir; ?>home/img/green.png">
                        <p class="">1000</p>
                    </div>
                    <div class="">
                        <img src="<?php echo $static_dir; ?>home/img/dui.png">
                        <p class="">1000</p>
                    </div>
                    <div class="">
                        <img src="<?php echo $static_dir; ?>home/img/budui.png">
                        <p class="">1000</p>
                    </div>
                    <div class="">
                        <img src="<?php echo $static_dir; ?>home/img/hsf2.png">
                        <p class="">10</p>
                    </div>
                    <div class="">
                        <img src="<?php echo $static_dir; ?>home/img/bigtree.png">
                        <p class="">1000</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bomb">
            <div class="title">道具使用</div>
            <div class="close"></div>
            <div class="bomb-box">
                <div class="middle clearfix">
                    请选择使用或者兑换工具
                </div>
                <div class="bottom">
                    <div class="status">
                        <div class="use btn">使用</div>
                        <div class="exchange btn">兑换</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tree">
            <div class="gethudun"><img src="<?php echo $static_dir; ?>home/img/hudun1.png" /></div>
            <div class="old tree-box"><img src="<?php echo $static_dir; ?>home/img/oldtree.png"></div>
            <div class="grow tree-box"><img src="<?php echo $static_dir; ?>home/img/growtree.png"></div>
            <div class="child tree-box active"><img src="<?php echo $static_dir; ?>home/img/childtree.png"></div>
            <div class="qipao">
                <div class="life-num">80</div>
                <div class="chengzhang">成长值</div>
                <div class="add move">+10</div>
                <div class="minus move">-10</div>
            </div>
        </div>
        <div class="blur_container col">
            <div class="blur_bg"></div>
            <div class="blur_box flex flex-col flex-justify-arround">
                <div class="item_col flex-1">
                    <a href="<?php echo url('Adv/index'); ?>" class="flex flex-align">
                        <div class="center">
                            <img src="<?php echo $static_dir; ?>home/img/notice.png"> 公告
                        </div>
                    </a>
                </div>
                <div class="item_col flex-1">
                    <a href="<?php echo url('TreesMap/index'); ?>" class="flex flex-align">
                        <div class="center">
                            <img src="<?php echo $static_dir; ?>home/img/mapicon.png"> 地图
                        </div>
                    </a>
                </div>
                <div class="item_col flex-1">
                    <a href="<?php echo url('Task/index'); ?>" class="flex flex-align">
                        <div class="center">
                            <img src="<?php echo $static_dir; ?>home/img/taskicon.png"> 赚绿植
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="planting flex">
            <div class="planting-item flex-1 flex flex-justify-arround flex-align">
                <div class="item watering">
                    <div class="water act">
                        <img src="<?php echo $static_dir; ?>home/img/water.png" class="water1">
                        <img src="<?php echo $static_dir; ?>home/img/water2.png" class="water2">
                    </div>
                    <img src="<?php echo $static_dir; ?>home/img/water.png"> x
                    <span class="num">2</span>
                    <div class="add1 one">+1</div>
                    <div class="minus1 one">-1</div>
                </div>
                <div class="item cutting">
                    <div class="cut act">
                        <img src="<?php echo $static_dir; ?>home/img/cut.png" class="cut1">
                        <img src="<?php echo $static_dir; ?>home/img/cut2.png" class="cut2">
                    </div>
                    <img src="<?php echo $static_dir; ?>home/img/cut.png"> x
                    <span class="num">2</span>
                    <div class="add1 one">+1</div>
                    <div class="minus1 one">-1</div>
                </div>
                <div class="item feeding">
                    <div class="shifei act">
                        <img src="<?php echo $static_dir; ?>home/img/shifei.png" class="shifei1">
                        <img src="<?php echo $static_dir; ?>home/img/shifei1.png" class="shifei2">
                    </div>
                    <img src="<?php echo $static_dir; ?>home/img/shifei.png"> x
                    <span class="num">2</span>
                    <div class="add1 one">+1</div>
                    <div class="minus1 one">-1</div>
                </div>
                <div class="item defense">
                    <img src="<?php echo $static_dir; ?>home/img/hudun.png" class="hudun act">
                    <img src="<?php echo $static_dir; ?>home/img/hudun.png"> x
                    <span class="num">2</span>
                    <div class="add1 one">+1</div>
                    <div class="minus1 one">-1</div>
                </div>
            </div>
        </div>
        <div id="bottom">
            <div class="topbg"></div>
            <div class="ranking flex">
                <div class="ranking-item active flex-1 self">
                    个人排名
                </div>
                <div class="ranking-item flex-1 banzu">
                    班组排名
                </div>
                <div class="ranking-item flex-1 copm">
                    企业排名
                </div>
                <div class="ranking-item flex-1 area">
                    地区排名
                </div>
            </div>
            <div class="rank-box">
                <div class="rank-box-item active">
                    <div class="self-type flex">
                        <div class="self-type-item flex-1">司机达人</div>
                        <div class="self-type-item flex-1">植树达人</div>
                    </div>
                    <div class="self-type-box active">
                        <div class="rank-list flex self">
                             <div class="rank-num"><?php echo $me_rank['rank']; ?></div>
                             <div class="self-icon"><img src=""></div>
                             <div class="self-name flex-1"><?php echo $me_rank['name']; ?>1</div>
                             <div class="self-num"><?php echo $me_rank['green_max']; ?></div>
                         </div>
                         <?php if(is_array($person_rank) || $person_rank instanceof \think\Collection || $person_rank instanceof \think\Paginator): $i = 0; $__LIST__ = $person_rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <div class="rank-list flex ">
                                 <div class="rank-num"><?php echo $key+1; ?></div>
                                 <div class="self-icon"><img src=""></div>
                                 <div class="self-name flex-1"><?php echo $item['username']; ?></div>
                                 <div class="self-num"><?php echo $item['green_max']; ?></div>
                             </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?> 
                    </div>
                    <div class="self-type-box">
                        <div class="rank-list flex self">
                             <div class="rank-num"><?php echo $me_rank['rank']; ?></div>
                             <div class="self-icon"><img src=""></div>
                             <div class="self-name flex-1"><?php echo $me_rank['name']; ?></div>
                             <div class="self-num"><?php echo $me_rank['green_max']; ?></div>
                         </div>
                         <?php if(is_array($driver_rank) || $driver_rank instanceof \think\Collection || $driver_rank instanceof \think\Paginator): $i = 0; $__LIST__ = $driver_rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <div class="rank-list flex ">
                                 <div class="rank-num"><?php echo $key+1; ?></div>
                                 <div class="self-icon"><img src=""></div>
                                 <div class="self-name flex-1"><?php echo $item['username']; ?></div>
                                 <div class="self-num"><?php echo $item['green_max']; ?></div>
                             </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?> 
                    </div>
                </div>
                <div class="rank-box-item">
                   <div class="self-type flex">
                        <div class="self-type-item flex-1">排行榜</div>
                    </div>
                    <div class="self-type-box active">
                        <?php if(is_array($class_rank) || $class_rank instanceof \think\Collection || $class_rank instanceof \think\Paginator): $i = 0; $__LIST__ = $class_rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <div class="rank-list flex ">
                                 <div class="rank-num"><?php echo $key+1; ?></div>
                                 <div class="self-icon"><img src=""></div>
                                 <div class="self-name flex-1"><?php echo $item['class']; ?></div>
                                 <div class="self-num"><?php echo $item['max']; ?></div>
                             </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?> 
                    </div>
                </div>
                <div class="rank-box-item">
                    <div class="self-type flex">
                        <div class="self-type-item flex-1">排行榜</div>
                    </div>
                    <div class="self-type-box active">
                        <?php if(is_array($company_rank) || $company_rank instanceof \think\Collection || $company_rank instanceof \think\Paginator): $i = 0; $__LIST__ = $company_rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <div class="rank-list flex ">
                                 <div class="rank-num"><?php echo $key+1; ?></div>
                                 <div class="self-icon"><img src=""></div>
                                 <div class="self-name flex-1"><?php echo $item['company']; ?></div>
                                 <div class="self-num"><?php echo $item['max']; ?></div>
                             </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?> 
                    </div>
                </div>
                <div class="rank-box-item">
                    <div class="self-type flex">
                        <div class="self-type-item flex-1">区域</div>
                        <div class="self-type-item flex-1">产业局</div>
                    </div>
                    <div class="self-type-box active">
                        <?php if(is_array($area_rank) || $area_rank instanceof \think\Collection || $area_rank instanceof \think\Paginator): $i = 0; $__LIST__ = $area_rank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <div class="rank-list flex ">
                                 <div class="rank-num"><?php echo $key+1; ?></div>
                                 <div class="self-icon"><img src=""></div>
                                 <div class="self-name flex-1"><?php echo $item['area']; ?></div>
                                 <div class="self-num"><?php echo $item['max']; ?></div>
                             </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?> 
                    </div>
                    <div class="self-type-box">66s</div>
                </div>
            </div>
        </div>
        <div class="hsf">
            <a href="javascript:;" class="">
                <img src="<?php echo $static_dir; ?>home/img/hsf1.png">
                红色寻访
         </a>
        </div>
        <div class="me">
            <a href="<?php echo url('Me/index'); ?>" class="">
                <img src="<?php echo $static_dir; ?>home/img/self.png">
                <p><?php echo $_MEMBER['username']; ?></p>
         </a>
        </div>
        <div class="disaster">
            <div class="hongshui">
                <img src="<?php echo $static_dir; ?>home/img/hongshui1.png">
                <div class="inline"></div>
                <img src="<?php echo $static_dir; ?>home/img/hongshui2.png">
            </div>
            <div class="cloud">
                <img src="<?php echo $static_dir; ?>home/img/cloud.png">
            </div>
            <div class="ganhan"></div>
            <div class="taifeng">
                <img src="<?php echo $static_dir; ?>home/img/taifeng.png">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/zepto.js"></script>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/public.js"></script>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/touch.js"></script>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/index.js"></script>

</body>

</html>