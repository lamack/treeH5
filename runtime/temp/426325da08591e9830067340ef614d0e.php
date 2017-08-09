<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"/data/httpd/treeGame/application/index/view/index/index.html";i:1502261013;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>首页</title>
	<link rel="stylesheet" href="<?php echo $static_dir; ?>home/css/reset.css">
	<link rel="stylesheet" href="<?php echo $static_dir; ?>home/css/index.css">
</head>
<body>
	<div class="blur_container">
		<div class="blur_bg"></div>
		<div class="blur_box none">
	        <div class="item_row flex flex-justify-arround">
	        	<div class="css/">
	        	    <img src="<?php echo $static_dir; ?>home/img/green.png">
	             	<span class="">1000</span>
	            </div>
	            <div class="">
	        	    <img src="<?php echo $static_dir; ?>home/img/hsf2.png">
	             	<span class="">10</span>
	            </div>
	            <div class="">
	        	    <img src="<?php echo $static_dir; ?>home/img/hsf3.png">
	             	<span class="">10</span>
	            </div>
                <div class="">
            	    <img src="<?php echo $static_dir; ?>home/img/bigtree.png">
                 	<span class="">1000</span>
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
        <div class="old tree-box"><img src="<?php echo $static_dir; ?>home/img/oldtree.png"></div>
        <div class="grow tree-box"><img src="<?php echo $static_dir; ?>home/img/growtree.png"></div>
    	<div class="child tree-box active"><img src="<?php echo $static_dir; ?>home/img/childtree.png"></div>
    </div>
   

	<div class="blur_container col">
		<div class="blur_bg"></div>
		<div class="blur_box flex flex-col flex-justify-arround">
	        <div class="item_col flex-1">
	             <a href="pages/me.html" class="flex flex-align">
	             	<div class="center">
	             		<img src="<?php echo $static_dir; ?>home/img/me.png">
	             		个人中心
	             	</div>
	             </a>
	        </div>
	        <div class="item_col flex-1">
	             <a href="pages/notice.html" class="flex flex-align">
	             	<div class="center">
	             		<img src="<?php echo $static_dir; ?>home/img/notice.png">
	             		公告
	             	</div>
	             </a>
	        </div>
	        <div class="item_col flex-1">
	             <a href="pages/notice.html" class="flex flex-align">
	             	<div class="center">
	             		<img src="<?php echo $static_dir; ?>home/img/hsf.png">
	             		红色寻访
	             	</div>
	             </a>
	        </div>
	        <div class="item_col flex-1">
	             <a href="pages/treemap.html" class="flex flex-align">
	             	<div class="center">
	             		<img src="<?php echo $static_dir; ?>home/img/mapicon.png">
	             		地图
	             	</div>
	             </a>
	        </div>
	        <div class="item_col flex-1">
	             <a href="pages/task.html" class="flex flex-align">
	             	<div class="center">
	             		<img src="<?php echo $static_dir; ?>home/img/taskicon.png">
	             		任务
	             	</div>
	             </a>
	        </div>
		</div>
	</div>
	<div class="planting flex">
		<div class="planting-item flex-1 flex flex-justify-arround flex-align">
			<div class="item watering">
				<img src="<?php echo $static_dir; ?>home/img/water.png">
				x<span class="water-num">2</span>
			</div>
			<div class="item cutting">
				<img src="<?php echo $static_dir; ?>home/img/cut.png">
				x<span class="cut-num">2</span>
			</div>
			<div class="item feeding">
				<img src="<?php echo $static_dir; ?>home/img/shifei.png">
				x<span class="feed-num">2</span>
			</div>
			<div class="item defense">
				<img src="<?php echo $static_dir; ?>home/img/hudun.png">
				x<span class="defense-num">2</span>
			</div>
		</div>
	</div>
	
	<div id="bottom">
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
					<div class="self-type-item flex-1">拼车</div>
					<div class="self-type-item flex-1">步行</div>
					<div class="self-type-item flex-1">种树达人</div>
				</div>
				<div class="self-type-box active"></div>
				<div class="self-type-box"></div>
				<div class="self-type-box"></div>
			</div>
			<div class="rank-box-item">222</div>
			<div class="rank-box-item">333</div>
			<div class="rank-box-item">444</div>
		</div>
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
	</div>
<script type="text/javascript" src="<?php echo $static_dir; ?>home/js/zepto.js"></script>
<script type="text/javascript" src="<?php echo $static_dir; ?>home/js/public.js"></script>
<script type="text/javascript" src="<?php echo $static_dir; ?>home/js/index.js"></script>
</body>
</html>