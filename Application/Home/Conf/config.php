<?php
// +----------------------------------------------------------------------
// | 前台配置文件
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
return  array(
    'DEFAULT_THEME' => 'Tmt',
    'URL_CASE_INSENSITIVE' => true,
    'URL_ROUTE_RULES'=>array(
        'category/:alias/p/:p\d' => 'Home/Index/category',
        'category/:alias' => 'Home/Index/category',
        'author/:uid\d' => 'Home/Index/author',
        'tag/:tag' => 'Home/Index/tag',
        'action/:act' => 'Home/Article/:1',
        'rss' => 'Home/Index/rss',
        'page/:p\d' => 'Home/Index/index',
        ':alias/:aid' => 'Home/Article/index'
    ),
    'HTML_CACHE_ON' => false, // 开启静态缓存
    'HTML_CACHE_TIME' => 1800,   // 全局静态缓存有效期（秒） 0为永久缓存
    'HTML_FILE_SUFFIX' => '.shtml', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(  // 定义静态缓存规则
        '*'=>array('{$_SERVER.REQUEST_URI|md5}'),
    ),
);
