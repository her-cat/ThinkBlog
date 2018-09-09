<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-comments fa-fw"></i> 编辑评论</header>
					<div class="panel-body">
						<form class="bs-example form-horizontal" action="{:U('Comment/editComment')}" method="post">
							<div class="form-group">
								<label class="col-lg-2 control-label">评论人：</label>
								<div class="col-lg-10">
									<input type="text" value="{$comment.name}" name="name" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">电子邮件：</label>
								<div class="col-lg-10">
									<input type="text"  value="{$comment.email}" name="email" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">主页：</label>
								<div class="col-lg-10">
									<input type="text"  value="{$comment.url}" name="url" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">评论内容：</label>
								<div class="col-lg-10">
									<textarea name="content" rows="8" cols="60" class="form-control">{$comment.content}</textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<input type="hidden" value="{$comment.id}" name="cid" />
									<input type="submit" value="保 存" class="btn btn-primary" />
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
$("#menu_cm").addClass('active');
</script>