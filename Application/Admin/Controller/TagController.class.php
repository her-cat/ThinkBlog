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
 * 标签模块
 * @package Admin\Controller
 */
class TagController extends CommonController{

    /**
     * 标签列表
     */
    public function tagList(){
        if (IS_POST) {
            $post = I('post.');
            $Tag = D('Tag');
            foreach ($post['tag'] as $v) {
                $Tag->deleteTag($v);
            }
            $this->success('删除成功！');
            self::$Cache->updateCache(array('tag', 'articleTag'));
        }else{
            $this->assign('tagList', self::$Cache->readCache('tag'));
            $this->display();
        }
    }

    /**
     * 编辑标签
     */
    public function editTag(){
        $Tag = D('Tag');
        if(IS_POST){
            $post = I('post.');
            if (empty($post['name'])) { $this->error('标签内容不能为空！'); }
            dump($post);
            exit();
            $result = $Tag->updateTagName($post['tid'], $post['name']);
            if ($result) {
                $this->success('保存成功！', U('Tag/tagList'));
            }else{
                $this->error($Tag->getError());
            }
            self::$Cache->updateCache(array('tag', 'articleTag'));
        }else{
            $tid = I('get.tid');
            if (!empty($tid)) {
                $tags = self::$Cache->readCache('tag');
                if (!empty($tags[$tid])) {
                    $this->assign('tag', $tags[$tid]);
                    $this->display();
                }else{
                    $this->error('标签不存在！', U('Index/index'));
                }
            }else{
                $this->error('该页面不存在！', U('Index/index'));
            }
        }
    }
}