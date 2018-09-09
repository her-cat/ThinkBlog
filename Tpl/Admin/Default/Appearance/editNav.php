<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-align-justify fa-fw"></i> 修改导航</header>
					<div class="panel-body">
						<form class="form-horizontal" action="{:U('Appearance/editNav')}" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">导航名称：</label>
								<div class="col-sm-10">
									<input size="20" value="{$nav.name}" name="name" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">导航地址：</label>
								<div class="col-sm-10">
									<input size="50" value="{$nav.url}" name="url" class="form-control"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
									<div class="checkbox i-checks">
										<label>
											<input type="checkbox" style="vertical-align:middle;" value="y" name="new_tab"/><i></i>在新窗口打开
										</label>
									</div>
								</div>
							</div>
							<neq name="nav.parent_id" value="0">
								<div class="form-group">
									<label class="col-sm-2 control-label">父导航：</label>
									<div class="col-sm-10">
										<select name="parent_id" id="pid" class="form-control m-b">
											<option value="0" <eq name="nav.parent_id" value="0"> selected="selected" </eq>>无</option>
											<volist name=":getNavList(0)" id="vo">
												<option value="{$vo.id}" <eq name="vo.id" value="$nav['parent_id']">selected="selected"</eq>>{$vo.name}</option>
											</volist>
										</select>
									</div>
								</div>
							</neq>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input type="hidden" value="{$nav.id}" name="nid" />
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
$("#menu_category_view").addClass('active');
$("#menu_navbar").addClass('active');
</script>