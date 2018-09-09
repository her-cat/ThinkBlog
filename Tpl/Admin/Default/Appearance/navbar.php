<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<li class="active"><a>导航管理</a></li>
						</ul>
					</header>
					<form action="{:U('Appearance/updateOrder')}" method="post">
						<table id="adm_navi_list" class="table table-hover">
							<thead>
								<tr>
									<th width="70"><b>序号</b></th>
									<th width="230"><b>导航</b></th>
									<th width="360"><b>地址</b></th>
									<th width="70" class="text-center">状态</th>
									<th width="70" class="text-center">查看</th>
									<th width="90">操作</th>
								</tr>
							</thead>
							<tbody>
							<notempty name="navList">
								<volist name="navList" id="vo">
									<tr>
										<td><input class="form-control" name="nav[{$vo.id}]" value="{$vo.taxis}" maxlength="4" style="width:40px;"/></td>
										<td><a href="{:U('Appearance/editNav')}?nid={$vo.id}" title="编辑导航">{$vo.name}</a></td>
										<td>{$vo.url}</td>
										<td class="text-center">
											<eq name="vo.is_hide" value="n">
												<a href="{:U('Appearance/updateStatus')}?action=hide&nid={$vo.id}" title="点击隐藏导航" class="text-primary"><i class="fa fa-toggle-on"></i></a>
											<else />
												<a href="{:U('Appearance/updateStatus')}?action=show&nid={$vo.id}" title="点击显示导航" class="text-danger"><i class="fa fa-toggle-off"></i></a>
											</eq>
										</td>
										<td class="text-center"><a href="{$vo.url}" target="_blank"><i class="fa fa-desktop"></i></a></td>
										<td>
											<a href="{:U('Appearance/editNav')}?nid={$vo.id}" title="导航修改"><i class="fa fa-edit"></i></a>
											<eq name="vo.id|getChildrenNum='nav', ###" value="0">
												<a href="{:U('Appearance/deleteNav')}?nid={$vo.id}" title="删除导航"><i class="fa fa-recycle"></i></a>
											</eq>
										</td>
									</tr>
										<volist name="vo.children" id="v">
											<tr>
												<td><input class="form-control" name="nav[{$v.id}]" value="{$v.taxis}" maxlength="4" style="width:40px;"/></td>
												<td>---- <a href="{:U('Appearance/editNav')}?nid={$v.id}" title="编辑导航">{$v.name}</a></td>
												<td>{$v.url}</td>
												<td class="text-center">
													<eq name="v.is_hide" value="n">
														<a href="{:U('Appearance/updateStatus')}?action=hide&nid={$v.id}" title="点击隐藏导航" class="text-primary"><i class="fa fa-toggle-on"></i></a>
													<else />
														<a href="{:U('Appearance/updateStatus')}?action=show&nid={$v.id}" title="点击显示导航" class="text-danger"><i class="fa fa-toggle-off"></i></a>
													</eq>
												</td>
												<td class="text-center"><a href="{$v.url}" target="_blank"><i class="fa fa-desktop"></i></a></td>
												<td>
													<a href="{:U('Appearance/editNav')}?nid={$v.id}" title="导航修改"><i class="fa fa-edit"></i></a>
													<a href="{:U('Appearance/deleteNav')}?nid={$v.id}" title="删除导航"><i class="fa fa-recycle"></i></a>
												</td>
											</tr>
										</volist>
									</volist>
								<else />
									<tr><td class="text-center" colspan="6">还没有添加导航</td></tr>
								</notempty>
								</tbody>
							</table>
							<div class="list_footer"><input type="submit" value="改变排序" class="btn btn-info" /></div>
						</form>
						
				</section>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('navi_add_custom', 2);"><i class="fa fa-"></i>添加自定义导航</header>
							<div class="panel-body" id="navi_add_custom">
								<form class="form-horizontal" action="{:U('Appearance/addNav')}" method="post" name="navi" id="navi">
									<div class="form-group">
										<label class="col-sm-4 control-label">序号：</label>
										<div class="col-sm-8">
											<input maxlength="4" class="form-control" name="taxis" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">导航名称*：</label>
										<div class="col-sm-8">
											<input maxlength="200" class="form-control" name="name" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">地址：</label>
										<div class="col-sm-8">
											<span class="help-block m-b-none">带http*</span>
											<input maxlength="200" class="form-control" name="url" id="url" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">父导航</label>
										<div class="col-sm-8">
											<select name="parent_id" id="pid" class="form-control m-b">
												<option value="0">无</option>
												<volist name="navList" id="vo">
													<option value="{$vo.id}">{$vo.name}</option>
												</volist>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-8">
											<div class="checkbox i-checks">
												<label>
													<input type="checkbox" style="vertical-align:middle;" value="y" name="new_tab" /><i></i>在新窗口打开
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-8">
											<input type="submit" name="" value="添加" class="btn btn-primary" />
										</div>
									</div>
								</form>
							</div>
						</section>
					</div>
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('navi_add_sort', 2);"><i class="fa fa-"></i>添加分类到导航</header>
							<div class="panel-body" id="navi_add_sort">
								<form class="form-horizontal" action="{:U('Appearance/addCategory')}" method="post" name="navi" id="navi">
									<div class="form-group">
									<notempty name="categoryList">
										<volist name="categoryList" id="vo">
											<div class="col-sm-6">
												<div class="checkbox i-checks">
													<label>
														<input type="checkbox" style="vertical-align:middle;" name="cid[]" value="{$vo.id}" /><i></i>{$vo.name}
													</label>
												</div>
											</div>
											<volist name="vo.children" id="v">
												<div class="col-sm-6">
													<div class="checkbox i-checks">
														<label>
															<input type="checkbox" style="vertical-align:middle;" name="cid[]" value="{$v.id}" /><i></i>{$v.name}
														</label>
													</div>
												</div>
											</volist>
										</volist>
									<else />
										<div class="alert alert-danger"><i class="fa fa-exclamation-triangle text-danger fa-fw"></i> 还没有分类，<a href="{:U('Category/categoryList')}">新建分类</a></div>
									</notempty>
									</div>
									<notempty name="categoryList">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="submit" name="" value="添加分类导航" class="btn btn-rounded  btn-block btn-primary" />
											</div>
										</div>
									</notempty>
								</form>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
<script>
$(document).ready(function(){
	$("#adm_navi_list tbody tr:odd").addClass("tralt_b");
	$("#adm_navi_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
$("#menu_category_view").addClass('active');
$("#menu_navbar").addClass('active');
</script>
