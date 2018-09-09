<?php if(!defined('APP_PATH')) {exit('error!');} ?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="zh-CN" />
    <meta name="generator" content="ThinkBlog By HeXiangHui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{$params.value}-{:C('blog_name')}</title>
    <meta name="keywords" content="{:C('blog_keywords')}" />
    <meta name="description" content="{:C('blog_description')}" />
    <link rel="stylesheet" rev="stylesheet" href="__TPL__/Public/Css/style.css" type="text/css" media="all" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="__TPL__/Public/Js/common.js" type="text/javascript"></script>
    <script type="text/javascript" src="__TPL__/Public/Js/com.js"></script>
    <link rel="alternate" type="application/rss+xml" href="{:C('blog_url')}/rss" title="{:C('blog_name')}" />
  </head>
  <body class="home blog">
    <div id="wrapper-innerIE6"></div>
    <div id="wrapper">
      <div id="wrapper-inner" data-bymts="theme-bymt mouse-title ajax-posts ajax-search highlight">
        <!-- 引用header -->
        <include file="Public:header" />
        <div id="content-wrap">
          <eq name="params.name" value="keyword">
            <!-- 引入文章列表 -->
            <include file="Index:search" />
          <else />
            <!-- 引入文章列表 -->
            <include file="Public:articleList" />
          </eq>
          <!-- 引入侧边栏 -->
          <include file="Public:side" />
        </div>
      <!-- 引入底部 -->
      <include file="Public:footer" />
      </div>
    </div>
  </body>
</html>