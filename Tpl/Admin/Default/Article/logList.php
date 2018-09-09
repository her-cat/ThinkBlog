<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="hbox stretch">
	<aside class="lter">
		<section class="vbox">
			<header class="header bg-white b-b clearfix">
				<div class="row m-t-sm">
					<div class="col-sm-8 m-b-xs">
						<div class="btn-group">
							<a href="{:U('Article/logList')}" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></a>
							<a href="javascript:logact('del');" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></a>
							<a data-target="#tags" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-tags"></i> 按标签查看</a>
						</div>
					</div>
					<div class="col-sm-4 m-b-xs">
						<form action="{:U('Article/logList')}" method="get">
							<div class="input-group">
								<input type="text" id="input_s" name="keyword" class="input-sm form-control" >
								<span class="input-group-btn">
									<input class="btn btn-sm btn-default" type="submit" value="Go!">
								</span>
							</div>
						</form>
					</div>
				</div>
			</header>
			<section class="scrollable wrapper">
				<section class="panel panel-default">
					<form action="{:U('Article/logList')}" method="post" name="form_log" id="form_log">
						<input type="hidden" name="pid" value="">
						<table class="table table-border table-hover m-b-none">
							<thead>
								<tr>
									<th width="2%"><label class="checkbox m-n i-checks"><input type="checkbox"><i></i></label></th>
									<th width="40%"><b>标题</b></th>
									<th width="6%" class="text-center"><b>查看</b></th>
									<th width="10%" ><b>作者</b></th>
									<th width="15%" ><b>分类</b></th>
									<th width="15%" ><b>时间</b></th>
									<th width="6%" class="text-center"><b>评论</b></th>
									<th width="6%" class="text-center"><b>阅读</b></th>
								</tr>
							</thead>
							<tbody>
							<notempty name="articleList">
								<volist name="articleList" id="vo">
									<tr>
										<td><label class="checkbox m-n i-checks"><input type="checkbox" name="aid[]" value="{$vo.id}" class="ids"><i></i></label></td>
										<td><a href="{:U('Article/editLog')}?aid={$vo.id}">{$vo.title}</a>
										<td class="text-center"><a href="{$vo.id|articleUrl=###}" target="_blank" title="在新窗口查看"><i class="fa fa-desktop text-primary"></i></a></td>
										<td><a href="{:U('Article/logList', array('uid' => $vo['user_id']))}">{$vo.user_id|getAuthorName=###}</a></td>
										<td><a href="{:U('Article/logList', array('cid' => $vo['category']))}">{$vo.category|getCategoryName=###}</a></td>
										<td>{$vo.post_time|date="Y-m-d H:i:s",###}</td>
										<td class="text-center"><a href="{:U('Article/logList', array('aid' => $vo['id']))}">{$vo.comment_num}</a></td>
										<td class="text-center">{$vo.view_num}</a></td>
									</tr>
								</volist>
								<else />
									<tr><td class="text-center" colspan="8">还没有文章</td></tr>
								</notempty>
							</tbody>
						</table>
						<header class="panel-heading form-inline">
							<div class="pull-right">
								<ul class="pagination pagination-sm m-t-sm m-b-none"></ul>
							</div>
							<input name="operate" id="operate" value="" type="hidden" />
							<a href="javascript:void(0);" class="btn btn-default" id="select_all">全选</a>
							<a href="javascript:logact('del');" class="btn btn-default" >删除</a>
								<a href="javascript:logact('hide');" class="btn btn-default">放入草稿箱</a>
								<select name="is_top" id="top" onChange="changeTop(this);" class="form-control">
								<option value="" selected="selected">置顶操作...</option>
								<option value="y">首页置顶</option>
								<option value="n">取消置顶</option>
							</select>
								<select name="category" id="sort" onChange="changeSort(this);" class="form-control">
								<option value="" selected="selected">移动到分类...</option>
								<volist name=":getAllCategory()" id="vo">
									<option value="{$vo.id}">{$vo.name}</option>
								</volist>
							</select>
							</header>
					</form>
				</section>
				<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
			</section>
		</section>
	</aside>
</section>
<div class="modal fade" id="tags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:900px; z-index:1080">
		<div class="modal-content" style="border-radius: 0px; z-index:1080">
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">标签：</h4>
			</div>
			<div class="modal-body">
				<div id="f_tag">
					<volist name=":getAllTag()" id="vo">
						<a href="{:U('Article/logList', array('tag_id' => $vo['id']))}" class="btn btn-default">{$vo.name}</a>
					</volist>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$("#adm_log_list tbody tr:odd").addClass("tralt_b");
	$("#adm_log_list tbody tr")
		.mouseover(function(){$(this).addClass("trover");$(this).find("span").show();})
		.mouseout(function(){$(this).removeClass("trover");$(this).find("span").hide();});
	$("#f_t_tag").click(function(){$("#f_tag").toggle();$("#f_sort").hide();$("#f_user").hide();});
	selectAllToggle();
});
setTimeout(hideActived,2600);
function logact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if(act == 'del' && !confirm('你确定要删除所选文章吗？')){return;}
	$("#operate").val(act);
	$("#form_log").submit();
}
function changeSort(obj) {
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if($('#sort').val() == '')return;
	$("#operate").val('move');
	$("#form_log").submit();
}
function changeAuthor(obj) {
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if($('#author').val() == '')return;
	$("#operate").val('change_author');
	$("#form_log").submit();
}
function changeTop(obj) {
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if($('#top').val() == '')return;
	$("#operate").val('top');
	$("#form_log").submit();
}
$("#menu_log").addClass('active');
</script>
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
</section>
</section>
</section>
</body>
</html>