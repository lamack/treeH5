<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/data/httpd/treeH5/application/index/view/trees_map/index.html";i:1502677776;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>森林地图</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $static_dir; ?>home/css/treemap.css">
</head>
<body>
    <div id="header">
        <div id="back">返回</div>
        我的森林地图
    </div>
    <div id="container">
        <div class="tab-wrap flex">
            <p class="tab-item active">我的森林</p>
            <p class="tab-item">班组的森林</p>
            <p class="tab-item">企业的森林</p>
            <p class="tab-item">区域地图</p>
        </div>
        <div class="tab-box active">
            <div class="blur_container">
                <div class="blur_bg"></div>
                <div class="blur_box none">
                    <div class="item_row flex flex-justify-arround">
                        <div class="xxx">
                            <img src="<?php echo $static_dir; ?>home/img/bigtree.png">
                            <span class="">树木总数：<?php echo $profile_trees; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dianzan"><div class="add">+1</div>X100</div>
            <div class="senlin xiaoshu"></div>
        </div>
        <div class="tab-box">
            <div class="blur_container">
                <div class="blur_bg"></div>
                <div class="blur_box none">
                    <div class="item_row flex flex-justify-arround">
                        <div class="xxx">
                            <img src="<?php echo $static_dir; ?>home/img/bigtree.png">
                            <span class="">树木总数：<?php echo $class_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dianzan"><div class="add">+1</div>X100</div>
            <div class="senlin"></div>
        </div>
        <div class="tab-box">
            <div class="blur_container">
                <div class="blur_bg"></div>
                <div class="blur_box none">
                    <div class="item_row flex flex-justify-arround">
                        <div class="xxx">
                            <img src="<?php echo $static_dir; ?>home/img/bigtree.png">
                            <span class="">树木总数：<?php echo $company_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dianzan"><div class="add">+1</div>X100</div>
            <div class="senlin"></div>
        </div>
        <div class="tab-box quyu">
            <div class="title">全上海参数与人数：<?php echo $total; ?>人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;共植树<?php echo $trees; ?>棵</div>
            <div class="city">
            </div>
            <div class="qu">
            </div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo $static_dir; ?>home/js/zepto.js"></script>
<script type="text/javascript" src="<?php echo $static_dir; ?>home/js/public.js"></script>
<script type="text/javascript">
$(function(){
    $('.tab-wrap').find('.tab-item').click(function(){
        var index= $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.tab-box').eq(index).addClass('active').siblings().removeClass('active')
    })
    //设置top left百分比
    var citymap = {
        shiqu:['7%','46%'],
        jiading:['-4%','35%'],
        baoshan:['-4%','55%'],
        minhang:['38%','57%'],
        chongming:['-7%','79%'],
        pudong:['8%','71%'],
        nanhui:['48%','84%'],
        fengxian:['57%','62%'],
        songjiang:['36%','32%'],
        jinshan:['65%','22%'],
        qingpu:['28%','17%'],
    }
    var qumap = {
        putuo:['3%','18%'],
        changning:['29%','6%'],
        xuhui:['44%','23%'],
        zhabei:['-9%','40%'],
        luwan:['35%','42%'],
        jingan:['24%','38%'],
        hongkou:['-5%','56%'],
        yangpu:['-5%','68%'],
        huangpu:['27%','49%'],
    }
    var Quyu = {
        el:$('.quyu'),
        init:function(){
            //模拟上海市植树数据 arr arr2;
           // var arr=[
           //    {name:'shiqu',
           //      num:0},
           //    {name:'jiading',
           //      num:90},
           //    {name:'baoshan',
           //      num:7},
           //    {name:'minhang',
           //      num:88},
           //    {name:'pudong',
           //      num:733},
           //    {name:'nanhui',
           //      num:23},
           //    {name:'fengxian',
           //      num:2},
           //    {name:'songjiang',
           //      num:18},
           //    {name:'jinshan',
           //      num:70},
           //    {name:'qingpu',
           //      num:57},
           // ];
           var arr = <?php echo $quyu; ?>;
           this.el.find('.city').html(this.rendercity(arr));
           // this.el.find('.qu').html(this.rendercity(arr2));
        },
        rendercity(arr){
           var str = '';
           for(var i in arr){
               var name = arr[i].name
               str+= '<div class="tap" style="top:'+citymap[name][0]+';left:'+citymap[name][1]+';">'+arr[i].num+'棵</div>'
           }
           return str
        },
    }
    Quyu.init();
    //点赞
    $('.dianzan').click(function(){
        var index = $(this).parent().index();
        $(this).find('.add').show();
        setTimeout(function(){
            $('.dianzan').find('.add').hide();
        },1000)
    })
})
</script>
</body>
</html>