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
use Admin\Controller\CommonController;
use Org\Util\Tools;

/**
 * 系统模块
 * @package Admin\Controller
 */
class SystemController extends CommonController{

    /**
     * 系统设置
     */
    public function configure(){
        if (IS_POST) {
            $post = I('post.');
            $Config = D('Config');
            $post['login_code'] = isset($post['login_code']) ? 'y' : 'n';
            $post['is_excerpt'] = isset($post['is_excerpt']) ? 'y' : 'n';
            $post['is_comment'] = isset($post['is_comment']) ? 'y' : 'n';
            $post['is_check_comment'] = isset($post['is_check_comment']) ? 'y' : 'n';
            $post['comment_code'] = isset($post['comment_code']) ? 'y' : 'n';
            $post['is_gravatar'] = isset($post['is_gravatar']) ? 'y' : 'n';
            $post['is_thumb'] = isset($post['is_thumb']) ? 'y' : 'n';
            foreach ($post as $k => $v) {
                $Config->updateConfig($k, $v);
            }
            self::$Cache->updateCache('config');
            $this->success('修改成功！', U('System/configure'));
        }else{
            $configs = self::$Cache->readCache('config');
            $configList = array();
            foreach ($configs as $k => $v){
                $configList[$k] = ($v == 'y') ? 'checked="checked"' : $v;
            }
            $this->assign('config', $configList);
            $this->display();
        }
    }

    /**
     * SEO设置
     */
    public function seo(){
        if (IS_POST) {
            $post = I('post.');
            $Config = D('Config');
            foreach ($post as $k => $v) {
                $Config->updateConfig($k, $v);
            }
            self::$Cache->updateCache('config');
            $this->success('修改成功！', U('System/seo'));
        }else{
            $this->display();
        }
    }

    /**
     * 个人设置
     */
    public function blogger(){
        $User = D('User');
        if (IS_POST){
            $post = I('post.');
            if (empty($post['nickname'])){ $this->error('昵称不能为空！'); }
            if (empty($post['name'])){ $this->error('登录名不能为空！'); }
            if (strlen($post['nickname']) > 20) {
                $this->error('昵称不能太长！');
            } else if ($post['email'] != '' && !checkMail($post['email'])) {
                $this->error('电子邮件格式错误！');
            } elseif (strlen($post['newpwd'])>0 && strlen($post['repwd']) < 6) {
                $this->error('密码长度不得小于6位！');
            } elseif (!empty($post['newpwd']) && $post['newpwd'] != $post['repwd']) {
                $this->error('两次输入的密码不一致！');
            } elseif(isUserExist($post['name'], cookie('uid'))) {
                $this->error('该登录名已存在！');
            } elseif(isNicknameExist($post['nickname'], cookie('uid'))) {
                $this->error('该昵称已存在！');
            }
            if (!empty($post['newpwd'])){
                $post['password'] = md5($post['newpwd']);
            }
            unset($post['newpwd']);
            unset($post['repwd']);
            if($_FILES['photo']['name'] != ''){
                $data = $this -> uploadImage();
                if (isset($data)) {
                    $headPath = $User->getUserHead(cookie('uid'));
                    $post['head'] = $data['photo']['savepath'] . $data['photo']['savename'];
                    unlink(__ROOT__ . '/Upload' . $headPath);
                } else {
                    $this -> error('头像上传失败！');
                }
            }
            $User->updateUser(cookie('uid'), $post);
            self::$Cache->updateCache('user');
            Tools::loginOut();
            $this->success('修改成功！', U('Login/index'));
        }else{
            $this->assign('user', $User->where(array('id' => cookie('uid')))->find());
            $this->display();
        }
    }


    /**
     * 上传图片
     * @return array|bool
     */
    private function uploadImage(){
        $file = new \Think\ Upload();
        $file -> maxSize = '1000000';
        $file -> allowExts = array('jpg', 'png', 'jpeg');
        $file -> allowTypes = array('image/png', 'image/jpg', 'image/pjpeg', 'image/jpeg');
        $file -> thumb = fasle;
        $file -> savePath = '/Head/';
        $file -> subName = date('Ymd');
        $file -> uploadReplace = true;
        $file -> saveRule = 'uniqid';
        $info = $file -> upload();
        if ($info) {
            return $info;
        } else {
            $this -> error($file -> getError());
        }
    }
}