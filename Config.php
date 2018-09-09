<?php
if(!defined('THINK_PATH')) exit('非法调用');//防止被外部系统调用
return array(
    // 数据库配置
    'DB_TYPE' => 'mysql',	//数据库类型
    'DB_HOST' => '',	//服务器地址
    'DB_NAME' => '',	//数据库名
    'DB_USER' => '',	//数据库用户名
    'DB_PWD' => '',		//数据库密码
    'DB_PORT' => '3306',                //数据库端口
    'DB_PREFIX' => 'hxh_',		        //数据库表前缀

    // 邮件配置
    'MAIL_SMTP' => 'smtp.163.com',
    'MAIL_PORT' => '25',
    'MAIL_USER' => '',
    'MAIL_PWD' => '',
    'MAIL_TYPE' => 'smtp',
    'MAIL_ADMIN' => '',                 
    'IS_SEND_MAIL' => 'y',
//   'SHOW_PAGE_TRACE' => true//设置调试
);	