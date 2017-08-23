var publicHei = window.innerHeight-40
$('#container').height(publicHei)
$('#back').on('click',function(){
	window.history.back(-1)
})
//请求地址的域名
var host = 'http://tree.com/index.php/index/index';
var baseData = {

}


var getData=function(data){
    type = data.type ? data.type :'get';
    var datas = data.data? data.data: {};
    var baseUrl = host+data.url;
    if (data.url.indexOf('index.php')!=-1) {
        baseUrl = 'http://tree.com'+data.url;
    }
    $.ajax({
        type:type,
        url:baseUrl,
        data:$.extend(baseData,datas),
        success:data.success
    })
}
function myBrowser(){
    var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
    if (userAgent.indexOf("Safari") > -1) {
        return "Safari";
    }
}
var mb = myBrowser();
var chengfa = 1;
if("Safari" == mb){
    var viewp = $('meta[name="viewport"]');
    var width = window.innerWidth;
     viewp.attr('content','width='+width+'px, minimum-scale=1,maximum-scale=1,initial-scale=1.0, user-scalable=no');
}