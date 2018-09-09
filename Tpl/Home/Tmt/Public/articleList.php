<?php if(!defined('APP_PATH')) {exit('error!');} ?><div id="content-list">
 	<volist name="articleList" id="vo">
		<div class="post-{$vo.id} post category-{$vo.category|getCategoryName=###}" id="post-{$vo.id}">
			<div class="post-list">
	        	<eq name="vo.is_top" value="y"><span class="post-sticky"></span></eq>
		        <div class="post-header">
					<h2 class="post-title"><a href="{$vo.id|articleUrl=###}" title="{$vo.title}" rel="bookmark">{$vo.title}</a></h2>
		        </div>
				<div class="post-meta">
			        <span class="pauthor">
			        	<i class="icon-user-add"></i>
			            <a href="{$vo.user_id|authorUrl=###}" title="由{$vo.user_id|getAuthorName=###}发布" rel="author">{$vo.user_id|getAuthorName=###}</a></span>
			        <span class="ptime">
			            <i class="icon-calendar"></i>{$vo.post_time|date="Y-m-d", ###}</span>
			        <span class="pcate">
			        	<i class="icon-category"></i>
			            <a href="{$vo.category|categoryUrl=###}" title="查看{$vo.category|getCategoryName=###}中的全部文章" rel="category tag">{$vo.category|getCategoryName=###}</a></span>
			        <span class="pview">
			            <i class="icon-pass"></i>{$vo.view_num}人路过</span>
			        <span class="pcomm">
			            <i class="icon-chat"></i>
			            <a href="{$vo.id|articleUrl=###}#comments" rel="nofollow" title="{$vo.title}上的评论">{$vo.comment_num}条评论</a></span>
	        	</div>
		        <div class="post-body">
			        <div class="post-thumbnail">
			            <a href="{$vo.id|articleUrl=###}" rel="bookmark" title="{$vo.title}">
			            	<img src="{$vo.id|getArticleOneImg=###}" width="140" height="100" alt="{$vo.title}" />
			            </a>
			        </div>
			        <div class="post-excerpt">{$vo.excerpt}...</div>
		        </div>
		        <div class="post-footer">
			        <div class="tags">
			            <i class="icon-tags">
			            	<volist name=":getArticleTag($vo['id'])" id="v">
			                	<a href="{$v.name|tagUrl=###}" class="tag-link" title="查看标签为《{$v.name}》的所有文章">{$v.name}</a>
			                </volist>
			            </i>
			        </div>
		          	<div class="readmore">
		            	<a href="{$vo.id|articleUrl=###}" rel="bookmark">阅读全文 &raquo;</a>
		            </div>
		        </div>
        	</div>
    	</div>
  	</volist>
	<div class="pagination">
  		{$page}
    	<div class="clear"></div>
	</div>
</div>