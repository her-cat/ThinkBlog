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
 * 链接模块
 * @package Admin\Controller
 */
class LinkController extends CommonController{

    /**
     * 链接列表
     */
    public function linkList(){
        $this->assign('linkList', D('Link')->getLinks());
        $this->display();
    }

    /**
     * 添加链接
     */
    public function addLink(){
        if (IS_POST) {
            $post = I('post.');
            if (empty($post['name']) || empty($post['url'])) { $this->error('站点名称和地址不能为空！'); }
            D('Link')->addLink($post);
            self::$Cache->updateCache('link');
            $this->success('添加成功！', U('Link/linkList'));
        }else{
            $this->redirect('Link/linkList');
        }
    }

    /**
     * 编辑链接
     */
    public function editLink(){
        if (IS_POST) {
            $post = I('post.');
            if (empty($post['name']) || empty($post['url'])) { $this->error('站点名称和地址不能为空！'); }
            if (!preg_match("/^(http|https|ftp):\/\/.*$/i", $post['url'])) {
                $this->error('站点地址格式错误！');
            }
            D('Link')->updateLink($post['lid'], $post);
            self::$Cache->updateCache('link');
            $this->success('修改成功！', U('Link/linkList'));
        }else{
            $lid = isset($_GET['lid']) ? I('get.lid') : '';
            if (!empty($lid)) {
                $link = D('Link')->getOneLink($lid);
                if($link) {
                    $this->assign('link', $link);
                    $this->display();
                }else{
                    $this->error('不存在该链接！');
                }
            }else{
                $this->redirect('Link/linkList');
            }
        }
    }

    /**
     * 删除链接
     */
    public function deleteLink(){
        $lid = isset($_GET['lid']) ? I('get.lid') : '';
        if (!empty($lid)) {
            D('Link')->deleteLink($lid);
            self::$Cache->updateCache('link');
            $this->success('删除成功！', U('Link/linkList'));
        }else{
            $this->redirect('Link/linkList');
        }
    }

    /**
     * 更新链接状态
     */
    public function updateStatus(){
        $lid = isset($_GET['lid']) ? I('get.lid') : '';
        $action = isset($_GET['action']) ? I('get.action') : '';
        if (!empty($lid) && !empty($action)) {
            D('Link')->updateLink($lid, array('is_hide' => ($action == 'show' ? 'n' : 'y')));
            self::$Cache->updateCache('link');
            $this->redirect('Link/linkList');
        } else {
            $this->redirect('Link/linkList');
        }
    }

    /**
     * 更新排序
     */
    public function updateOrder(){
        if (IS_POST) {
            $link = isset($_POST['link']) ? I('post.link') : '';
            if (!empty($link)) {
                $Link = D('Link');
                foreach ($link as $k => $v) {
                    $Link->updateLink($k, array('taxis' => $v));
                }
                self::$Cache->updateCache('link');
                $this->success('修改成功！', U('Link/linkList'));
            }else{
                $this->redirect('Link/linkList');
            }
        }else{
            $this->redirect('Link/linkList');
        }
    }
}