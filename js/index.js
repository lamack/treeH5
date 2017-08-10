$(function(){

	// 启动页
	setTimeout(function(){
		$('.launch').hide();
		$('.container').show();
	},3000);

	$('.close','.bomb').click(function(){
		$('.bomb').hide();
	})
	//排名分类
	var Bottom = {
		bottom:$('#bottom'),
		low:window.innerHeight -80,
		taps:$('.ranking').find('.ranking-item'),
		rankBoxs:$('.rank-box').find('.rank-box-item'),
		init:function(){
			this.bottom.css('bottom',-this.low+'px');
			this.bindEvent();
		},
		bindEvent:function(){
			var that = this;
            this.taps.on('click',function(){
            	var index = $(this).index()
            	$(this).addClass('active').siblings().removeClass('active');
            	that.rankBoxs.eq(index).addClass('active').siblings().removeClass('active');
            })
            this.bottom.swipeUp(function(){
            	that.bottom.css('transform','translateY('+-that.low+'px)')
            })
            this.bottom.swipeDown(function(){
            	that.bottom.css('transform','translateY(0px)')
            })
		},
		swiperUp:function(){
			this.bottom.addClass('active')
		},
		swiperDown:function(){
			this.bottom.removeClass('active')
		}
	}
	Bottom.init();
    //植树
	var Tree = {
		tree:$('.tree').find('.tree-box'),
		tools:$('.planting').find('.item'),
		bomb:$('.bomb'),
		now:2,
		next:null,
		index:0,
		init:function(){
			this.next = this.now-1;
			this.bindEvent();
		},
		bindEvent:function(){
			var that = this;
			//点击工具
            this.tools.click(function(){
            	if($(this).index()==3) return;
            	that.index = $(this).index();
            	//兑换弹框显示
            	that.bomb.show()
            });
            // 点击使用
            this.bomb.find('.use').click(function(event) {
            	that.event(that.index);
            	that.bomb.hide();
            	//树苗成长
            	setTimeout(function(){
            		that.growing(that.now,that.next)
            	    that.now --;
            	    that.tools.find('.act').eq(that.index).removeClass('active')
            	},4000)
            });
            // 点击兑换

		},
		//植树效果
		event(i){
			this.tools.find('.act').eq(i).addClass('active')
		},
		growing:function(now,next){
			var that = this;
			var heinow = this.tree.eq(now).height();
			var heinext = this.tree.eq(next).height();
			var per = heinext/heinow;
			this.tree.eq(now).css({
				transform:'scale('+per+','+per+')',
				opacity:0,
			})
			setTimeout(function(){	
				that.tree.eq(next).css({
					opacity:1,
				})
				that.next --;
			},1000)
		}
	}
	Tree.init();

	// 个人排名
	var Selfrank = {
		els:$('.rank-box').find('.self-type-item'),
		selfboxs:$('.rank-box').find('.self-type-box'),
		haxi:{
			0:{url:'',render:true,page:1},
			1:{url:'',render:false,page:1},
			2:{url:'',render:false,page:1},
		},
		init:function(){
			var data = [
               {name:'张三',num:'999',url:'',rank:1},
               {name:'张三',num:'999',url:'',rank:2},
               {name:'张三',num:'999',url:'',rank:3},
               {name:'张三',num:'999',url:'',rank:4},
               {name:'张三',num:'999',url:'',rank:5},
			];
			this.render(0,data)
			this.bindEvent();
		},
		bindEvent:function(){
			var that = this;
           this.els.click(function(event) {
           	    var index = $(this).index();
           	    that.selfboxs.eq(index).addClass('active').siblings().removeClass('active');
           	    if(that.haxi[index].render) return;
                that.getData(index,1,that.haxi[index].url);
           });
           //排行列表用户点击
           this.selfboxs.on('click','.self-icon',function(){
                location.href = 'pages/other.html'
           })
		},
		render:function(index,data){
			var str = ''
            for(var i = 0;i<data.length;i++){
            	var rank = data[i].rank;
            	switch(rank){
            		case 1:
            		rank = '<img scr="imagse/">';
            		break;
            		case 2:
            		rank = '<img scr="imagse/">';
            		break;
            		case 3:
            		rank = '<img scr="imagse/">';
            		break;
            	}

                str+='<div class="rank-list flex">'
					+	'<div class="rank-num">'+rank+'</div>'
					+	'<div class="self-icon"><img src="'+data[i].url+'"></div>'
					+	'<div class="self-name flex-1">'+data[i].name+'</div>'
					+	'<div class="self-num">'+data[i].num+'</div>'
				+	'</div>'
            }
            this.selfboxs.eq(index).append(str);
            this.haxi[index].render = true;
		},
		getData:function(index,page,url){
		   var that = this;
		   //getData从public.js引用，封装的ajax
		   getData({
           	   url:url,
           	   data:{
           	   	 page:page,
           	   },
           	   success:function(data){
           	   	   data = JSON.parse(data)
                   that.render(index,data)
           	   }
           })
		},

	}
	Selfrank.init();

	var Disaster = {
		hongshui:$('.hongshui'),
		ganhan:$('.ganhan'),
		cloud:$('.cloud'),
		init:function(){
			this.hongshuicom();
		},
		hongshuicom(){
			this.hongshui.show();
			this.cloud.show();
			this.hudun();
		},
		hudun:function(){
			var that = this;
			//护盾激活效果
			$('.hudun').addClass('active')
			//护盾运动效果
			$('.gethudun').addClass('active')
			//护盾效果结束
			setTimeout(function(){
				$('.hudun').removeClass('active')
				$('.gethudun').removeClass('active')
				that.hongshui.hide();
				that.cloud.hide();
			},4000)
		}
	}
	Disaster.init();
})