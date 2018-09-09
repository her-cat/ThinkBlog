<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-tags fa-fw"></i> 标签修改</header>
					<div class="panel-body">
						<form class="form-horizontal" method="post" action="{:U('Tag/editTag')}">
							<div class="form-group">
								<label class="col-sm-2 control-label">标签内容：</label>
								<div class="col-sm-10">
									<input size="40" value="{$tag.name}" name="name" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input type="hidden" value="{$tag.id}" name="tid" />
									<input type="submit" value="保 存" class="btn btn-primary" />
									<input type="button" value="取 消" class="btn btn-defaul" onclick="javascript: window.location='{:U('Tag/tagList')}';"/>
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
$("#menu_tag").addClass('active');
</script>