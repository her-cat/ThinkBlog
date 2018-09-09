<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<div class="content-wrap">
	<div class="content">
		<div class="pagetitle">
			<h2>
				<switch name="params.name" >
					<case value="category">分类：{$params.value}</case>
					<case value="tag">标签：{$params.value}</case>
					<case value="keyword">关键词：{$params.value}</case>
					<case value="author">作者：{$params.value}</case>
					<default />文章列表
				</switch>
			</h2>
		</div>
    	<notempty name="articleList">
	    	<volist name="articleList" id="vo">
		    	<article class="excerpt">
		    		<a class="focus" href="{$vo.id|articleUrl=###}">
						<img src="{$vo.id|getArticleOneImg=###}" class="thumb" style="display: inline;">  
					</a>
					<header>
						<a class="cat" href="{$vo.category|categoryUrl=###}">{$vo.category|getCategoryName=###}</a>  
						<h2><a href="{$vo.id|articleUrl=###}" title="{$vo.title}">{$vo.title}</a></h2>
					</header>
					<p class="meta">
		        		<time><i class="icon-calendar"></i> {$vo.post_time|date="Y-m-d H:i:s", ###}</time><span class="pv"><i class="icon-eye-open"></i> 阅读 ({$vo.view_num})</span><i class="icon-comment"></i> <a class="pc" href="{$vo.id|articleUrl=###}">评论 ({$vo.comment_num})</a>
					</p>
					<p class="note">{$vo.excerpt}...</p>
				</article>
	    	</volist>
	    <else/>
	    	<header class="article-header">
				<h1 class="article-title">sorry！没有找到 
		    	<switch name="params.name" >
					<case value="category">分类：{$params.value}</case>
					<case value="tag">标签：{$params.value}</case>
					<case value="keyword">关键词：{$params.value}</case>
					<case value="author">作者：{$params.value}</case>
					<default />文章列表
				</switch>
				的文章</h1>
			</header>
    	</notempty>
        <div class="pagination">
			<div class="pagenav">
			{$page}
			</div>
		</div>
	</div>
</div>