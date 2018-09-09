<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-link fa-fw"></i> 编辑链接</header>
					<div class="panel-body">
						<form class="form-horizontal" action="{:U('Link/editLink')}" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">名称：</label>
								<div class="col-sm-10">
									<input size="40" value="{$link.name}" class="form-control" name="name" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">地址：</label>
								<div class="col-sm-10">
									<input size="40" value="{$link.url}" class="form-control" name="url" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">链接描述：</label>
								<div class="col-sm-10">
									<textarea name="description" rows="3" class="form-control" cols="42">{$link.description}</textarea>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input type="hidden" value="{$link.id}" name="lid" />
									<input type="submit" value="保 存" class="btn btn-success" />
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
$("#menu_link").addClass('active');
</script>