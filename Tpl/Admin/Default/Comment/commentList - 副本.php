<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
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
			</section>
			</div>
			<div class="col-lg-12">
				<form action="{:U('Comment/commentList')}" method="post" name="form_com" id="form_com">
					<section class="comment-list block">
						<notempty name="commentList">
							<volist name="commentList" id="vo">
								<article id="comment-id-1" class="comment-item">
									<a href="{$vo.url}" target="_blank" class="pull-left thumb-sm"><img src="http://gravatar.duoshuo.com/avatar/{$vo.email}?s=40&d=mm&r=g" class="img-circle"></a>
									<section class="comment-body m-b">
										<header>
											<a href="{$vo.url}" target="_blank"><strong>{$vo.name}</strong></a>
											<label class="label m-l-xs pull-right">
												<a href="{:U('Comment/deleteComment')}?cid={$vo.id}" class="btn btn-xs btn-danger"><i class="fa fa-close fa-fw"></i> 删除</a>
												<a href="{:U('Comment/editComment')}?cid={$vo.id}" class="btn btn-xs btn-default"><i class="fa fa-edit fa-fw"></i> 编辑</a>
												<a href="{:U('Comment/replyComment')}?cid={$vo.id}" class="btn btn-xs btn-primary"><i class="fa fa-pencil fa-fw"></i> 回复</a>
												<a href="{$vo.article_id|articleUrl=###}#{$vo.id}" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-eye fa-fw"></i> 查看</a>
												<eq name="vo.is_hide" value="y">
													<a href="{:U('Comment/updateComment')}?action=show&cid={$vo.id}" class="btn btn-xs btn-warning"><i class="fa fa-share-square-o fa-fw"></i> 审核</a>
												<else />
													<a href="{:U('Comment/updateComment')}?action=hide&cid={$vo.id}" class="btn btn-xs btn-warning"><i class="fa fa-random fa-fw"></i> 隐藏</a>
												</eq>
											</label>
											<div class="line line-dashed b-b line-lg" style="border-bottom:1px solid #666;margin-bottom:0px;"></div>
											<span class="text-muted text-xs block m-t-xs"><div class="checkbox-inline" style="padding-left:0px;"><a class="checkbox i-checks"><label><input type="checkbox" style="vertical-align:middle;" value="{$vo.id}" name="cid[]" class="ids"/><i></i></label></a></div>{$vo.post_time|date="Y-m-d H:i:s", ###} <small class="text-muted">来自 {$vo.ip}</small></span>
										</header>
										<div class="<eq name="vo.is_hide" value="y">m-t-sm bg-primary panel-body img-rounded <else /> m-t-sm　</eq>">{$vo.content}</div>
									</section>
								</article>
							</volist>
						<else />
							<div class="alert alert-warning">还没有收到评论</div>
						</notempty>
					</section>
					<div class="list_footer" style="margin-top:20px;">
						<div class="pull-right">
							<ul class="pagination pagination-sm m-t-sm m-b-none">{$page}</ul>
						</div>
						<a href="javascript:void(0);" id="select_all" class="btn btn-default">全选</a>
						<a href="javascript:commentact('del');" class="btn btn-default">删除</a>
						<a href="javascript:commentact('hide');" class="btn btn-default">隐藏</a>
						<a href="javascript:commentact('show');" class="btn btn-default">审核</a>
						<input name="operate" id="operate" value="" type="hidden" />
					</div>
				</form>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
<script>
$(document).ready(function(){
	selectAllToggle();
});
setTimeout(hideActived,2600);
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