<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"/data/httpd/treeH5/application/index/view/me/index.html";i:1502677776;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>个人中心</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/me.css">
</head>

<body>
    <div id="header">
        <header>
            <div id="back">返回</div>
            <div class="title">上汽植树</div>
        </header>
    </div>
    <div id="container">
        <div class="tab-wrap flex">
            <p class="tab-item active">我的信息</p>
            <p class="tab-item ">我的奖品</p>
        </div>
        <div class="tab-box body-wrap my-info active">
            <div class="list-wrap flex">
                <p class="item-name">名称</p>
                <p class="item-value"><?php echo $_MEMBER['username']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">头像</p>
                <p class="item-value"><img src="" class="avatar"></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">手机号</p>
                <p class="item-value"><?php echo $_MEMBER['contact']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">区域</p>
                <p class="item-value"><?php echo $_MEMBER['area']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">所在企业</p>
                <p class="item-value"><?php echo $_MEMBER['company']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">所在班组</p>
                <p class="item-value"><?php echo $_MEMBER['class']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">树木总数</p>
                <p class="item-value"><?php echo $_MEMBER['id']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">总累计绿植</p>
                <p class="item-value"><?php echo $_MEMBER['green_max']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">可用绿植</p>
                <p class="item-value"><?php echo $_MEMBER['green']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">奖励绿植</p>
                <p class="item-value"><?php echo $_MEMBER['id']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">累计总步数</p>
                <p class="item-value"><?php echo $_MEMBER['id']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">累计拼车里程</p>
                <p class="item-value"><?php echo $_MEMBER['id']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">答对题目总数</p>
                <p class="item-value"><?php echo $_MEMBER['id']; ?></p>
            </div>
            <div class="list-wrap flex">
                <p class="item-name">成长币</p>
                <p class="item-value"><?php echo $_MEMBER['share']; ?></p>
            </div>
        </div>
        <div class="tab-box my-award">
            <ul class="task-list">
            <?php if(is_array($award) || $award instanceof \think\Collection || $award instanceof \think\Paginator): $i = 0; $__LIST__ = $award;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if(!(empty($award) || (($award instanceof \think\Collection || $award instanceof \think\Paginator ) && $award->isEmpty()))): ?>
            <a href="<?php echo url('Me/award',['id' => $item['id']]); ?>">
	            <li >
	                <div class="thumbnail flex">
	                    <div class="thumb-img">
	                        <img src="<?php echo $static_dir; ?>home/img/gift.png" alt="">
	                    </div>
	                    <div class="caption flex">
	                        <p class="task-title">奖品名称：<?php echo get_conpon($item['conpon_id']); ?></p>
	                        <div class="task-award">获奖时间：<?php echo format_time($item['create_time']); ?></div>
	                    </div>
	                    <div class="btn-options">
	                        <div class="btn btn-next">
	                            
	                        </div>
	                    </div>
	                </div>
	            </li>
            </a>
            <?php else: ?>
            <li>
                暂无奖品
            </li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?> 
        </ul>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/zepto.js"></script>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/public.js"></script>
    <script type="text/javascript">
    $(function() {
    	 // 计算列表的line-height
	    // var lh = $('.list-wrap').height();
	    // $('.list-wrap').css('line-height', lh + 'px');

	    // tab-item选中效果
	    $('.tab-item').click(function() {
	        $(this).addClass('active').siblings().removeClass('active');
	        var index = $(this).index();
	        $('.tab-box').eq(index).addClass('active').siblings().removeClass('active');
	    })
    })
   
    </script>
</body>

</html>