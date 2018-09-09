<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<li><a href="{:U('System/configure')}">基本设置</a></li>
							<li class="active"><a href="{:U('System/seo')}">SEO设置</a></li>
							<li><a href="{:U('System/blogger')}">个人设置</a></li>
                      </ul>
					</header>
					<div class="panel-body">
						<form class="form-horizontal" action="{:U('System/seo')}" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">文章链接设置：</label>
								<div class="col-sm-10">
									<!-- <div class="radio i-checks">
										<label><input type="radio" name="permalink" value="0"><i></i>默认形式：<span class="badge">{:C('blog_url')}?post=1</span></label>
									</div>
									<div class="radio i-checks">
										<label><input type="radio" name="permalink" value="1"><i></i>文件形式：<span class="badge">{:C('blog_url')}post-1.html</span></label>
									</div>
									<div class="radio i-checks">
										<label><input type="radio" name="permalink" value="2"><i></i>目录形式：<span class="badge">{:C('blog_url')}post/1</span></label>
									</div> -->
									<div class="radio i-checks">
										<label><input type="radio" value="3" checked="checked"><i></i>分类形式：<span class="badge">{:C('blog_url')}/category/1.html</span></label>
									</div>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">博客关键字：</label>
								<div class="col-sm-10">
									<input maxlength="200" class="form-control" value="{:C('blog_keywords')}" name="blog_keywords" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">博客描述：</label>
								<div class="col-sm-10">
									<textarea name="blog_description" class="form-control" cols="" rows="4" >{:C('blog_description')}</textarea>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input name="token" id="token" value="" type="hidden" />
									<input type="submit" value="保存设置" class="btn btn-primary" />
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
$("#menu_setting").addClass('active');
</script>