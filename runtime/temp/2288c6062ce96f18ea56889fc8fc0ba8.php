<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"/data/httpd/treeH5/application/index/view/task/index.html";i:1502677776;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>任务</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/task.css">
</head>

<body>
    <div id="header">
        <div id="back">返回</div>
        植树任务
    </div>
    <div id="container">
        <ul class="task-list">
            <?php if(is_array($task) || $task instanceof \think\Collection || $task instanceof \think\Paginator): $i = 0; $__LIST__ = $task;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if(!(empty($task) || (($task instanceof \think\Collection || $task instanceof \think\Paginator ) && $task->isEmpty()))): ?>
            <li <?php switch($item['status']): case "2": ?>
                                    class="active" 
                                <?php break; endswitch; ?>>
                <div class="thumbnail flex">
                    <div class="thumb-img">
                        <?php switch($item['status']): case "1": ?>
                            <img src="<?php echo $static_dir; ?>home/img/taskicon.png" alt="">
                            <?php break; case "2": ?>
                            <img src="<?php echo $static_dir; ?>home/img/finish.png" class="finish" alt="">
                            <?php break; default: ?>
                            <img src="<?php echo $static_dir; ?>home/img/taskicon.png" alt="">
                        <?php endswitch; ?>

                    </div>
                    <div class="caption flex">
                        <p class="task-title"><?php echo $item['task_name']; ?></p>
                        <div class="task-award">任务奖励：<img src="<?php echo $static_dir; ?>home/img/taskgreen.png"><em>+<?php echo $item['task_introduce']; ?></em></div>
                    </div>
                    <div class="btn-options">
                        <?php switch($item['status']): case "1": ?>
                            
                                <div class="btn btn-default" >
                                    领取
                                </div>
                            <?php break; case "2": ?>
                                <div class="btn btn-default" >
                                    已完成
                                </div>
                            <?php break; default: ?>
                            <a href="<?php echo url('Task/detail',['id' => $item['id']]); ?>">
                                <div class="btn btn-default" >
                                    详细
                                </div>
                             </a>   
                        <?php endswitch; ?>
                    </div>
                </div>
            </li>
            <?php else: ?>
            <li>
                暂无任务
            </li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?> 
        </ul>
    </div>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/zepto.js"></script>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/public.js"></script>
</body>

</html>