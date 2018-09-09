<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<div id="header" class="container">
  <div id="header-inner">
    <div id="logo">
      <a title="{:C('blog_name')}" href="{:C('blog_url')}" rel="index">
        <img src="__TPL__/Public/Images/logo.png" alt="{:C('blog_name')}" /></a>
    </div>
  </div>
  <div class="line"></div>
  <div id="mobile-nav">
    <a>
      <i class="icon-menu"></i>Menu</a>
  </div>
  <div id="main-nav">
    <div id="nav-menu">
      <ul>
        <li id="nvabar-item-index">
          <a href="{:C('blog_url')}">首页</a>
        </li>
      <volist name=":getNavList(0)" id="vo" key="i">
        <li class="navbar-category-{$vo.id}">
          <a href="{$vo.url}">{$vo.name}</a>
        </li>
      </volist>
      </ul>
    </div>
    <div id="nav-search">
      <form action="{:C('blog_url')}" method="get">
        <input type="text" name="keyword" id="search-input" data-searchtips="输入关键字搜索" value=""/>
        <input type="submit" value="搜索" />
      </form>
    </div>
  </div>
</div>
<div id="topbar" class="container">
  <div id="bulletin">
    <i class="icon-sound"></i>
    <span class="comment_text">启用新博客程序，欢迎提建议~</span></div>
</div>