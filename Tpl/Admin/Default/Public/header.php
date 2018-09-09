<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Language" content="zh-CN" />
<meta name="author" content="dbkong.com"/>
<meta name="robots" content="noindex, nofollow">
<title>管理中心 - {$Think.config.blog_name}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<link rel="stylesheet" href="__TPL__/Public/Css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" href="__TPL__/Public/Css/animate.css" type="text/css"/>
<link rel="stylesheet" href="__TPL__/Public/Css/font-awesome.min.css" type="text/css"/>
<link rel="stylesheet" href="__TPL__/Public/Css/icon.css" type="text/css"/>
<link rel="stylesheet" href="__TPL__/Public/Css/font.css" type="text/css"/>
<link rel="stylesheet" href="__TPL__/Public/Css/app.css" type="text/css"/>
<link rel="stylesheet" href="__TPL__/Public/Css/style.css" type="text/css"/>
<script src="__TPL__/Public/Js/jquery.min.js"></script>
<script src="__TPL__/Public/Js/jquery-ui.min.js?v=5.3.1"></script>
<script src="__TPL__/Public/Js/bootstrap.js"></script>
<script src="__TPL__/Public/Js/app.js?v=5.3.1"></script>
<script src="__TPL__/Public/Js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="__TPL__/Public/Js/app.plugin.js?v=5.3.1"></script>
<script type="text/javascript" src="__TPL__/Public/Js/common.js?v=5.3.1"></script>
<!--[if lt IE 9]>
<script src="__TPL__/Public/Js/ie/html5shiv.js"></script>
<script src="__TPL__/Public/Js/ie/respond.min.js"></script>
<script src="__TPL__/Public/Js/ie/excanvas.js"></script>
<![endif]-->
</head>
<body class="">
<section class="vbox">
<header class="bg-light header header-md navbar navbar-fixed-top-xs box-shadow">
	<div class="navbar-header aside-md dk">
		<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"><i class="fa fa-bars"></i></a>
		<a class="navbar-brand" href="{:U('Index/index')}" target="_blank" title="在新窗口浏站点"><span class="hidden-nav-xs">后台管理</span></a>
		<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user"><i class="fa fa-cog"></i></a>
	</div>
	<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
		<li class="hidden-xs"><a href="{:U('System/configure')}"><i class="fa fa-cog" style="font-size:18px;"></i></a></li>

   				<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"><img src="__TPL__/Public/Images/avatar.jpg"></span>{$Think.cookie.name}<b class="caret"></b></a>
			<ul class="dropdown-menu animated fadeInRight">
				<li><span class="arrow top"></span><a href="{:U('Common/exitLogin')}"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
			</ul>
		</li>
	</ul>
</header>
<section>
<section class="hbox stretch">
	<aside class="bg-black lt b-r b-light aside-md hidden-print" id="nav">
		<section class="vbox">
			<section class="w-f scrollable">
				<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railopacity="0.2">
					<!-- <div class="clearfix wrapper dk nav-user hidden-xs">
						<div class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								
								<span class="hidden-nav-xs clear">
									<span class="block m-t-xs"><strong class="font-bold text-lt">{$Think.cookie.name}</strong><b class="caret"></b></span>
									<span class="text-muted text-xs block">Administrator</span>
								</span>
							</a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><span class="arrow top hidden-nav-xs"></span><a href="{:U('Common/exitLogin')}"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
							</ul>
						</div>
					</div> -->
					<!-- nav-->
					<nav class="nav-primary hidden-xs">
						<ul class="nav nav-main" data-ride="collapse">
							<li id="menu_home"><a href="{:U('Index/index')}" class="auto"><i class="i i-home icon"></i><span class="font-bold">首页</span></a></li>
							<li id="menu_wt"><a href="{:U('Article/add')}" class="auto"><i class="fa fa-edit"></i><span class="font-bold">写文章</span></a></li>
							<li id="menu_draft"><a href="{:U('Article/draft')}" class="auto"><i class="i i-paste icon"></i><span class="font-bold">草稿</span></a></li>
							<li id="menu_log"><a href="{:U('Article/logList')}" class="auto"><i class="i i-list icon"></i><span class="font-bold">文章</span></a></li>
							<li id="menu_tag"><a href="{:U('Tag/tagList')}" class="auto"><i class="i i-tag icon"></i><span class="font-bold">标签</span></a></li>
							<li id="menu_sort"><a href="{:U('Category/categoryList')}" class="auto"><i class="i i-add-to-list icon"></i><span class="font-bold">分类</span></a></li>
							<li id="menu_cm"><a href="{:U('Comment/commentList')}" class="auto"><i class="i i-bubble icon"></i><span class="font-bold">评论</span></a></li>
							<li id="menu_link"><a href="{:U('Link/linkList')}" class="auto"><i class="i i-link2 icon"></i><span class="font-bold">链接</span></a></li>
							<li id="menu_category_view">
								<a href="#" class="auto">
									<span class="pull-right text-muted"><i class="i i-circle-sm-o text"></i><i class="i i-circle-sm text-active"></i></span>
									<i class="i i-laptop icon"></i><span class="font-bold">外观</span>
								</a>
								<ul class="nav dk">
									<li id="menu_navbar"><a href="{:U('Appearance/navbar')}" class="auto"><i class="fa fa-align-justify"></i><span>导航</span></a></li>
									<li id="menu_tpl"><a href="{:U('Appearance/manageTemplate')}" class="auto"><i class="fa fa-magic"></i><span>模板</span></a></li>
								</ul>
							</li>
							<li id="menu_setting"><a href="{:U('System/configure')}" class="auto"><i class="fa fa-wrench"></i><span class="font-bold">设置</span></a></li>
							<!-- <li id="menu_category_sys">
								<a href="#" class="auto">
									<span class="pull-right text-muted"><i class="i i-circle-sm-o text"></i><i class="i i-circle-sm text-active"></i></span>
									<i class="i i-settings icon"></i><span class="font-bold">系统</span>
								</a>
								<ul class="nav dk">
									<li id="menu_setting"><a href="{:U('System/configure')}" class="auto"><i class="fa fa-wrench"></i><span>设置</span></a></li>
									<li id="menu_user"><a href="user" class="auto"><i class="fa fa-user"></i><span>用户</span></a></li>
									<li id="menu_data"><a href="data" class="auto"><i class="i i-data"></i><span>数据</span></a></li>
									<li id="menu_plug"><a href="plugin" class="auto"><i class="fa fa-gears"></i><span>插件</span></a></li>
									<li id="menu_store"><a href="store" class="auto"><i class="fa fa-shopping-cart"></i><span>应用</span></a></li>
								</ul>
							</li> -->
						</ul>
					</nav>
					<!-- nav-->
				</div>
			</section>
		</section>
	</aside>
	<section>