<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"/data/httpd/treeH5/application/index/view/index/launch.html";i:1502677776;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title></title>
    <style type="text/css">
    html,
    body {
        margin: 0;
        position: relative;
        height: 100%;
    }

    .launch {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 10;
        height: 100%;
    }

    .launch img {
        width: 100%;
        height: 100%;
    }
    </style>
</head>

<body>
    <div class="launch">
        <img src="<?php echo $static_dir; ?>home/img/start.png">
    </div>
    <script type="text/javascript" src="<?php echo $static_dir; ?>home/js/zepto.js"></script>
    <script type="text/javascript">
        // 启动页
        setTimeout(function() {
            location.href = "<?php echo url('Index/index'); ?>";
        }, 5000);
    </script>
</body>

</html>