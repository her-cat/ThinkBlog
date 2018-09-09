<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<aside class="sidebar">	
		<div class="widget d_postlist">
        	<h3>热门文章</h3>
        	<ul>
        		<volist name=":getHotArticle()" id="vo">
        			<li><a href="{$vo.id|articleUrl=###}" title="{$vo.title}">{$vo.title}</a></li>
        		</volist>
			</ul>
		</div>
		<div class="widget d_comment">
        	<h3>最新评论</h3>
        	<ul>
        		<volist name=":getNewComment()" id="vo">
        			<li>
        			<a target="_blank" href="{$vo.article_id|articleUrl=###}#{$vo.id}" title="">
        			<img data-src="http://www.gravatar.com/" alt="" src="__TPL__/Public/Images/avatar-default.png" class="avatar avatar-36 photo" height="36" width"36"="" style="display:block;" original="__TPL__/Public/Images/avatar-default.png">
        			{$vo.name} <span style="color: #999999;">说道：<br><neq name="vo.parent_id" value="0">@{$vo.replyName}：</neq>{$vo.content|msubstr = 0,20, 'utf-8', false}</span>
					</a>
        		</li>
        		</volist>
			</ul>
    	</div>
		<div class="widget widget_links">      
        	<h3>分类</h3>
      		<ul>
      			<volist name=":getAllCategory()" id="vo">
      				<li><a target="_blank" href="{$vo.id|categoryUrl=###}">{$vo.name}</a></li>
      			</volist>
			</ul>
    	</div>
		<div class="widget widget_links">
			<h3 class="widget_tit">友情连接</h3>
    		<ul>
        		<volist name=":getLink()" id="vo">
                    <li><a target="_blank" href="{$vo.url}">{$vo.name}</a></li>
                </volist>
			</ul>
		</div>
</aside>﻿