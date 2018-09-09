<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-comments fa-fw"></i> 回复评论</header>
					<div class="panel-body">
						<form action="{:U('Comment/replyComment')}" method="post">
							<dd class="project-people">
								<a><img alt="image" class="img-circle" src="http://gravatar.duoshuo.com/avatar/{$comment.email}?s=40&d=mm&r=g"></a>
							</dd>
							<div class="row">
								<div class="col-xs-6">
									<h4>{$comment.name}</h4>
									<p>Come From：{$comment.ip}</p>
								</div>
								<div class="col-xs-6 text-right">
									<p class="h4">#{$comment.id}</p>
									<h5>{$comment.post_time|date="Y-m-d H:i:s", ###}</h5>           
								</div>
							</div>
							<strong>{$comment.name}的评论内容：</strong>
							<div class="well m-t">
								<div class="row">
									<div class="col-lg-12">
										<p>{$comment.content}</p>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>回复内容：</label>
								<textarea name="content" rows="5" cols="60" class="form-control"></textarea>
							</div>
							<div class="form-group pull-right">
								<div class="col-lg-12">
									<input type="hidden" value="{$comment.article_id}" name="article_id" />
									<input type="hidden" value="{$comment.id}" name="cid" />
									<input type="hidden" value="{$comment.is_hide}" name="is_hide" />
									<input type="submit" value="回复" class="btn btn-primary" />
									<eq name="comment.is_hide" value="y">
										<input type="submit" value="回复并审核" name="pub_it" class="btn btn-primary" />
									</eq>
									<input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();"/></li>
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
$("#menu_cm").addClass('active');
</script>