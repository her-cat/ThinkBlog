<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<footer class="footer">
	<div class="container">{:C('footer_info')}</div>
</footer>
<script type="text/javascript" src="__TPL__/Public/Js/jquery.min.js"></script>
<script type="text/javascript" src="__TPL__/Public/Js/jquery.lazyload.js"></script>
<script type="text/javascript">
	var jQuery=$.noConflict();
	jQuery("img").lazyload({
		effect : "fadeIn",
		failurelimit : 10});
</script>
<script>
	window.jsui={www: 'localhost/ThinkBlog/',uri: '__TPL__/Public/',ver: '6.0.5'};
</script>
<script type="text/javascript" src="__TPL__/Public/Js/loader.js"></script>
<script type="text/javascript" src="__TPL__/Public/Js/jquery.fancybox.js"></script>

<div class="m-mask" style="display: none;"></div>
<div class="rollbar" style="display: none;">
	<ul>
		<li>
			<a href="javascript:(scrollTo());">
			<i class="fa icon-large icon-angle-up"></i></a><h6>去顶部<i></i></h6>
		</li>    
	</ul>
</div>
</body>
</html>