$(function(){

	$('.close','.bomb').click(function(){
		$('.bomb').hide();
	})
	//操作+1和-1小图标
	var Handlecount = {
		els:$('.planting').find('.item'),
        init:function(){},
        add:function(index){
        	var that = this;
            this.els.eq(index).find('.add1').addClass('active')
            this.dom(index,add)
            setTimeout(function(){
                that.els.eq(index).find('.add1').removeClass('active')
            },1000)
        },
        minus:function(index){
        	var that = this;
            this.els.eq(index).find('.minus1').addClass('active')
            this.dom(index)
            setTimeout(function(){
                that.els.eq(index).find('.minus1').removeClass('active')
            },1000)
        },
        dom:function(index,add){
        	var el = this.els.eq(index).find('.num');
        	var num = parseInt(el.html());
            num = add? (num+1) :(num-1);
        	el.html(num)
        }
	}
	Handlecount.init();
	//排名分类
	var Bottom = {
		bottom:$('#bottom'),
		low:window.innerHeight -80,
		taps:$('.ranking').find('.ranking-item'),
		rankBoxs:$('.rank-box').find('.rank-box-item'),
		current:$('.rank-box').find('.rank-box-item').eq(0),
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
            	that.current = that.rankBoxs.eq(index);
            })
		}
	}
	Bottom.init();
	touch.on('#bottom','swipeup',function(){
		$('#bottom').css('transform','translateY('+(-Bottom.low)+'px)')
		$('#bottom').find('.topbg').css({
			height:'30%',
			marginBottom: '-44px',
		})
	})
	touch.on('#bottom','swipedown',function(){
		$('#bottom').css('transform','translateY(0px)')
		$('#bottom').find('.topbg').css({
			height:'0px',
			marginBottom: '0px',
		})
	})
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
		event:function(i){
			var that = this;
			this.tools.find('.act').eq(i).addClass('active')
			Handlecount.minus(i)
			setTimeout(function(){
				that.qipao('add')
			},4000)
		},
		qipao(add){
			var el = $('.qipao').find('.life-num');
			var num = parseInt(el.html())
			if(add){
				$('.qipao').find('.add').addClass('active')
				num += 10;
			}else{
                $('.qipao').find('.minus').addClass('active')
                num -= 10;
			}
			el.html(num);
			setTimeout(function(){
				$('.qipao').find('.minus').removeClass('active')
				$('.qipao').find('.add').removeClass('active')
			},1500)
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
		els:$('.rank-box-item').find('.self-type-item'),
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
           	    $(this).parents('.rank-box-item').find('.self-type-box').eq(index).addClass('active').siblings().removeClass('active');
           	    // if(that.haxi[index].render) return;
                that.getData(index,1,that.haxi[index].url);
           });
           //排行列表用户点击
           $('.rank-box-item').eq(0).on('click','.self-icon',function(){
           	    console.log('777')
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
            Bottom.current.find('.self-type-box').eq(index).append(str);
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
                   console.log(data)
                   that.render(index,data)
           	   }
           })
		},

	}
	Selfrank.init();
    //灾难来袭
	var Disaster = {
		hongshui:$('.hongshui'),
		ganhan:$('.ganhan'),
		taifeng:$('.taifeng'),
		cloud:$('.cloud'),
		init:function(){
			// this.gnahancom();
			this.taifengcom();
		},
		hongshuicom:function(){
		    this.hongshui.show();	
		    this.cloud.show();
		    this.hudun();
		},
		gnahancom:function(){
			var that = this;
			this.ganhan.addClass('active')
			setTimeout(function(){
				that.hudun();
			},4000)
		},
		taifengcom:function(){
			var that = this;
            this.taifeng.addClass('active')
			that.hudun();
            setTimeout(function(){
            	that.taifeng.removeClass('active')
			},8000)
		},
		hudun:function(){
			var that = this;
			//护盾激活效果
			$('.hudun').addClass('active')
            Handlecount.minus(3);
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
	//轮播
	var Lunbo = {
		lunboCon : $('.lunbo-container'),
		lunbo : $('.lunbobox'),
		top:30,
		hei:$('.lunbobox').height(),
		init:function(){
			var that = this;
			this.lunbo.append(this.lunboCon.clone())
			this.move()
			setInterval(function(){
				if(that.top <= -that.hei){
	                that.lunbo.append($(that.lunbo.children()[0]))
	                that.lunbo.css({
	                	transition:'top 0s',
	                	top:'0px'
	                })
	        		that.top = 0;
	        	}
				setTimeout(function(){that.move();},1000)
			},3000)
		},
        move(){
        	this.lunbo.css({'transition':'top 1s'})
        	this.top -= 30;
        	this.lunbo.css({top:this.top+'px'});

        },
	}
	Lunbo.init();
	var Guoshi = {
		num :2,
		el:$('.old','.tree'),
		init:function(){
            this.render(this.num)
		},
		getT(){
			return parseInt(17+Math.random()*25)
		},
		getL(){
			return parseInt(18+Math.random()*56)
		},
		render(num){
			var str = '';
           for(var i =0;i<num;i++){
              str+= '<div style="top:'+this.getT()+'%;left:'+this.getL()+'%;" class="guoshi"></div>'
           }
           this.el.append(str)
		}
	}
	Guoshi.init();
})