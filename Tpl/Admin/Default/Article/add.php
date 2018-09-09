<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<form action="{:U('Article/add')}" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
		<input type="hidden" id="aid" name="aid" value="-1">
		<div class="row">
			<div class="col-lg-9">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-edit fa-fw"></i> 文章内容<span id="msg_2" class="badge bg-primary"></span><span id="msg" class="badge bg-primary"></span>
						<ul class="nav nav-pills pull-right">
							<li>
								<a href="#" class="panel-toggle text-muted">
									<i class="i i-plus text-active"></i>
									<i class="i i-minus text"></i>
								</a>
							</li>
						</ul>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<input type="text" maxlength="200" name="title" id="title" class="form-control" placeholder="输入文章标题">
						</div>
						<div class="form-grou">
							<textarea id="container" name="content" style="overflow:scroll;width:100%;height:300px;max-height:800px" type="text/plain"></textarea>
						</div>
					</div>
				</section>
			</div>
			<div class="col-lg-3">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-cog fa-fw"></i> 文章设置项
						<ul class="nav nav-pills pull-right">
							<li>
								<a href="#" class="panel-toggle text-muted">
									<i class="i i-plus text-active"></i>
									<i class="i i-minus text"></i>
								</a>
							</li>
						</ul>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<select name="category" id="category" class="form-control m-b">
								<volist name=":getAllCategory()" id="vo">
									<option value="{$vo.id}">{$vo.name}</option>
								</volist>
							</select>
						</div>
						<div class="form-group">
							<label><strong>标签：</strong></label>
							<input name="tag" id="tag" class="form-control" maxlength="200" placeholder="文章标签，逗号或空格分隔，过多的标签会影响系统运行效率" />
						</div>
						<div class="form-group">
							<label>发布于：</label>
							<input maxlength="200" name="post_time" id="post_time" class="form-control" value="<php>echo date("Y-m-d H:i:s")</php>"/>
						</div>
						<div class="form-group">
							<label class="checkbox-inline checkbox m-n i-checks"><input type="checkbox" value="y" name="is_top" id="is_top" class="ids"><i></i>置顶</label>
							<label class="checkbox-inline checkbox m-n i-checks"><input type="checkbox" value="y" name="open_comment" id="open_comment" checked="checked" class="ids"><i></i>允许评论</label>
						</div>
						<div class="text-center">
							<input name="token" id="token" value="{$Think.session.form_token}" type="hidden" />
							<input type="submit" value="发布文章" onclick="return checkform();" class="btn btn-primary" />
							<input type="hidden" name="author" id="author" value="{$Think.cookie.uid}" />
							<input type="button" name="savedf" id="savedf" value="保存草稿" onclick="saveArticle();" class="btn btn-success" />
						</div>
					</div>
				</section>
			</div>
		</div>
		</form>
		<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
    <js href="__PUBLIC__/Ueditor/ueditor.config.js" />    
    <js href="__PUBLIC__/Ueditor/ueditor.all.min.js" />
    <script>
    var ue = null;
    $(function(){
    	var aid = $("#aid").val();
        ue = UE.getEditor('container',{
            serverUrl :"{:U('Admin/Article/ueditor')}?aid=" + aid
        });
    })
	$("#menu_wt").addClass('active');
	setInterval("saveArticle('{:U('Article/add')}')", 60000);
</script>
<script>
$("#menu_category_sys").addClass('current');
$("#menu_setting").addClass('current');
</script>

