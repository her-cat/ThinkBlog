<?php
// +----------------------------------------------------------------------
// | 公共配置文件
// +----------------------------------------------------------------------
// | ThinkBlog [ Interest is the best teacher ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 https://github.com/her-cat/ThinkBlog All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: her-cat<hxhsoft@foxmail.com>
// +----------------------------------------------------------------------
if(!defined('THINK_PATH')) exit('非法调用');//防止被外部系统调用
$arr1 = include './Config.php';
$arr2 = array(
    'HTML_FILE_SUFFIX' => '.html',
    'TMPL_PARSE_STRING' => array('__UPLOAD__' => __ROOT__ . '/Uploads', ),
    'TMPL_TEMPLATE_SUFFIX'=>'.php',
    'MODULE_ALLOW_LIST' => array('Home', 'Admin'),
    'DEFAULT_MODULE' => 'Home',
    'URL_ROUTER_ON'   => true,
    'URL_MODEL'=>2,
    'SITE_KEY' => 'b498fa0978aef58367341b8144016371',
    'DATA_CACHE_TYPE' => 'file',
);

return array_merge($arr1, $arr2);