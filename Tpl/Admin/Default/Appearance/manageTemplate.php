<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox" id="container" style="display:block">
	<section class="scrollable wrapper">
	<?php if(isset($_GET['activated'])):?><div class="alert alert-info actived">模板更换成功</div><?php endif;?>
	<?php if(isset($_GET['activate_install'])):?><div class="alert alert-info actived">模板上传成功</div><?php endif;?>
	<?php if(isset($_GET['activate_del'])):?><div class="alert alert-info actived">删除模板成功</div><?php endif;?>
	<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">删除失败，请检查模板文件权限</div><?php endif;?>
		<div class="row containertitle2">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<li class="active"><a href="{:U('Appearance/manageTemplate')}">模板管理</a></li>
							<li><a href="{:U('Appearance/installTemplate')}">安装模板</a></li>
						</ul>
					</header>
				</section>
			</div>
		</div>
		<div class="tpl_list adm_tpl_list">
			<div class="row">
				<?php foreach($tpls as $key=>$value):?>
				<div class="col-sm-6 col-md-4 tpls">
					<section class="panel b-a">
						<div class="theme-screenshot">
							<a data-toggle="modal" data-target="#<?php echo $value['tplfile']; ?>">
								<img src="<?php echo TPLS_URL.$value['tplfile']; ?>/preview.jpg">
							</a>
						</div>
						<a data-toggle="modal" data-target="#<?php echo $value['tplfile']; ?>" ><span class="more-details" id="bluebox-action">主题详情</span></a>
						<div class="panel-heading no-border <?php if($nonce_templet == $value['tplfile']){echo "bg-info";}else{echo 'bg-default';} ?> lt">
							<div class="pull-right theme-actions">
								<span><a href="javascript:em_confirm('<?php echo $value['tplfile']; ?>', 'tpl', '<?php echo LoginAuth::genToken(); ?>');" class="btn btn-danger btn-sm dropdown-toggle">删除</a></span>
							</div>
							<a href="template.php?action=usetpl&tpl=<?php echo $value['tplfile']; ?>&side=<?php echo $value['sidebar']; ?>&token=<?php echo LoginAuth::genToken(); ?>" class="h4 text-lt m-t-sm m-b-sm block font-bold"><?php echo $value['tplname']; ?></a>
						</div>
					</section>
				</div>
				<?php endforeach;?>
				<div class="col-sm-6 col-md-4 tpls">
					<section class="panel b-a add">
						<div class="panel-heading"><a href="{:U('Appearance/installTemplate')}"><i class="fa fa-plus-circle" style="font-size:10em;"></i></a></div>
					</section>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 container3"></div>
			<div class="col-lg-12 container2"></div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
	</section>
</section>
<?php foreach($tpls as $key=>$value):?>
<div class="modal fade" id="<?php echo $value['tplfile']; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;filter:alpha(opacity=100);">
	<div class="modal-dialog" style="width:900px;margin-top:60px;z-index:1080">
		<div class="modal-content" style="border-radius:0px;z-index:1080">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo $value['tplname']; ?></h4>
			</div>
			<div class="modal-body" style="max-height:400px;min-height:270px;overflow:auto;">
				<div class="row theme_ntpls">
					<div class="col-md-5 theme-preview">
						<div class="screenshot"><img src="<?php echo TPLS_URL.$value['tplfile']; ?>/preview.jpg" alt=""></div>
					</div>
					<div class="col-md-7 theme-info">
						<h3 class="theme-name"><?php echo $value['tplname']; ?><span class="theme-version">版本：<?php echo $value['Version']; ?></span></h3>
						<h4 class="theme-author"><?php echo $value['Author']; ?></h4>
						<p class="theme-description"><?php echo $value['Des']; ?></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a class="btn btn-info" href="template.php?action=usetpl&tpl=<?php echo $value['tplfile']; ?>&side=<?php echo $value['sidebar']; ?>&token=<?php echo LoginAuth::genToken(); ?>">启用</a>
				<a class="btn btn-danger" href="javascript: em_confirm('<?php echo $value['tplfile']; ?>', 'tpl', '<?php echo LoginAuth::genToken(); ?>')" >删除</a>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
<script>
$("#menu_category_view").addClass('active');
$("#menu_tpl").addClass("active");
</script>