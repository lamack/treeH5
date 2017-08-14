<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"/data/httpd/treeH5/application/index/view/adv/index.html";i:1502677776;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>公告</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/notice.css">
    <style type="text/css">
        .hide{ 
            display: none;
        }
        .show{
            display: block;
        }
        
    </style>
</head>

<body>
    <div id="header">
        <div id="back">返回</div>
        上汽植树
    </div>
    <div id="container">
        <div class="tab-wrap flex">
            <p class="tab-item active">游戏公告</p>
            <p class="tab-item ">游戏介绍</p>
        </div>
        <ul class="task-list show">
            <?php if(is_array($adv) || $adv instanceof \think\Collection || $adv instanceof \think\Paginator): $i = 0; $__LIST__ = $adv;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if(!(empty($adv) || (($adv instanceof \think\Collection || $adv instanceof \think\Paginator ) && $adv->isEmpty()))): ?>
            <li>
                <a href="<?php echo url('Adv/detail',['id' => $item['id']]); ?>">
                <div class="thumbnail flex">
                    <div class="caption flex">
                        <p class="task-title"><?php echo $item['adv_title']; ?></p>
                        <div class="task-award"><?php echo format_time($item['create_time']); ?></div>
                    </div>
                    <div class="btn-options">
                        <div class="btn btn-next"></div>
                    </div>
                </div>
                </a>
            </li>
            <?php else: ?>
            <li>
                暂无公告
            </li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?> 
        </ul>
        <ul class="task-list hide">
            <?php if(is_array($in) || $in instanceof \think\Collection || $in instanceof \think\Paginator): $i = 0; $__LIST__ = $in;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if(!(empty($in) || (($in instanceof \think\Collection || $in instanceof \think\Paginator ) && $in->isEmpty()))): ?>
            <li>
                <a href="<?php echo url('Adv/detail',['id' => $item['id']]); ?>">
                <div class="thumbnail flex">
                    <div class="caption flex">
                        <p class="task-title"><?php echo $item['adv_title']; ?></p>
                        <div class="task-award"><?php echo format_time($item['create_time']); ?></div>
                    </div>
                    <div class="btn-options">
                        <div class="btn btn-next"></div>
                    </div>
                </div>
                </a>
            </li>
            <?php else: ?>
            <li>
                暂无公告
            </li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?> 
        </ul>
    </div>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/zepto.js"></script>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/public.js"></script>
    <script type="text/javascript">
    $(function() {
	    // tab-item选中效果
	    $('.tab-item').click(function() {
	        $(this).addClass('active').siblings().removeClass('active');
	        var index = $(this).index();
	        $('.task-list').eq(index).removeClass('hide').siblings('ul').addClass('hide');
            $('.task-list').eq(index).addClass('show').siblings('ul').removeClass('show');
	    })
    })
   
    </script>
</body>

</html>