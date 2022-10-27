/*!
 * kesion.popup.js by zhuang
 * Date: 2017-6-30 13:51
 * 厦门科汛软件有限公司　 版权所有 © 2006-2017
 * 官方地址：http://www.kesion.com
 * 
 * 24小时服务热线：400-008-0263
 * 
 */

var popup = {
	openData:{},
	confirmMethod:{
		yes:{},
		no:{}
	},
	flag:true,
	id:0,
	open:function(parameter,type){
			this.id++;
			var title = parameter.title || '标题';
			var area = parameter.area || ['400', '300'];
			var drag = parameter.drag;
			var scrollbar = parameter.scrollbar;
			var shade = parameter.shade;
			var url = parameter.url || '';
			var data = parameter.data;
			if(shade==undefined){
				shade = 0.2;
			};
			var shade2 = shade*100;
			var width = area[0];
			var height = area[1];
			var marginTop = height/2;
			var marginLeft = width/2;
			var overflow = $('body').css('overflow');
			var close = parameter.close;
			var closeSwitch = parameter.closeSwitch;
			
			if(scrollbar==false){
				var bodyOverflow = $('body').css('overflow');
				$('body').css({overflow:'hidden'}).attr('overflow',bodyOverflow);
			};
			var zIndex = '',
				shadeZIndex = '';
			if(parameter.zIndex){
				var shadeZIndexValue = parameter.zIndex-10;
				zIndex = 'z-index:'+parameter.zIndex;
				shadeZIndex = 'z-index:'+shadeZIndexValue;
			}			
	

			if(shade!=0&&type!='box'){
				var shadeHtml = '<div class="ks-popup-shade ks-popup-shade'+this.id+'" style="filter:alpha(opacity='+shade2+'); -moz-opacity:'+shade+'; -khtml-opacity: '+shade+';  opacity: '+shade+';'+shadeZIndex+'"></div>';
			}else{
				var shadeHtml = '';
			};

			var iframeName = "'ks-popup-iframe"+this.id+"'";
			var closeBtn = '<span class="ks-popup-close" onclick="closePopup('+iframeName+')"></span>'
			if(closeSwitch==false){
				closeBtn = '';
			};
			var bradius = '';
			if(parameter.bradius){
				bradius = 'border-radius:'+parameter.bradius;
			};
			var style = 'width:'+width+'px;height:'+height+'px;margin-top:-'+marginTop+'px;margin-left:-'+marginLeft+'px;';
			var boxClass = '';
			var popupContent = '<iframe height="100%" width="100%" src="'+url+'" name="ks-popup-iframe'+this.id+'"></iframe>';
			
			if(type=='box'){
				
				var content = parameter.content || '';
				width = parameter.width || 600;
				popupContent = '<div class="ks-popup-content">'+content+'</div>';
				
				$('.ks-popup-inbox').remove();
				var e = parameter.event;
				boxClass = ' ks-popup-inbox';
				
				var $target = $(e.target);
				
				var clientX = e.clientX;
				
				var offsetTop = $target.offset().top+$target.outerHeight();
				
				var cssX = 'left:'+clientX+'px;';
				var cssY = 'top:'+offsetTop+'px;'
				if(clientX>window.innerWidth/2){
					var offsetRight = window.innerWidth-clientX-$target.outerWidth();
					cssX = 'left:inherit;right:'+offsetRight+'px;';
					
				};
				if(offsetTop>window.innerHeight/2){
					var offsetBottom = window.innerHeight-$target.offset().top;
					cssY = 'top:inherit;bottom:'+offsetBottom+'px;';
					
				};
				style = 'width:'+width+'px;'+cssX+cssY;
				
			};
			$('body').append('<div class="ks-popup-box'+boxClass+' ks-popup-box'+this.id+'" style="'+style+''+zIndex+''+bradius+'">\n'+
							 '	<div class="ks-popup-title">'+closeBtn+'<strong>'+title+'</strong></div>\n'+
							 '	'+popupContent+'\n'+
							 '</div>\n'+shadeHtml+'');
			
			//检测到有数据传入，对数据进行存储
			
			if(data){
				this.openData['ks-popup-iframe'+this.id] = data;
			};

			$('.ks-popup-close').click(function(){
				if(close){
					close();
				}
				
			});
			$('.ks-popup-shade'+this.id+',.ks-popup-box'+this.id+'').fadeIn(300);
			
			var $popupBox = $('.ks-popup-box'+this.id);
			
			if(type!='box'){
				$popupBox.find('iframe').height(height-44); //44为标题高度
			};
			//拖动
			if(drag==true){
				var selectFlag = true; //页面复制
				var dragFlag = false;//拖拽开关
				var clientX = 0;
				var clientY = 0;
				var ml = 0;
				var mt = 0;
				var minLeft = 0;
				var maxRight = 0;
				var minTop = 0;
				var maxTop = 0;
				var $popupTitle = $popupBox.find('.ks-popup-title');
				$popupTitle.addClass('ks-popup-title-move');
				$popupTitle.mousedown(function(e){

					selectFlag = false;
					dragFlag = true;
					clientX = e.clientX;
					clientY = e.clientY;
					
					ml = Number($popupBox.css('marginLeft').replace('px',''));
					mt = Number($popupBox.css('marginTop').replace('px',''));

					minLeft = ml-$popupBox[0].offsetLeft;
					maxRight = ml + ($(window).width()-$popupBox[0].offsetLeft-$popupBox.outerWidth());

					minTop = mt-$popupBox[0].offsetTop;
					
					maxTop = mt + ($(window).height()-$popupBox[0].offsetTop-$popupBox.outerHeight());
					
				});
				
				$(document).mousemove(function(e){
					if(dragFlag==true){
						
						var X = e.clientX-clientX;
						
						if(X>0){
							//向右
							var popupLeft = Math.min(ml+X,maxRight);
						}else{
							//向左
							var popupLeft = Math.max(ml-(-X),minLeft)
						};

						var Y = e.clientY-clientY;
						
						if(Y>0){
							//向下
							var popupTop = Math.min(mt+Y,maxTop);
						}else{
							//向上
							var popupTop = Math.max(mt-(-Y),minTop)
						};

						
						$popupBox.css({marginLeft:popupLeft+'px',marginTop:popupTop+'px'});
						
					};
				});
				$(document).mouseup(function(){
					dragFlag = false;
					selectFlag = true;
				});
				
				$(document).bind("selectstart",function(){
					if(selectFlag==true){
						return true;
					}else{
						return false;
					};
				});
				
			};

	},
	box:function(parameter){
		this.open(parameter,'box');

	},
	confirm:function(parameter){
		if(this.flag==true){
			this.flag = false;
			this.id++;
			var title = parameter.title || '您确定执行该操作吗？';
			var yes = parameter.yes;
			var no = parameter.no;
			var isYes = ' data-isyes="0"';
			var isNo = ' data-isno="0"';
			if(yes){
				isYes = ' data-isyes="1"';
				this.confirmMethod.yes['ks-popup-confirm'+this.id] = yes;	
			};
			if(no){
				isNo = ' data-isno="1"';
				this.confirmMethod.no['ks-popup-confirm'+this.id] = no;	
			};
			
			$('body').append('<div class="ks-popup-confirm ks-popup-confirm'+this.id+' ks-popup-zoomIn"><div class="ks-popup-inner">'+title+'</div><div class="ks-popup-button"><button class="ks-popup-yes" onclick="popup.cofirmDoYes(this)" data-name="ks-popup-confirm'+this.id+'"'+isYes+'>确定</button><button class="ks-popup-no" onclick="popup.cofirmDoNo(this)" data-name="ks-popup-confirm'+this.id+'"'+isNo+'>取消</button></div></div>');

		};
	},
	//执行Cofirm确认函数
	cofirmDoYes:function(target){
		var that = this;
		var cofirmName = $(target).attr('data-name');
		var isYes = $(target).attr('data-isyes');
		$('.'+cofirmName).addClass('ks-popup-zoomOut');
		setTimeout(function(){
			$('.'+cofirmName).remove();
			that.flag = true;
		},300);
		if(isYes==1){
			this.confirmMethod.yes[cofirmName]();
		};
	},
	//执行Cofirm取消函数
	cofirmDoNo:function(target){
		var that = this;
		var cofirmName = $(target).attr('data-name');
		var isNo = $(target).attr('data-isno');
		$('.'+cofirmName).addClass('ks-popup-zoomOut');
		setTimeout(function(){
			$('.'+cofirmName).remove();
			that.flag = true;
		},300);
		if(isNo==1){
			this.confirmMethod.no[cofirmName]();
		};
	},
	tips:function(parameter){
		
		if(this.flag==true){
			this.flag = false;
			this.id++;
			var title = parameter.title || '这是一条提示信息';
			var interval = parameter.interval || 600;
			var callback = parameter.callback;
			$('body').append('<div class="ks-popup-tips ks-popup-tips'+this.id+' ks-popup-zoomIn"><div class="ks-popup-inner">'+title+'</div></div>');
			var tipsWidth = ($('.ks-popup-tips'+this.id+'').width()+40)/2;
			$('.ks-popup-tips'+this.id+'').css({marginLeft:'-'+tipsWidth+'px'});
			$('.ks-popup-tips').not('.ks-popup-tips'+this.id+'').remove();
			
			var that = this;
			setTimeout(function(){
				$('.ks-popup-tips'+that.id+'').fadeOut(300);
				$('.ks-popup-tips'+that.id+'').remove();	
				that.flag = true;
				if(callback){
					callback();
				};		
			},interval);
		};
	},
	//获取窗口传入data
	data:function(name){
		return this.openData[name];
	}
};



//关闭
function closePopup(name,closeFunction){
	if(name=='all'){
		var id = '';	
	}else{
		var id = name.split('ks-popup-iframe')[1];
	}
	$('.ks-popup-shade'+id+',.ks-popup-box'+id+'').fadeOut(300);
	setTimeout(function(){
		$('.ks-popup-shade'+id+',.ks-popup-box'+id+'').remove();
		if($('body').attr('overflow')){
			$('body').css({overflow:$('body').attr('overflow')});
		}
	},300);
	if(closeFunction){
		closeFunction();
	}
};


function closePopupBox(){
	$('.ks-popup-inbox').remove();
};


