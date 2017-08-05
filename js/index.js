$(function(){
	$('.exchange').click(function(){
		$('.bomb').show()
	});
	$('.cancle','.bomb').click(function(){
		$('.bomb').hide();
	})
	$('.close','.bomb').click(function(){
		$('.bomb').hide();
	})
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
            	that.bottom.css('transform','translateY('+-that.low+'px)')
            })
           /* this.bottom.tap(function(){
            	console.log(this)
            })*/
		},
		swiperUp:function(){
			this.bottom.addClass('active')
		},
		swiperDown:function(){
			this.bottom.removeClass('active')
		}
	}
	Bottom.init();
})