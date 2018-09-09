<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<header class="header bg-white b-b b-light"><p><i class="fa fa-tags"></i> 标签管理</p></header>
	<section class="scrollable wrapper">
		<form action="{:U('Tag/tagList')}" method="post" name="form_tag" id="form_tag">
			<div class="row">
			<notempty name="tagList">
				<volist name="tagList" id="vo">
					<div class="col-lg-2-4">
						<section class="panel panel-default">
							<div class="panel-body">
								<label class="checkbox-inline checkbox i-checks" style="margin-top:0px;">
								<input type="checkbox" name="tag[]" class="ids" value="{$vo.id}" />
								<i></i>
								<a href="{:U('Tag/editTag')}?tid={$vo.id}">{$vo.name}</a>
								</label>
							</div>
						</section>
					</div>
				</volist>
			<else />
				<div class="alert alert-danger">还没有标签，写文章的时候可以给文章打标签</div>
			</notempty>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-body">
						<div class="form-group">
							<a href="javascript:void(0);" id="select_all" class="btn btn-default">全选</a>
							<a href="javascript:deltags();" class="btn btn-default" >删除</a>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
<script>
selectAllToggle();
function deltags(){
	if (getChecked('ids') == false) {
		alert('请选择要删除的标签');
		return;
	}
	if(!confirm('你确定要删除所选标签吗？')){return;}
	$("#form_tag").submit();
}

$("#menu_tag").addClass('active').siblings().removeClass('active');
</script>