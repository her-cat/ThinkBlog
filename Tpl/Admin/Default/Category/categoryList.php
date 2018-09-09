<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-4">
				<section>
					<header class="panel-heading font-bold">分类管理</header>
					<div class="panel-body">
						<form class="form-horizontal" action="{:U('Category/addCategory')}" method="post">
							<div class="form-group">
								<label class="col-sm-4 control-label">序号：</label>
								<div class="col-sm-8">
									<input maxlength="4" class="form-control" name="taxis" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">名称*：</label>
								<div class="col-sm-8">
									<input maxlength="200" class="form-control" name="name" id="sortname" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">别名*：</label>
								<div class="col-sm-8">
									<input maxlength="200" class="form-control" name="alias" id="alias" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">父分类：</label>
								<div class="col-sm-8">
									<select name="parent_id" id="pid" class="form-control m-b">
										<option value="0">无</option>
										<volist name="categoryList" id="vo">
											<option value="{$vo.id}">{$vo.name}</option>
										</volist>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<input type="submit" id="addsort" value="添加新分类" class="btn btn-primary"/>
									<span id="alias_msg_hook"></span>
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">分类列表</header>
					<form  method="post" action="{:U('Category/updateOrder')}">
						<table id="adm_sort_list" class="table table-hover">
							<thead>
								<tr>
									<th width="10%"><b>序号</b></th>
									<th width="20%"><b>名称</b></th>
									<th width="10%"><b>别名</b></th>
									<th width="10%" class="text-center"><b>查看</b></th>
									<th width="10%" class="text-center"><b>文章</b></th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody>
							<notempty name="categoryList">
								<volist name="categoryList" id="vo">
								<tr>
									<td>
										<input type="hidden" value="{$vo.id}" class="sort_id" />
										<input maxlength="4" class="form-control" name="sort[{$vo.id}]" value="{$vo.taxis}" style="width:45px;"/>
									</td>
									<td><a href="{:U('Category/editCategory')}?cid={$vo.id}">{$vo.name}</a></td>
									<td>{$vo.alias}</td>
									<td class="text-center"><a href="{:U('Home/Category/' . $vo['name'])}" target="_blank"><i class="fa fa-desktop"></i></a></td>
									<td class="text-center">{$vo.logNum}</td>
									<td>
										<a href="{:U('Category/editCategory')}?cid={$vo.id}"><i class="fa fa-edit"></i></a>
										<a href="{:U('Category/deleteCategory')}?cid={$vo.id}"><i class="fa fa-recycle"></i></a>
									</td>
								</tr>
								<volist name="vo.children" id="vo">
									<tr>
										<td>
										<input type="hidden" value="{$vo.id}" class="sort_id" />
										<input maxlength="4" class="form-control" name="sort[{$vo.id}]" value="{$vo.taxis}" style="width:45px;"/>
									</td>
									<td>---- <a href="{:U('Category/editCategory')}?cid={$vo.id}">{$vo.name}</a></td>
									<td>{$vo.alias}</td>
									<td class="text-center"><a href="{:U('Home/Category/' . $vo['name'])}" target="_blank"><i class="fa fa-desktop"></i></a></td>
									<td class="text-center">{$vo.logNum}</td>
									<td>
										<a href="{:U('Category/editCategory')}?cid={$vo.id}"><i class="fa fa-edit"></i></a>
										<a href="{:U('Category/deleteCategory')}?cid={$vo.id}"><i class="fa fa-recycle"></i></a>
									</td>
									</tr>
								</volist>
							</volist>
							<else />
								<tr><td class="text-center" colspan="8">还没有添加分类</td></tr>
							</notempty>
							</tbody>
						</table>
					<div class="list_footer"><input type="submit" value="改变排序" class="btn btn-info" /></div>
					</form>
				</section>
			</div>
		</div>
	<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
<script>
$("#alias").keyup(function(){checksortalias();});
function issortalias(a){
	var reg1=/^[\w-]*$/;
	var reg2=/^[\d]+$/;
	if(!reg1.test(a)) {
		return 1;
	}else if(reg2.test(a)){
		return 2;
	}else if(a=='post' || a=='record' || a=='sort' || a=='tag' || a=='author' || a=='page'){
		return 3;
	} else {
		return 0;
	}
}
function checksortalias(){
	var a = $.trim($("#alias").val());
	if (1 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名应由字母、数字、下划线、短横线组成</span>');
	}else if (2 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名不能为纯数字</span>');
	}else if (3 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名与系统链接冲突</span>');
	}else {
		$("#alias_msg_hook").html('');
		$("#msg").html('');
		$("#addsort").attr("disabled", false);
	}
}
$(document).ready(function(){
	$("#adm_sort_list tbody tr:odd").addClass("tralt_b");
	$("#adm_sort_list tbody tr")
	.mouseover(function(){$(this).addClass("trover")})
	.mouseout(function(){$(this).removeClass("trover")});
	$("#menu_sort").addClass('active');
});
</script>
