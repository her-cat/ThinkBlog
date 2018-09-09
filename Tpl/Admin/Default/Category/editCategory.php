<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="i i-add-to-list icon fa-fw"></i> 编辑分类</header>
					<div class="panel-body">
						<form class="form-horizontal" action="{:U('Category/editCategory')}" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">名称：</label>
								<div class="col-sm-10">
									<input value="{$category.name}" name="name" id="sortname" class="form-control">
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">别名：</label>
								<div class="col-sm-10">
									<input value="{$category.alias}" name="alias" id="alias" class="form-control">
								</div>
							</div>
							<neq name="category.parent_id" value="0">
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">父分类：</label>
								<div class="col-sm-10">
									<select name="parent_id" id="pid" class="form-control m-b">
										<option value="0" <eq name="category.parent_id" value="0"> selected="selected" </eq>>无</option>
										<volist name="parentCategory" id="vo">
										<option value="{$vo.id}" <eq name="vo.id" value="$category['parent_id']">selected="selected"</eq>>{$vo.name}</option>
										</volist>
									</select>
								</div>
							</div>
							</neq>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input type="hidden" value="{$category.id}" name="cid" />
									<input type="submit" value="保 存" class="btn btn-primary" id="save"  />
									<input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" />
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
<script>
$("#menu_sort").addClass('active');
$("#alias").keyup(function(){checksortalias();});
function issortalias(a){
	var reg1=/^[\w-]*$/;
	var reg2=/^[\d]+$/;
	if(!reg1.test(a)) {
		return 1;
	}else if(reg2.test(a)){
		return 2;
	}else if(a=='post' || a=='record' || a=='sort' || a=='tag' || a=='author' || a=='page'){
		return 3;
	} else {
		return 0;
	}
}
function checksortalias(){
	var a = $.trim($("#alias").val());
	if (1 == issortalias(a)){
		$("#save").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名错误，应由字母、数字、下划线、短横线组成</span>');
	}else if (2 == issortalias(a)){
		$("#save").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名错误，不能为纯数字</span>');
	}else if (3 == issortalias(a)){
		$("#save").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名错误，与系统链接冲突</span>');
	}else {
		$("#alias_msg_hook").html('');
		$("#msg").html('');
		$("#save").attr("disabled", false);
	}
}
</script>\