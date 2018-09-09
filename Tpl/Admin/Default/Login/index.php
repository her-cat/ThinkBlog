<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8"/>
<title>ThinkBlog 后台登录</title>
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
<script src="__TPL__/Public/Js/app.js"></script>
<script src="__TPL__/Public/Js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="__TPL__/Public/Js/app.plugin.js"></script>
<script src="__TPL__/Public/Js/md5.js"></script>
<!--[if lt IE 9]>
<script src="__TPL__/Public/Js/ie/html5shiv.js"></script>
<script src="__TPL__/Public/Js/ie/respond.min.js"></script>
<script src="__TPL__/Public/Js/ie/excanvas.js"></script>
<![endif]-->
<script>
    //页面js本机加载时间
    var loadtime = parseInt(new Date().getTime()/1000);
    // 登录信息检查
    function onlogin(){
        var name = document.getElementById("username").value;
        var pwd = document.getElementById("userpwd").value;
        if (name.length == 0 || pwd.length == 0){
            alert("无效的用户名或口令");
            return false;
        }
        var currtime = parseInt(new Date().getTime()/1000);
        //当前时间戳 = php的loadtime时间 + (js当前时间 - js的load时间)
        var timestamp = {$Think.const.NOW_TIME} + currtime - loadtime;
        //将123456进行md5加密
        var pwdMd5 = hex_md5(pwd);
        //将CleverCode与pwdMd5以及与当前时间加密
        pwdMd5 = hex_md5(name + pwdMd5 + timestamp);
        // pwdMd5 = hex_md5('hxh' + pwdMd5 + 1473580037);
        document.getElementById("timestamp").value = timestamp;
        document.getElementById("pwdMd5").value = pwdMd5;
        // hide the password
        document.getElementById("userpwd").value = "******";
        return true;
    }
</script>
</head>
<body>
<section class="m-t-lg wrapper-md animated fadeInUp">
	<div class="container aside-xl">
		<a class="navbar-brand block">ThinkBlog 后台登录 </a>
		<section class="m-b-lg">
			<header class="wrapper text-center"></header>
			<form name="login_form" method="post" action="{:U('Login/login')}">
				<div class="list-group">
					<div class="list-group-item">
						<input type="text" name="username" id="username"  placeholder="用户名" class="form-control no-border">
					</div>
					<div class="list-group-item">
						<input type="password" name="userpwd" id="userpwd" placeholder="密码" class="form-control no-border">
					</div>	
                    <div class="list-group-item">
                        <div class="val"><input name="imgcode" id="imgcode" placeholder="请输入验证码" type="text" class="no-border">
                            <img src="{:U('Login/verify')}" align="absmiddle">
                        </div>	
                    </div>		
                </div>
				<input type="hidden" name="timestamp" id="timestamp">
				<input type="hidden" name="pwdMd5" id="pwdMd5">
				<div class="list-group"><input type="submit" value=" 登 录" class="btn btn-lg btn-primary btn-block" onclick="return onlogin()"></div>
			</form>
		</section>
	</div>
</section>
<footer id="footer">
	<div class="text-center padder">
		<p><small>&copy; 2014-2016 <a href="https://github.com/her-cat/ThinkBlog" target="_blank">ThinkBlog</a> 版权所有</small></p>
	</div>
</footer>
</body>
</html>
