//向上按钮
function pageScroll(){
    //把内容滚动指定的像素数（第一个参数是向右滚动的像素数，第二个参数是向下滚动的像素数）
    window.scrollBy(0,-100);
    //延时递归调用，模拟滚动向上效果
    scrolldelay = setTimeout('pageScroll()',40);
    //获取scrollTop值，声明了DTD的标准网页取document.documentElement.scrollTop，否则取document.body.scrollTop；因为二者只有一个会生效，另一个就恒为0，所以取和值可以得到网页的真正的scrollTop值
    var sTop=document.documentElement.scrollTop+document.body.scrollTop;
    //判断当页面到达顶部，取消延时代码（否则页面滚动到顶部会无法再向下正常浏览页面）
    if(sTop==0) clearTimeout(scrolldelay);
}

//重写了common.js里的同名函数
function RevertComment(i) {
	$("#inpRevID").val(i);
	var frm = $('#respond_box'),
		cancel = $("#cancel-comment-reply-link"),
		temp = $('#temp-frm');
	var div = document.createElement('div');
	div.id = 'temp-frm';
	div.style.display = 'none';
	frm.before(div);
	$('#AjaxComment' + i).before(frm);
	frm.addClass("reply-frm");

	cancel.show();
	cancel.click(function() {
		$("#inpRevID").val(0);
		var temp = $('#temp-frm'),
			frm = $('#respond_box');
		if (!temp.length || !frm.length) return;
		temp.before(frm);
		temp.remove();
		$(this).hide();
		frm.removeClass("reply-frm");
		return false;
	});
	try {
		$('#txaArticle').focus();
	} catch (e) {}
	return false;
}

function CommentComplete(){
$("#cancel-comment-reply-link").click();
}
//*enter+ctrl快捷键*********************

$(document).keypress(function(e){
      var s = $('#respond #submit');
      if( e.ctrlKey && e.which == 13 || e.which == 10 ){ 
        s.click();
        document.body.focus();
        return;
      }
      if( e.shiftKey && e.which==13 || e.which == 10 ) s.click();
    })

$(document).ready(function(){
//隐藏侧栏开启侧栏
$('#f_c a').click(function(){
       $("#sidebar").hide(500);
	   $("#content-main").animate({width:"99.7%"});
	   $("#f_c").css("display","none");
	   $("#f_o").css("display","list-item");
    });
$('#f_o a').click(function(){
       $("#sidebar").show(500);
	   $("#content-main").animate({width:"72%"});
	   $("#f_o").css("display","none");
	   $("#f_c").css("display","list-item");
    }); 
//手机版菜单
	$('#mobile-nav a').click(function(){
       $("#nav-menu").slideToggle(500);
    });
});

//放大缩小字体
$(document).ready(function () {
	//min font size
	var min=5; 	

	//max font size
	var max=50;	
	
	//grab the default font size
	var reset = $('p').css('fontSize'); 
	
	//font resize these elements
	var elm = $('.post-content');  
	
	//set the default font size and remove px from the value
	var size = str_replace(reset, 'px', ''); 
	
	//Increase font size
	$('#f_l a').click(function() {
		
		//if the font size is lower or equal than the max value
		if (size<=max) {
			
			//increase the size
			size++;
			
			//set the font size
			elm.css({'fontSize' : size});
		}
		
		//cancel a click event
		return false;	
		
	});

	$('#f_s a').click(function() {

		//if the font size is greater or equal than min value
		if (size>=min) {
			
			//decrease the size
			size--;
			
			//set the font size
			elm.css({'fontSize' : size});
		}
		
		//cancel a click event
		return false;	
		
	});
	
	//Reset the font size
	$('#f_m a').click(function () {
		
		//set the default font size	
		 elm.css({'fontSize' : reset});		
	});
	$("#btnSumbit").click(function (){
		var strFormAction = $("#inpId").parent("form").attr("action");
		$.post(strFormAction + "getCommToken",
			function(data){
				VerifyMessage(data);
				return false;
			}
		);
	});
	LoadRememberInfo();
});

//A string replace function
function str_replace(haystack, needle, replacement) {
	var temp = haystack.split(needle);
	return temp.join(replacement);
}

