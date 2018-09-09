<?php
// +----------------------------------------------------------------------
// | ThinkBlog [ Interest is the best teacher ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 https://github.com/her-cat/ThinkBlog All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: her-cat<hxhsoft@foxmail.com>
// +----------------------------------------------------------------------
namespace Org\Util;
/**
 * 登录验证类
 */
class Tools{
    /**
     * 验证是否登录
     * @return bool
     */
    public static function isLogin() {
        $uid = isset($_COOKIE['uid']) ? preg_match("/^\d*$/", cookie('uid')) ? cookie('uid') : '' : '';
        $name = isset($_COOKIE['name']) ? cookie('name') : '';
        $shell = isset($_COOKIE['shell']) ? cookie('shell') : '';
        if (empty($uid) || empty($name) || empty($shell)){ return false; }
        $user = M('User')->where(array('id' => $uid, 'nickname' => $name))->find();
        if ($user){
            $realShell = md5($uid . $user['name'] . urldecode($name) . C('SITE_KEY'));
            if ($realShell == $shell){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    /**
     * 设置登录信息
     * @param int $uid
     * @param string $name
     */
    public static function setLoginInfo($uid, $name, $nickname) {
        //写入登录标识
        cookie('uid', $uid, 3600 * 24 * 30);
        cookie('name', $nickname, 3600 * 24 * 30);
        cookie('shell', md5($uid . $name . $nickname .  C('SITE_KEY')), 3600 * 24 * 30);
    }
    
    /**
     * 退出登录
     */
    public static function loginOut() {
        cookie('uid', null);
        cookie('name', null);
        cookie('shell', null);
    }
    
    /**
     * 生成TOKEN
     * @return string TOKEN
     */
     public static function createToken() {
        $token = md5(time());
        session('form_token', $token);
        session_write_close();
        return $token;
    }
    
    /**
     * 验证TOKEN
     * @param string $token
     * @return boolean
     */
    public static function checkToken($token) {
        if (!isset($_SESSION['form_token']) || empty($_SESSION['form_token']) || $_SESSION['form_token'] != $token) {
            return false;
        } else {
            unset($_SESSION['form_token']);
            return true;
        }
    }
}

?>