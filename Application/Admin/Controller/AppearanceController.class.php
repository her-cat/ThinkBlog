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

/**
 * 外观模块
 * @package Admin\Controller
 */
class AppearanceController extends CommonController{

    /**
     * 导航栏列表
     */
    public function navbar(){
        $this->assign('navList', M('nav')->order('taxis asc')->select());
        $this->assign('categoryList', self::$Cache->readCache('category'));
        $this->display();
    }

    /**
     * 添加导航
     */
    public function addNav(){
        if (IS_POST) {
            $post = I('post.');
            if (empty($post['name']) || empty($post['url'])) { $this->error('导航名称和地址不能为空！'); }
            if (!preg_match("/^(http|https|ftp):\/\/.*$/i", $post['url'])) { $this->error('导航地址格式错误！');}
            if(!isset($post['new_tab'])){ $post['new_tab'] = 'n'; }
            D('Nav')->addNav($post);
            self::$Cache->updateCache('nav');
            $this->success('添加成功！', U('Appearance/navbar'));
        }else{
            $this->redirect('Appearance/navbar');
        }
    }

    /**
     * 删除导航
     */
    public function deleteNav(){
        $nid = I('get.nid', '');
        if (!empty($nid)) {
            D('Nav')->deleteNav($nid);
            self::$Cache->updateCache('nav');
            $this->success('删除成功！', U('Appearance/navbar'));
        }else{
            $this->redirect('Appearance/navbar');
        }
    }

    /**
     * 编辑导航
     */
    public function editNav(){
        if (IS_POST) {
            $post = I('post.');
            if (empty($post['name']) || empty($post['url'])) { $this->error('导航名称和地址不能为空！'); }
            if (!preg_match("/^(http|https|ftp):\/\/.*$/i", $post['url'])) { $this->error('导航地址格式错误！'); }
            if(!isset($post['new_tab'])){ $post['new_tab'] = 'n'; }
            D('Nav')->updateNav($post['nid'], $post);
            self::$Cache->updateCache('nav');
            $this->success('修改成功！', U('Appearance/navbar'));
        }else{
            $nid = I('get.nid', '');
            if (!empty($nid)) {
                $nav = D('Nav')->getOneNav($nid);
                if($nav) {
                    $this->assign('nav', $nav);
                    $this->display();
                }else{
                    $this->error('不存在该导航！');
                }
            }else{
                $this->redirect('Appearance/navbar');
            }
        }
    }

    /**
     * 更新排序
     */
    public function updateOrder(){
        if (IS_POST) {
            $nav = I('post.nav', '');
            if (!empty($nav)) {
                $Nav =D('Nav');
                foreach ($nav as $k => $v) {
                    $Nav->updateNav($k, array('taxis' => $v));
                }
                self::$Cache->updateCache('nav');
                $this->success('修改成功！', U('Appearance/navbar'));
            }else{
                $this->redirect('Appearance/navbar');
            }
        }else{
            $this->redirect('Appearance/navbar');
        }
    }

    /**
     * 更新导航状态
     */
    public function updateStatus(){
        $nid = I('get.nid', '');
        $action = isset($_GET['action']) ? I('get.action') : '';
        if (!empty($nid) && !empty($action)) {
            D('Nav')->updateNav($nid, array('is_hide' => ($action == 'show') ? 'n' : 'y'));
            self::$Cache->updateCache('nav');
            $this->redirect('Appearance/navbar');
        } else {
            $this->redirect('Appearance/navbar');
        }
    }

    /**
     * 将分类添加到导航
     */
    public function addCategory(){
        if (IS_POST) {
            $cid = I('post.cid');
            $Nav = D('Nav');
            $Category = D('Category');
            foreach ($cid as $id) {
                $cateName = $Category->getCateName($id);
                $url = categoryUrl($id);
                $Nav->addNav(array('name' => $cateName,
                                    'url' => $url,
                                    'new_tab' => 'y',
                                    'is_hide' => 'n'));
            }
            self::$Cache->updateCache('nav');
            $this->success('添加成功！', U('Appearance/navbar'));
        }else{
            $this->redirect('Appearance/navbar');
        }
    }

    /**
     * 管理模板
     */
    public function manageTemplate(){
        $this->display();
    }

    /**
     * 安装模板
     */
    public function installTemplate(){
        $this->display();
    }
}