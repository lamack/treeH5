## 8月14日对接问题

1.道具为0的时候可点击
2.首页标题修改为欢乐植树  // 已修改
3.标题栏对应的全部为蓝色
4.个人排名背景图片更改，个人排名位置调整到中部
5.第一次加载进来首页背景图片可以滑动
6.首页的树苗跟着背景一起滑动，现在是背景滑动，树没有动

## 8月15日对接问题
1. 排行榜还是没和首页连一起。 
2. 任务列表再添加一个查看，点击后跳转任务详情。
3. 我的森林里区域地图请在下方市区里也显示几棵树及数量。 
4. 登录后直接就是默认场景，不要台风。
5. 道具需要可以使用及兑换，出现相应弹框提示
6. 树苗长到最大后禁止成长


## 8月17日
1.树苗
     null 3 个阶段（树苗，青年，成年，果实） 4 0末成年树 1成年末结果实  2有果实 3果实已领取（）
2.灾害
    adv_disaster (最近的灾害) —— localstorege true false(台风)
3.果实
    状态 2 果实（领取果实-》接口）———效果（已领取|消失）
4.道具
    树苗（null） 点不了 树苗（有）--接口

    第一点：
    	刚进来树苗为空，成长分三个阶段(树苗，青年，成年，果实)
    	level 1，2，3 status 0，1，2，3
    	四种状态怎么解释： 0末成年树 1成年末结果实  2有果实 3果实已领取（）
    第二点：
    	前半部分 
    第三点：
    	结果实后，通过接口领取果实，领取过后提示信息已领取，然后果实消失
    第四点：
    	默认树苗没有，道具无法使用；有树苗(通过接口) 点击道具掉接口


## 8月19日
功能：
    1.植树任务，点击领取后掉接口（差接口） /furit?type=1 
      1.1 领取成功后的操作？？？ 失败后的操作？？？
    2.我的地图，
        2.1 点赞调接口（差接口）
        2.2 树木总数需要掉接口（差接口）(跳转Ok,信息已获得)
    3.TA的植树，树苗捐赠，绿植捐赠逻辑处理，点击确定调接口 (去掉)
    4.首页,
        4.1 清除本地存储后使用道具时弹窗内容没有显示，点击确定按钮后会再次弹框，显示先去兑换道具，但是这时道具有2个，点击确定会再次弹框显示请选择或者兑换工具的窗口，点击使用和兑换按钮接口调用了但是没有其他操作
        4.2 点击使用化肥按钮无效
        4.3 盾牌数量为-1
        4.4 果实领取后再次刷新页面果实仍然存在
        4.5 点击道具返回false 无任何效果
    5.个人排名未对接结束
UI：
    弹框统一字体，他的植树页面按钮使用的弹框是背景图，其他弹框使用的文字（去掉）


## 8月21日 遗留问题 + 细节
首页：
    1.点击盾牌效果（已确认）
    2.道具使用，兑换按钮调接口，弹框添加（已添加）
    3.任务领取差一个接口（已添加）
    4.缺少兑换接口

调试：
    game_member uid=00001&sign=32位字符编码
    game_fruit 果实表
    game_disaster 灾害表
    game_trees 树的状态表
    game_prop 工具表
    game_my_prop 我的工具表

## 8月22日 回归测试
首页： 
    1.果实领取后刷新页面还会存在（已修复）
    2.我的森林地图没有点赞效果（不需要）
    3.领取果实信息使用后台返回数据（已修复）
    4.化肥道具使用，有500分享比，但是提示说兑换币不够（已修复）
    5.个人排名列表添加切换效果（已修复）
    6.一个道具使用结束后才可以使用另外一个道具（已修复）
    7.弹框层级最高(已修复)

<!-- 服务启动命令 -->
/usr/local/php56/bin/php main.php close
/usr/local/php56/bin/php main.php start


## 8月23日 回归测试
首页：
    1.弹框位置固定，不能这个屏幕滑动而滑动，加个mask遮罩
    2.从别的页面返回首页的时候，会闪一下，先看到下面的排名
    3.操作步骤：
        点击一个道具，出现弹框
        点击兑换
        再次点击道具图标，此时在原有弹框后面会出现一个新的弹框
    4.道具弹框出现后就把首页上其他的按钮屏蔽了（昨天貌似记得修改了呀）
    5.灾害来的时候护盾没有自动弹出，护盾数量会减少吗？
    
