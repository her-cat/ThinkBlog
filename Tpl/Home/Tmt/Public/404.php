<?php if(!defined('APP_PATH')) {exit('error!');} ?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>404-页面未找到-{:C('blog_name')}</title>
    <style type="text/css">html{background: #f7f7f7;} body{background: #fff;color: #333;font-family: "MicrosoftYaHei" , "微软雅黑" ,Verdana,Arial;margin: 2em auto 0 auto;width: 700px;padding: 1em 2em;-moz-border-radius: 11px;-khtml-border-radius: 11px;-webkit-border-radius: 11px;border-radius: 11px;border: 1px solid #dfdfdf;} a{color: #2583ad;text-decoration: none;} a:hover{color: #d54e21;} h1{border-bottom: 1px solid #dadada;clear: both;color: #666;margin: 5px 0 5px 0;padding: 0;padding-bottom: 1px;text-align: center;} h2{text-align:center;font-size:30px;} p{text-align: center;font-size:18px;} div{margin-bottom:80px; text-align: center;}#logo img{width: 428px;}
    </style>
    </head>
  <body>
    <h1 id="logo">
      <a href="{:C('blog_url')}"><img alt="{:C('blog_name')}" src="__TPL__/Public/Images/logo.png"></a>
    </h1>
    <h2>Hi,页面未找到<img src="__TPL__/Public/Images/404.gif" style="vertical-align:middle" alt="404错误"></h2>
    <p>抱歉，你输入的网址可能不正确，或者该网页不存在。</p>
    <div>
      <a href="{:C('blog_url')}">
        <span id="seconds_back"></span>返回首页</a>
    </div>
  </body>
  <div style="display:none">
    {:C('footer_info')}
  </div>
</html>