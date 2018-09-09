<?php if(!defined('APP_PATH')) {exit('error!');} ?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-title" content="ThinkBlog">
	<meta http-equiv="Cache-Control" content="no-siteapp">
	<title>{:C('blog_name')} - {:C('blog_info')}</title>
	<meta name="keywords" content="{:C('blog_keywords')}">
	<meta name="description" content="{:C('blog_description')}">
	<meta name="generator" content="ThinkBlog">
	<!-- 引用CSS文件 -->
	<include file="Public:cssFile" />
</head>
<body class="archive category category-front category-130">
<!-- 引用header -->
<include file="Public:header" />
<section class="container">
<!-- 引入文章列表 -->
<include file="Public:articleList" />
<!-- 引入侧边栏 -->
<include file="Public:side" />
</section>
<!-- 引入底部 -->
<include file="Public:footer" />