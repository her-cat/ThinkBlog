<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-title" content="ThinkBlog">
	<meta http-equiv="Cache-Control" content="no-siteapp">
	<title>{$article.title}-{:C('blog_name')}</title>
	<meta name="keywords" content="{$article.id|getTagStr=###}">
	<meta name="description" content="{$article.excerpt}">
	<meta name="generator" content="ThinkBlog">
	<!-- 引用CSS文件 -->
	<include file="Public:cssFile" />
</head>
<body class="single single-post single-format-standard comment-open">
<!-- 引用header -->
<include file="Public:header" />
<!-- 文章正文 -->
<section class="container">
	<div class="content-wrap">
	<div class="content" style="background-color:#FFF">
    <header class="article-header">
		<h1 class="article-title"><a href="{$article.id|articleUrl=###}">{$article.title}</a></h1>
		<div class="article-meta">
			<span class="item">
		        <i class="icon-user"></i> <a href="{$article.user_id|authorUrl=###}" class="upp">{$article.user_id|getAuthorName=###}</a></span>
	        <span class="item">
				<i class="icon-time"></i> {$article.post_time|date="Y-m-d", ###}</span>
	        <span class="item">
				<i class="icon-th-list"></i> <a class="cat" href="{$article.category|CategoryUrl=###}">{$article.category|getCategoryName=###}</a></span>
	    	<span class="item post-views" id="views">
	        	<i class="icon-eye-open"></i> 阅读({$article.view_num})</span>
	        <span class="item" id="ping">
	        	<i class="icon-comment"></i> 评论({$article.comment_num})</span>
		</div>
	</header>
<article class="article-content">
	<p>{$article.content|htmlspecialchars_decode=###}</p>
	<p class="post-copyright">转载请注明出处 <a href="{:C('blog_url')}">{:C('blog_name')}</a> » <a href="{$article.id|articleUrl=###}">{$article.title}</a></p>
</article>
<div class="article-tags">
	标签：
	<volist	name=":getArticleTag($article['id'])" id="vo">
		<a href="{$vo.name|tagUrl=###}" class="tag" rel="tag">{$vo.name}</a>
	</volist>
</div>
<nav class="article-nav">
	<span class="article-nav-prev">
	    <a>【上一篇】</a><br>{$article.post_time|getPrevArticle=###}
	</span>
	<span class="article-nav-next">
	    <a>【下一篇】</a><br>{$article.post_time|getNextArticle=###}
	</span>
</nav>
<eq name="article.open_comment" value="y">
<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="commenttitle" style="margin-bottom: 15px;">
			<div class="title">
				<h3>评论<a onclick="show_div()"><small>-帐号管理</small></a></h3>
			</div>
		</div>
		<form action="{:C('blog_url')}/action/addComment" method="post" id="commentform">
			<input type="hidden" name="aid" value="{$article.id}" />
			<div class="comt">
				<div class="comt-title">
					<img data-src="{$Think.cookie.visitor_email|getGravatar=###}" src="__TPL__/Public/Images/avatar-default.png"class="avatar avatar-50 photo avatar-default" height="50" width="50">
					<a id="cancel-reply" href"javascript:void(0);" onclick="cancelReply()" style="display:none">取消</a>
				</div>
				<div class="comt-box">
					<textarea placeholder="你的评论可以一针见血" class="input-block-level comt-area" name="content" id="comment" cols="100%" rows="3" tabindex="1" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
					<div class="comt-ctrl">
						<button type="submit" name="submit" id="submit" tabindex="5">提交评论</button>
	                    <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
					</div>
				</div>

				
					<div class="comt-comterinfo" id="comment-author-info" style="display:<if condition="getVisitor('nickname') eq '' ">block<else/>none</if>">
						<ul>
							<li class="form-inline">
								<label class="hide" for="author">昵称</label><input class="ipt" type="text" name="nickname" id="author" value="{:getVisitor('nickname')}" tabindex="2" placeholder="昵称"><span class="text-muted">昵称 (必填)</span></li>
							<li class="form-inline">
								<label class="hide" for="email">邮箱</label><input class="ipt" type="text" name="email" id="email" value="{:getVisitor('email')}" tabindex="3" placeholder="邮箱"><span class="text-muted">邮箱 (必填)</span></li>
							<li class="form-inline">
								<label class="hide" for="url">网址</label><input class="ipt" type="text" name="url" id="url" value="{:getVisitor('url')}" tabindex="4" placeholder="网址"><span class="text-muted">网址</span></li>
						</ul>
					</div>
			</div>
		</form>
	</div>
</div>
<div id="liststitle">
	<a name="comments"></a>
    <div class="title"><h3>网友评论<b>({$article.comment_num})</b></h3></div>
</div>
<ol class="commentlist">
	<volist name=":getCommentList($article['id'])" id="vo">
		<li class="comment even thread-even depth-1" id="{$vo.id}">
			<a name="{$vo.id}"></a>
			<span class="comt-f">
				<switch name="vo.i" >
					<case value="1">沙发#</case>
					<case value="2">椅子#</case>
					<case value="3">板凳#</case>
					<case value="4">地板#</case>
					<default />#{$vo.i}
				</switch>
			</span>
			<div class="comt-avatar">
        		<img class="avatar avatar-50 photo" height="50" width="50" style="display: block;" src="__TPL__/Public/Images/avatar-default.png" alt="avatar" data-src="{$Think.cookie.visitor_email|getGravatar=###}">
        	</div>
        	<div class="comt-main" id="div-comment-{$vo.id}">
        		<p><a href="{$vo.url}" target="_blank" class="ds-user-name ds-highlight" rel="nofollow"><eq name="vo.parent_id" value="0"></a><else />@{$vo.parent_id|getReplyName=###}</a>，</eq>{$vo.content}</p>
				<div class="comt-meta">
        			<span class="comt-author">
        			<notempty name="vo.url">
        				<a href="{$vo.url}" target="_blank" class="ds-user-name ds-highlight" rel="nofollow">{$vo.name}</a>
        			<else />
						{$vo.name}
        			</notempty>
        			<a title="{$vo.ip}"> 
        			<img src="__TPL__/Public/Images/ip.png" alt="" width="16" height="16"></a></span>
					{$vo.post_time|date="Y-m-d H:i:s", ###}
        			<a class="comment-reply-link" href="#comment-{$vo.id}" onclick="commentReply({$vo.id}, this)" >回复</a>
        		</div>
        	</div>
		</li>
	</volist>
</ol>
</eq>
</div>
</div>
<script type="text/javascript" language="javascript">
	function show_div(){
		var obj_div = document.getElementById("comment-author-info");
		obj_div.style.display = (obj_div.style.display == 'none') ? 'block' : 'none';
	}
</script>
<!-- 引入侧边栏 -->
<include file="Public:side" />
</section>
<!-- 引入底部 -->
<include file="Public:footer" />