<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<?php if(isset($_GET['activated'])):?><div class="alert alert-info actived">设置保存成功</div><?php endif;?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<li class="active"><a href="{:U('System/configure')}">基本设置</a></li>
							<li><a href="{:U('System/seo')}">SEO设置</a></li>
							<li><a href="{:U('System/blogger')}">个人设置</a></li>
                      </ul>
					</header>
					<div class="panel-body">
						<form class="form-horizontal" action="{:U('System/configure')}" method="post" name="input" id="input">
							<div class="form-group">
								<label class="col-sm-2 control-label">站点标题：</label>
								<div class="col-sm-10">
									<input maxlength="200" class="form-control" value="{$config.blog_name}" name="blog_name" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">站点副标题：</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="blog_info" cols="" rows="3">{$config.blog_info}</textarea>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">站点地址：</label>
								<div class="col-sm-10">
									<input maxlength="200" class="form-control" value="{$config.blog_url}" name="blog_url" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-inline form-group">
								<label class="col-sm-2 control-label">每页显示：</label>
								<div class="col-sm-10">
									<input maxlength="5" size="4" class="form-control" value="{$config.index_article_num}" name="index_article_num" /> 篇文章
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">自动摘要</label>
								<div class="col-sm-10">
									<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="is_excerpt" id="isexcerpt" {$config.is_excerpt}><span></span></label>
								</div>
							</div>
							<div class="form-inline form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
									截取文章的前 <input type="text" class="form-control" name="excerpt_num" maxlength="3" value="{$config.excerpt_num}" style="width:50px;"/> 个字作为摘要
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-inline form-group">
								<label class="col-sm-2 control-label">RSS：</label>
								<div class="col-sm-10">
									输出 <input maxlength="5" size="4" value="{$config.rss_output_num}" class="form-control" name="rss_output_num" /> 篇文章（0为关闭），且输出
									<select name="rss_output_full_text" class="form-control m-b" style="margin-bottom: 0px;">
										<option value="y"<eq name="config.rss_output_full_text" value="y">selected="selected"</eq>>全文</option>
										<option value="n" <eq name="config.rss_output_full_text" value="n">selected="selected"</eq>>摘要</option>
									</select>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-inline form-group">
								<label class="col-sm-2 control-label">评论：</label>
								<div class="col-sm-10">
									<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="is_comment" id="iscomment" {$config.is_comment}><span></span></label><br/>发表评论间隔 <input maxlength="5" size="2" class="form-control" value="{$config.comment_interval}" name="comment_interval" /> 秒
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">评论审核：</label>
								<div class="col-sm-10">
									<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="is_check_comment" id="ischkcomment" {$config.is_check_comment}><span></span></label>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">评论验证码：</label>
								<div class="col-sm-10">
									<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="comment_code" id="comment_code" {$config.comment_code}><span></span></label>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">评论人头像：</label>
								<div class="col-sm-10">
									<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="is_gravatar" id="isgravatar" {$config.is_gravatar}><span></span></label>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-inline form-group">
								<label class="col-sm-2 control-label">评论分页：</label>
								<div class="col-sm-10">
									每页显示 <input maxlength="5" size="4" class="form-control" value="{$config.index_comment_num}" name="index_comment_num" /> 条评论，<select name="comment_order" class="form-control m-b" style="margin-bottom: 0px;"><option value="new" <eq name="config.comment_order" value="new">selected="selected"</eq>>较新的</option><option value="old" <eq name="config.comment_order" value="old">selected="selected"</eq>>较旧的</option></select> 排在前面
								</div>
							</div>
							<!-- <div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-inline form-group">
								<label class="col-sm-2 control-label">附件：</label>
								<div class="col-sm-10">
									附件上传最大限制 <input maxlength="10" size="8" class="form-control" value="" name="att_maxsize" />KB（上传文件还受到服务器空间PHP配置最大上传 <?php echo ini_get('upload_max_filesize'); ?> 限制）<br/>
									允许上传的附件类型 <input maxlength="200" class="form-control" value="" name="att_type" />（多个用半角逗号分隔）<br />
									
								</div>
							</div> -->
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-inline form-group">
								<label class="col-sm-2 control-label">上传图片生成缩略图：</label>
								<div class="col-sm-10">
									<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="is_thumb" id="isthumbnail" {$config.is_thumb}><span></span></label>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">ICP备案号：</label>
								<div class="col-sm-10">
									<input maxlength="200" class="form-control" value="{$config.icp}" name="icp" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">首页底部信息：</label>
								<div class="col-sm-10">
									<span class="help-block m-b-none">支持html，可用于添加流量统计代码</span>
									<textarea name="footer_info" cols="" rows="6" class="form-control">{$config.footer_info}</textarea>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
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