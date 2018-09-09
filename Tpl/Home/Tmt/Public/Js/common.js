///////////////////////////////////////////////////////////////////////////////
//              Z-Blog
// 作    者:    朱煊(zx.asd)
// 版权所有:    RainbowSoft Studio
// 技术支持:    rainbowsoft@163.com
// 程序名称:    
// 程序版本:    
// 单元名称:    common.js
// 开始时间:    2004.07.25
// 最后修改:    
// 备    注:    全局脚本
///////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////
//              嵌入 jQuery
///////////////////////////////////////////////////////////////////////////////

var lang_comment_name_error = "名称不能为空或格式不正确";
var lang_comment_email_error = "邮箱格式不正确，可能过长或为空";
var lang_comment_content_error = "评论内容不能为空或过长";
//*********************************************************
// 目的：    设置Cookie
// 输入：    sName, sValue,iExpireDays
// 返回：    无
//*********************************************************
function SetCookie(sName, sValue,iExpireDays) {
	var path=(typeof(cookiespath)=="undefined") ? "/":cookiespath;
	if (iExpireDays){
		var dExpire = new Date();
		dExpire.setTime(dExpire.getTime()+parseInt(iExpireDays*24*60*60*1000));
		document.cookie = sName + "=" + escape(sValue) + "; expires=" + dExpire.toGMTString()+ "; path="+path;
	}
	else{
		document.cookie = sName + "=" + escape(sValue)+ "; path="+path;
	}
}
//*********************************************************




//*********************************************************
// 目的：    返回Cookie
// 输入：    Name
// 返回：    Cookie值
//*********************************************************
function GetCookie(sName) {
	var arr = document.cookie.match(new RegExp("(^| )"+sName+"=([^;]*)(;|$)"));
	if(arr !=null){return unescape(arr[2])};
	return null;

}
//*********************************************************




//*********************************************************
// 目的：    验证信息
// 输入：    无
// 返回：    无
//*********************************************************

function VerifyMessage(t) {
	var strFormAction=$("#inpId").parent("form").attr("action");
	var strName=$("#inpName").val();
	var strEmail=$("#inpEmail").val();
	var strHomePage=$("#inpHomePage").val();
	var strVerify=$("#inpVerify").val();
	var strArticle=$("#txaArticle").val();
	var intReplyID=$("#inpRevID").val();
	var intPostID=$("#inpId").val();
	var intMaxLen=1000;
	// return false;
	if(strName==""){
		alert((typeof(lang_comment_name_error)=="undefined") ? "name error":lang_comment_name_error);
		return false;
	}
	else{
		re = new RegExp("^[\.\_A-Za-z0-9\u4e00-\u9fa5]+$");
		if (!re.test(strName)){
			alert((typeof(lang_comment_name_error)=="undefined") ? "name error":lang_comment_name_error);
			return false;
		}
	}

	if(strEmail==""){
		alert("邮箱不能为空！");
		return false;
	}
	else{
		re = new RegExp("^[\\w-]+(\\.[\\w-]+)*@[\\w-]+(\\.[\\w-]+)+$");
		if (!re.test(strEmail)){
			alert((typeof(lang_comment_email_error)=="undefined") ? "email error":lang_comment_email_error);
			return false;
		}
	}

	if(typeof(strArticle)=="string"){
		if(strArticle==""){
			alert((typeof(lang_comment_content_error)=="undefined") ? "content error":lang_comment_content_error);
			return false;
		}
		if(strArticle.length>intMaxLen)
		{
			alert((typeof(lang_comment_content_error)=="undefined") ? "content error":lang_comment_content_error);
			return false;
		}
	}

	//ajax comment begin
	var strSubmit=$("#inpId").parent("form").find(":submit").val();
	$("#inpId").parent("form").find(":submit").val("Waiting...").attr("disabled","disabled").addClass("loading");
	$.post(strFormAction + "addComment",
		{
		"isAjax":true,
		"postId":intPostID,
		"verify":strVerify,
		"name":strName,		
		"email":strEmail,
		"content":strArticle,
		"url":strHomePage,
		"replyId":intReplyID,
		"token":t
		},
		function(data){
			$("#inpId").parent("form").find(":submit").removeClass("loading");
			$("#inpId").parent("form").find(":submit").removeAttr("disabled");
			$("#inpId").parent("form").find(":submit").val(strSubmit);
			var obj = eval("(" + data + ")"); 
			if(obj.state == 100){
				obj.floor = parseInt($("#comments").text()) + 1;
				insertComment(obj)
				window.location="#cmt" + obj.cid;
				$("#comments").text(obj.floor + "条大神的评论")
				$("#txaArticle").val("");
				t = '';
				SaveRememberInfo();
				CommentComplete();
			}else{
				alert(obj.msg);
			}
		}
	);

	return false;
	//ajax comment end

}
//*********************************************************



//*********************************************************
// 目的：    加载信息
// 输入：    无
// 返回：    无
//*********************************************************
function LoadRememberInfo() {
	var strName=GetCookie("visitor_nickname");
	var strEmail=GetCookie("visitor_email");
	var strHomePage=GetCookie("visitor_url");
	if(strName){$("#inpName").val(strName);}
	if(strEmail){$("#inpEmail").val(strEmail);}
	if(strHomePage){$("#inpHomePage").val(strHomePage);}

}
//*********************************************************


//*********************************************************
// 目的：    保存信息
// 输入：    无
// 返回：    无
//*********************************************************
function SaveRememberInfo() {
	var strName=$("#inpName").val();
	var strEmail=$("#inpEmail").val();
	var strHomePage=$("#inpHomePage").val();
	SetCookie("visitor_nickname",strName,365);
	SetCookie("visitor_email",strEmail,365);
	SetCookie("visitor_url",strHomePage,365);

}
//*********************************************************




//*********************************************************
// 目的：    回复留言
// 输入：    无
// 返回：    无
//*********************************************************
function RevertComment(i) {
	$("#inpRevID").val(i);
	$("#cancel-reply").show().bind("click", function(){ 
		$("#inpRevID").val(0);
		$(this).hide();
		$("#isChild").val('n');
		window.location.hash="#comment";
		return false;
	 });
	window.location.hash="#comment";
}
//*********************************************************


function insertComment(data){
	if (data.replyId != 0) {
		data.content = '回复 <a href="javascript:void(0);" class="at">' + data.replyName + '</a>：' + data.content;
	}
	isChild = $("#isChild").val();
	var commStr = '<label id="cmt' + data.cid + '"></label>';
		commStr += '<li class="comment even thread-even depth-1" id="comment-' + data.cid + '">';
    	commStr += '<div id="div-comment-' + data.cid + '" class="comment-body">';
    	commStr += '<div class="comment-author vcard gravatar">';
    	commStr += '<img src="' + data.headImg + '"alt="avatar" class="avatar avatar-50 photo" height="50" width="50"></div>';
    	if (data.replyId == 0) commStr += '<div class="floor">' + data.floor + '楼</div>';
    	commStr += '<div class="commenttext">';
        commStr += '<span class="commentid"><a href="' + data.url + '" rel="external nofollow" class="url">' + data.nickname + '</a></span>';
        commStr += '<span class="datetime">' + data.add_time + '</span>';
        commStr += '<span class="reply"><a class="comment-reply-link" href="#reply"';
        commStr += 'onclick="RevertComment(\'' + data.cid + '\');"';
        commStr += 'rel="nofollow"> 回复</a></span>';
        commStr += '<span class="edit_comment"></span>';
        commStr += '<div class="comment_text">';
        commStr += '<p>' + data.content + '</p>';
        commStr += '</div></div></div></li><label id="AjaxComment' + data.cid + '"></label>';
    if(data.replyId == 0){
		$(commStr).insertAfter("#AjaxCommentBegin");
	}else{
		$(commStr).insertAfter("#AjaxComment"+data.replyId);
	}
}






//*********************************************************
// 目的：  预留空函数,留给主题或插件用  
//*********************************************************
function CommentComplete(){
}
//*********************************************************