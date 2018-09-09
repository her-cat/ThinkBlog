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
							<li><a href="{:U('System/seo')}">SEO设置</a></li>
							<li class="active"><a href="{:U('System/blogger')}">个人设置</a></li>
                      </ul>
					</header>
					<div class="panel-body">
						<form class="form-horizontal" action="{:U('System/blogger')}" method="post" name="blooger" id="blooger" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-4">
									<section class="panel no-border">
										<div class="panel-body">
											<div class="row m-t-xl">
												<div class="col-xs-12 text-center">
													<div class="inline"><div class="easypiechart" data-percent="75" data-line-width="6" data-bar-color="#fff" data-track-Color="#2796de" data-scale-Color="false" data-size="140" data-line-cap="butt" data-animate="1000"><div class="thumb-lg avatar"><img src="__UPLOAD__/{$user.head}" class="dker"></div></div><div class="h4 m-t m-b-xs font-bold text-lt"></div></div>
												</div>
											</div>
											<div class="wrapper m-t-xl m-b">
												<div class="row m-b">
													<div class="col-xs-12 text-center">
														<input name="photo" type="file" />
														<div class="text-lt font-bold"> (支持JPG、PNG格式图片)</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-lg-8">
									<div class="form-group">
										<label class="col-sm-2 control-label">昵称：</label>
										<div class="col-sm-10">
											<input maxlength="50" class="form-control" value="{$user.nickname}" name="nickname" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">邮箱：</label>
										<div class="col-sm-10">
											<input name="email" class="form-control" value="{$user.email}" maxlength="200" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">登陆名：</label>
										<div class="col-sm-10">
											<input maxlength="200" class="form-control" value="{$user.name}" name="name" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">新密码（不小于6位，不修改请留空）：</label>
										<div class="col-sm-10">
											<input type="password" maxlength="200" class="form-control" value="" name="newpwd" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">再输入一次新密码：</label>
										<div class="col-sm-10">
											<input type="password" maxlength="200" class="form-control" value="" name="repwd" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-2">
											<input type="submit" value="保存设置" class="btn btn-primary" />
										</div>
									</div>
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