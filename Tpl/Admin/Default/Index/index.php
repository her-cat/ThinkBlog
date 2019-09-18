<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<include file="Public:header" />
<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable wrapper">
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">后台首页</h3>
						<small>Welcome back, {$Think.cookie.name}, <i class="fa fa-map-marker fa-lg text-primary"></i>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="{:U('Index/updateCache')}">更新网站缓存</a></small>
					</div>
				</section>
				<div class="row">
					<div class="col-sm-offset-2 col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-primary lt text-center">
								<a href="{:U('Article/logList')}"><i class="fa fa-file-text fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold"><a href="{:U('Article/logList')}">文章管理</a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-info lt text-center">
								<a href="{:U('Comment/commentList')}"><i class="fa fa-comment fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold"><a href="{:U('Comment/commentList')}">评论管理</a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-success lt text-center">
								<a href="{:U('Tag/tagList')}"><i class="fa fa-user fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold"><a href="{:U('Tag/tagList')}">标签管理</a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-danger lt text-center">
								<a href="{:U('Category/categoryList')}"><i class="i i-add-to-list icon fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold"><a href="{:U('Category/categoryList')}">分类管理</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-signal fa-fw"></i>站点数据统计</header>
							<div class="panel-body list-icon">
								<div class="col-md-3 col-sm-4"><i class="fa fa-file-text"></i>{$sta.articleNum}篇文章</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-thumbs-up"></i>{$sta.topArticleNum}篇文章置顶</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-file-text-o"></i>{$sta.draftNum}篇草稿</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-comments"></i>{$sta.allComm}条评论</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-link"></i>{$sta.linkNum}个友链</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-flag"></i>{$sta.cateNum}个分类</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-tags"></i>{$sta.tagNum}个标签</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-paperclip"></i>{$sta.fileNum}个附件</div>
							</div>
						</section>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-tachometer fa-fw"></i> 系统信息</header>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>当前程序版本</td>
										<td>ThinkBlog 1.0</td>
										<td>数据库表前缀</td>
										<td>{:C('DB_PREFIX')}</td>
									</tr>
									<tr>
										<td>服务器操作系统</td>
										<td><php>echo php_uname('s');</php>
										<td>服务器端口</td>
										<td><php> echo $_SERVER["SERVER_PORT"];</php></td>
									</tr>
									<tr>
										<td>服务器剩余空间</td>
										<td><php> echo intval(diskfreespace(".") / (1024 * 1024))."M";</php></td>
										<td>服务器时间</td>
										<td><php> date_default_timezone_set("Asia/Shanghai");echo date("Y-m-d H:i:s");</php></td>
									</tr>
									<tr>
										<td>WEB服务器版本</td>
										<td><php>echo $_SERVER['SERVER_SOFTWARE'];</php></td>
										<td>服务器语种</td>
										<td><php>echo getenv("HTTP_ACCEPT_LANGUAGE");</php></td>
									</tr>
									<tr>
										<td>PHP版本</td><td>5.4.16</td>
										<td>ZEND版本</td><td><php>echo zend_version();</php></td>
									</tr>
									<tr>
										<td>脚本运行可占最大内存</td>
										<td><php>echo ini_get("memory_limit");</php></td>
										<td>脚本上传文件大小限制</td>
										<td>2M</td>
									</tr>
									<tr>
										<td>POST方法提交限制</td>
										<td><php>echo ini_get("post_max_size");</php></td>
										<td>脚本超时时间</td>
										<td><php>echo ini_get("max_execution_time");</php></td>
									</tr>
								</tbody>
							</table>
						</section>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-info-circle fa-fw"></i> ThinkBlog 开发信息</header>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>版权所有</td>
										<td><a class="btn btn-default" href="https://github.com/her-cat/ThinkBlog" target="_blank"> ThinkBlog</a></td>
									</tr>
									<tr>
										<td>开 发 者</td>
										<td>
											<a class="btn btn-default" href="https://github.com/her-cat/ThinkBlog" target="_blank"><i class="fa fa-at"></i> 何湘辉</a>
										</td>
									</tr>
									<tr>
										<td>帮助</td>
										<td><a class="btn btn-default" href="#" target="_blank">使用说明</a></td>
									</tr>
									<tr>
										<td>相关链接</td>
										<td>
											<a class="btn btn-default" href="https://github.com/her-cat/ThinkBlog/" target="_blank" se_prerender_url="complete">何湘辉博客</a>
											<!-- 放博客文章连接，下同 -->
											<a class="btn btn-default" href="https://github.com/her-cat/ThinkBlog/download" target="_blank">ThinkBlog Down</a>
											<a class="btn btn-default" href="https://github.com/her-cat/ThinkBlog/templates" target="_blank">模板</a>
											<a class="btn btn-default" href="https://github.com/her-cat/ThinkBlog/" target="_blank">讨论区</a></td>
										</tr>
									</tbody>
								</table>
						</section>
					</div>
					<div class="col-lg-6">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-volume-up fa-fw"></i> ThinkBlog 官方消息</header>
							<div class="panel-body" id="admindex_msg">
								<ul></ul>
							</div>
						</section>
					</div>
				</div>
				<div class="footer text-center">欢迎使用 &copy; <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a></div>
			</section>
		</section>
	</section>
</section>
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
</section>
</section>
</section>
</body>
</html>
