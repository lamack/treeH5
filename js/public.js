/*var publicHei = window.innerHeight-40
$('#container').height(publicHei)*/
$('#back').on('click',function(){
	window.history.back(-1)
})
//请求地址的域名
var host = 'http://xxxx';
var baseData = {

}
var getData=function(data){
    type = data.type ? 'get':'type';
    data = data.data? {}:data.data
    $.ajax({
    	type:type,
    	url:host+data.url,
    	data:$.extend(baseData,data),
    	success:data.success
    })
}