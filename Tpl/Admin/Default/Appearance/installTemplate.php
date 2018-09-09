<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<div class="row containertitle2" style="margin-top:20px;">
	<div class="col-lg-12">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">
				<ul class="nav nav-tabs">
					<li><a href="{:U('Appearance/manageTemplate')}">模板管理</a></li>
					<li class="active"><a href="{:U('Appearance/installTemplate')}">安装模板</a></li>
				</ul>
			</header>
		</section>
	</div>
</div>
<?php if(isset($_GET['error_a'])):?><span class="error">只支持zip压缩格式的模板包</span><?php endif;?>
<?php if(isset($_GET['error_b'])):?><span class="error">上传失败，模板目录(content/templates)不可写</span><?php endif;?>
<?php if(isset($_GET['error_c'])):?><span class="error">空间不支持zip模块，请按照提示手动安装模板</span><?php endif;?>
<?php if(isset($_GET['error_d'])):?><span class="error">请选择一个zip模板安装包</span><?php endif;?>
<?php if(isset($_GET['error_e'])):?><span class="error">安装失败，模板安装包不符合标准</span><?php endif;?>
<?php if(isset($_GET['error_c'])): ?>
<div style="margin:20px 20px;">
<div class="des">
手动安装模板： <br />
1、把解压后的模板文件夹上传到 content/templates目录下。 <br />
2、登录后台换模板，模板库中已经有了你刚才添加的模板，点击使用即可。 <br />
</div>
</div>
<?php endif; ?>
<form action="{:U('Appearance/uploadTemplate')}" method="post" enctype="multipart/form-data" >
<div style="margin:50px 0px 50px 20px;">
	<li>
	<input name="tplzip" type="file" />
	<input type="submit" value="上传安装" class="submit" /> (上传一个zip压缩格式的模板安装包)
	</li>
</div>
</form>
<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
<script>
$("#menu_category_view").addClass('active');
$("#menu_tpl").addClass("active");
</script>