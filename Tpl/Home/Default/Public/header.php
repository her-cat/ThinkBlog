<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<header class="header">
<div id="loading"><div style="width: 33%; display: none;"></div></div>
<div class="container">
	<div class="logo">
		<a href="{:C('blog_url')}" title="{:C('blog_name')}"></a>
	</div>
	<ul class="navbar">
		<li class="navto">
			<a href="{:C('blog_url')}">首页</a>
		</li>
		<volist	name=":getNavList(0)" id="vo">
			<eq name="vo.id|getChildrenNum='nav', ###" value="0">
				<li class="navto">
					<a href="{$vo.url}">{$vo.name}</a>
				</li>
			<else />
				<li class="navto-theme">
					<a href="{$vo.url}">{$vo.name} <i class="icon-caret-down"></i></a>
					<ul class="sub-menu">
						<volist name="vo.children" id="v">
							<li class="navto-d"><a href="{$v.url}">{$v.name}</a></li>
						</volist>
				    </ul>
				</li>
			</eq>
		</volist>
	</ul>
	<form class="searchform" name="keyform" method="get" action="{:C('blog_url')}">
		<input class="search-input" name="keyword" type="text" placeholder="输入关键字搜索"><button class="search-btn" type="submit"><i class="icon-search icon-large"></i></button>
	</form>
	<div class="m-icon-nav"><i class="icon-windows"></i></div>
</div>
</header>