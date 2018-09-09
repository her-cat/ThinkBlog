function getChecked(node) {
	var re = false;
	$('input.'+node).each(function(i){
		if (this.checked) {
			re = true;
		}
	});
	return re;
}

function focusEle(id){try{document.getElementById(id).focus();}catch(e){}}
function hideActived(){
	$(".actived").hide();
	//$(".error").hide();
}

function isalias(a){
	var reg1=/^[\u4e00-\u9fa5\w-]*$/;
	var reg2=/^[\d]+$/;
	var reg3=/^post(-\d+)?$/;
	if(!reg1.test(a)) {
		return 1;
	}else if(reg2.test(a)){
		return 2;
	}else if(reg3.test(a)){
		return 3;
	}else if(a=='t' || a=='m' || a=='admin'){
		return 4;
	} else {
		return 0;
	}
}
function checkform(){
	var a = $.trim($("#alias").val());
	var t = $.trim($("#title").val());
	if (t==""){
		alert("标题不能为空");
		$("#title").focus();
		return false;
	}else if(0 == isalias(a)){
		return true;
	}else {
		alert("链接别名错误");
		$("#alias").focus();
		return false
	}
}
function checkalias(){
	var a = $.trim($("#alias").val());
	if (1 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">别名错误，应由字母、数字、下划线、短横线组成</span>');
	}else if (2 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">别名错误，不能为纯数字</span>');
	}else if (3 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">别名错误，不能为\'post\'或\'post-数字\'</span>');
	}else if (4 == isalias(a)){
		$("#alias_msg_hook").html('<span id="input_error">别名错误，与系统链接冲突</span>');
	}else {
		$("#alias_msg_hook").html('');
		$("#msg").html('');
	}
}
function addattach_img(fileurl,imgsrc,aid, width, height, alt){
	if (editorMap['content'].designMode === false){
		alert('请先切换到所见所得模式');
	}else if (imgsrc != "") {
		editorMap['content'].insertHtml('<a target=\"_blank\" href=\"'+fileurl+'\" id=\"ematt:'+aid+'\"><img src=\"'+imgsrc+'\" title="点击查看原图" alt=\"'+alt+'\" border=\"0\" width="'+width+'" height="'+height+'"/></a>');
	}
}
function addattach_file(fileurl,filename,aid){
	if (editorMap['content'].designMode === false){
		alert('请先切换到所见所得模式');
	} else {
		editorMap['content'].insertHtml('<span class=\"attachment\"><a target=\"_blank\" href=\"'+fileurl+'\" >'+filename+'</a></span>');
	}
}
//act:0 auto save,1 click attupload,2 click savedf button, 3 save page, 4 click page attupload

$.fn.toggleClick = function(){
    var functions = arguments ;
    return this.click(function(){
            var iteration = $(this).data('iteration') || 0;
            functions[iteration].apply(this, arguments);
            iteration = (iteration + 1) % functions.length ;
            $(this).data('iteration', iteration);
    });
};
function selectAllToggle(){
    $("#select_all").toggleClick(function () {$(".ids").prop("checked", "checked");},function () {$(".ids").removeAttr("checked");});
}

	function saveArticle(url){
		if ($.trim($("#title").val()) == '') {
			$("#msg").html("<span class=\"msg_autosave_error\">标题为空将不会自动保存！</span>");
			return;
		};
		$("#msg").html("<span class=\"msg_autosave_do\">正在保存...</span>");
		var btname = $("#savedf").val();
		$("#savedf").val("正在保存");
		$("#savedf").attr("disabled", "disabled");
        $.post(url, {
        	"aid" :  $("#aid").val(),
			"title" : $.trim($("#title").val()),
			"content" : ue.getContent(),
			"category" : $.trim($("#category").val()), 
			"author" : $("#author").val(),
			"tag" : $.trim($("#tag").val()), 
			"top" : $("#is_top").attr("checked") == 'checked' ? 'y' : 'n',
			"open_comment" : $("#open_comment").val(),
			"post_time" : $("#post_time").val()
		}, function(data){
			if(data.status == 100){
				$("#aid").val(data.aid);
				var digital = new Date();
	    		var hours = digital.getHours();
	    		var mins = digital.getMinutes();
	    		var secs = digital.getSeconds();
				$("#msg_2").html("<span class=\"ajax_remind_1\">成功保存于 "+hours+":"+mins+":"+secs+" </span>");
				$("#savedf").attr("disabled", false);
	    		$("#savedf").val(btname);
	    		$("#msg").html("");
			}else{
				$("#savedf").attr("disabled", false);
		    	$("#savedf").val(btname);
		    	$("#msg").html("<span class=\"msg_autosave_error\">网络或系统出现异常...保存可能失败</span>");
			}
		},'json');
	}