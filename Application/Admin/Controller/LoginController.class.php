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

namespace Admin\Controller;
use Think\Controller;
use Org\Util\Tools;

/**
 * ThinkBlog 后台登录类
 */
class LoginController extends Controller{

    /**
     * 登录后台界面
     */
    public function index(){
        $this->display();
    }
    
    /**
     * 处理登录信息
     */
    public function login(){
        if (IS_POST) {
            //接收表单信息
            $userName = trim(I('post.username', ''));
            $userPwd = trim(I('post.userpwd', ''));
            $timestamp = trim(I('post.timestamp', ''));
            $pwdMd5 = trim(I('post.pwdMd5', ''));
            $imgcode = I('post.imgcode','');
            if (empty($userName) || empty($userPwd) || empty($timestamp) || empty($pwdMd5)) {
                $this->error('所有项不能为空！');
            }
            if(!check_verify($imgcode)){
                $this->error("亲，验证码输错了哦！", U('Login/index'));
            }
            $this->checkLogin($userName, $timestamp, $pwdMd5);
        }else{
            $this->error('非正常访问！', U('Login/index'));
        }
    }

    private function checkLogin($userName, $timestamp, $pwdMd5){
        //检验时间戳
        $lifeTime = 60;
        $nowTime = time();
        //登录页面如果超过60s,则超时需要重新输入
        if(($nowTime - $timestamp) >= $lifeTime){
//            $this->error('登陆超时！', U('Login/index'));
        }
        $userInfo = M('User')->where(array('name' => $userName , 'level' => 1))->find();
        //检验用户是否存在
        if(empty($userInfo['name'])){
            $this->error('账号不存在，请重新输入！', U('Login/index'));
        }
        //获取用户的密码，该密码为用户密码明文的MD5值，保存在数据库中
        //检验密码是否正确
        $realPwd = md5($userName . $userInfo['password'] . $timestamp);
        if($realPwd == $pwdMd5){
            Tools::setLoginInfo($userInfo['id'], $userName, $userInfo['nickname']);

            $this->success('登录成功，正在跳转至后台首页！', U('Index/index'));
        }else{
            $this->error('密码错误，请重新输入！', U('Login/index'));
        }
    }

    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 18;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 130;
        $Verify->imageH = 50;
        //$Verify->expire = 600;
        $Verify->entry();
    }
}