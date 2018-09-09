<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<style>
/* 翻页 */
.pagination{ margin:8px; font-size:13px; float:right; text-align:center; line-height:24px; }
.pagination > a, .pagination > span{ float:left; margin-left:5px; padding:0 5px; min-width:18px; line-height:26px; text-decoration:none; border:1px solid rgba(65, 65, 65, 0.25); border-radius:3px; box-shadow:inset 0 0 0 1px rgba(255, 255, 255, 1), inset 0 1px rgba(247, 247, 247, 0.4), inset 0 -1px rgba(2, 2, 2, 0.15), 0 1px 1px rgba(0, 0, 0, 0.1); }
.pagination > a{ text-shadow:0 1px rgba(255, 255, 255, 0.2); background-clip:padding-box; background-image:linear-gradient(to bottom, rgba(255, 252, 252, 0), rgba(231, 224, 224, 0.3)); -webkit-transition:0.1s ease-out; -moz-transition:0.1s ease-out; -o-transition:0.1s ease-out; -ms-transition:0.1s ease-out; transition:0.1s ease-out; }
.pagination > a:active, .pagination > .current{ background:rgba(0, 0, 0, 0.06); box-shadow:inset 0 1px rgba(255, 255, 255, 0), inset 0 2px 5px rgba(0, 0, 0, 0.2), 0 1px rgba(255, 255, 255, 0); }
.pagination > a:hover{ background:rgba(0, 0, 0, 0.05); color:#555; }
.pagination > span{ background:rgba(0, 0, 0, 0.05); }
.pagination > .current{ font-weight:bold; }
</style>
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<div class="panel-body">
				<div class="p-xs">
					<div class="pull-left m-r-md">
						<i class="fa fa-comments text-navy mid-icon"></i>
					</div>
					<h2>评论管理 <span class="label">12</span></h2>
					<span>
						<ol class="breadcrumb">
							<li><a href="{:U('Comment/commentList')}">全部</a></li>
							<li><a href="{:U('Comment/commentList')}?hide=y">待审
								<gt name="hideNum" value="0">({$hideNum})</gt></a></li>
							<li><a href="{:U('Comment/commentList')}?hide=n">已审</a></li>
						</ol>
							你可以自由管理您站内的评论。
					</span>
				</div>
			</div>
			<section class="scrollable wrapper">
				<section class="panel panel-default">
					<form action="{:U('Comment/commentList')}" method="post" name="form_com" id="form_com">
						<input type="hidden" name="pid" value="">
						<table class="table table-border table-hover m-b-none">
							<thead>
								<tr>
									<th width="2%"><label class="checkbox m-n i-checks"><input type="checkbox"><i></i></label></th>
									<th class="text-center" width="1%"><b>ID</b></th>
									<th class="text-center" width="7%"><b>上层ID</b></th>
									<th class="text-center" width="15%"><b>昵称</b></th>
									<th width="30%" ><b>评论内容</b></th>
									<th class="text-center" width="5%" ><b>文章</b></th>
									<th class="text-center" width="20%" ><b>时间</b></th>
									<th class="text-center" width="20%" class="text-center"><b>操作</b></th>
								</tr>
							</thead>
							<tbody>
							<notempty name="commentList">
								<volist name="commentList" id="vo">
									<tr id="lh-30">
										<td class="text-center"><label class="checkbox m-n i-checks"><input type="checkbox" name="cid[]" value="{$vo.id}" class="ids"><i></i></label></td>
										<td class="text-center"><a id="{$vo.id}">{$vo.id}</a></td>
										<td class="text-center"><a href="#{$vo.parent_id}"><neq name="vo.parent_id" value="0">{$vo.parent_id}</neq></a></td>
										<td class="text-center"><a>{$vo.name}</a></td>
										<td><a href="{:U('Comment/editComment')}?cid={$vo.id}">{$vo.content}</a></td>
										<td class="text-center"><a href="{$vo.article_id|articleUrl=###}#cmt{$vo.id}" target="_blank">{$vo.article_id}</a></td>
										<td class="text-center"><a>{$vo.post_time|date="Y-m-d H:i:s",###}</a></td>
										<td class="text-center">
											<a href="{:U('Comment/replyComment')}?cid={$vo.id}" class="btn btn-xs btn-primary" title="点击回复此评论"><i class="fa fa-pencil fa-fw"></i> 回复</a>
											<eq name="vo.is_hide" value="y">
												<a href="{:U('Comment/updateComment')}?action=show&cid={$vo.id}" class="btn btn-xs btn-default" title="点击显示此评论"><i class="fa fa-share-square-o fa-fw"></i> 显示</a>
											<else />
												<a href="{:U('Comment/updateComment')}?action=hide&cid={$vo.id}" class="btn btn-xs btn-success" title="点击隐藏此评论"><i class="fa fa-random fa-fw"></i> 隐藏</a>
											</eq>
											<a href="{:U('Comment/deleteComment')}?cid={$vo.id}" class="btn btn-xs btn-danger" title="点击删除此评论"><i class="fa fa-close fa-fw"></i> 删除</a>
										</td>
									</tr>
								</volist>
								<else />
									<tr><td class="text-center" colspan="8">暂时还没有评论</td></tr>
								</notempty>
							</tbody>
						</table>
						<input name="operate" id="operate" value="" type="hidden" /></td>
						<header class="panel-heading form-inline">
							<div class="pagination">
						  		{$page}
						    	<div class="clear"></div>
							</div>
							<a href="javascript:void(0);" class="btn btn-default" id="select_all">全选</a>
							<a href="javascript:commentact('hide');" class="btn btn-default" >隐藏所选评论</a>
							<a href="javascript:commentact('show');" class="btn btn-default" >显示所选评论</a>
							<a href="javascript:commentact('del');" class="btn btn-default">删除所选评论</a>
						</header>
					</form>
				</section>
			</section>
			</section>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
<script>
$(document).ready(function(){
	selectAllToggle();
});
function commentact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的评论');
		return;
	}
	if(act == 'del' && !confirm('你确定要删除所选评论吗？')){return;}
	$("#operate").val(act);
	$("#form_com").submit();
}
$("#menu_cm").addClass('active');
</script>