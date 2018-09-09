<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="i i-link2 icon fa-fw"></i> 友情链接管理</header>
					<div class="panel-body">
						<form action="{:U('Link/updateOrder')}" method="post">
							<table id="adm_link_list" class="table table-hover">
								<thead>
									<tr>
										<th width="5%"><b>序号</b></th>
										<th width="15%"><b>链接</b></th>
										<th width="5%" class="text-center"><b>状态</b></th>
										<th width="5%" class="text-center"><b>查看</b></th>
										<th width="25%"><b>描述</b></th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
								<notempty name="linkList">
									<volist name="linkList" id="vo">
									<tr>
										<td><input class="form-control" name="link[{$vo.id}]" value="{$vo.taxis}" maxlength="4" style="width:40px;"/></td>
										<td><a href="{:U('Link/editLink')}?lid={$vo.id}" title="修改链接">{$vo.name}</a></td>
										<td class="text-center">
											<eq name="vo.is_hide" value="n">
												<a href="{:U('Link/updateStatus')}?action=hide&lid={$vo.id}" title="点击隐藏链接" class="text-primary"><i class="fa fa-toggle-on"></i></a>
											<else />
												<a href="{:U('Link/updateStatus')}?action=show&lid={$vo.id}" title="点击显示链接" class="text-danger"><i class="fa fa-toggle-off"></i></a>
											</eq>
										</td>
										<td class="text-center">
											<a href="{$vo.url}" target="_blank" title="查看链接"><i class="fa fa-desktop"></i></a>
										</td>
										<td>{$vo.description}</td>
										<td>
											<a href="{:U('Link/editLink')}?lid={$vo.id}" class="m-r-sm"><i class="fa fa-edit"></i></a>
											<a href="{:U('Link/deleteLink')}?lid={$vo.id}"><i class="fa fa-recycle"></i></a>
										</td>
									</tr>
									</volist>
								<else />
									<tr><td class="text-center" colspan="6">还没有添加链接</td></tr>
								</notempty>
								</tbody>
							</table>
							<div class="form-group">
								<input type="submit" value="改变排序" class="btn btn-success" />
							</div>
						</form>
					</div>
				</section>
			</div>
			<div class="col-lg-4">
				<section class="panel panel-default">
					<header class="panel-heading font-bold" onclick="displayToggle('link_new', 2);"><i class="fa fa-link fa-fw"></i> 添加链接</header>
					<div class="panel-body" id="link_new">
						<form action="{:U('Link/addLink')}" method="post" name="link" id="link">
							<div class="form-inline form-group">
								<label>序号：</label>
								<input maxlength="4" class="form-control" name="taxis" style="width:50px;"/>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label>名称：</label>
								<input maxlength="200" class="form-control" name="name" />
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label>地址 (带http)：</label>
								<input maxlength="200" class="form-control" name="url" />
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label>描述：</label>
								<textarea name="description" type="text" class="form-control" style="width:100%;height:60px;overflow:auto;"></textarea>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-4">
									<input type="submit" name="" value="添加链接" class="btn btn-primary" />
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