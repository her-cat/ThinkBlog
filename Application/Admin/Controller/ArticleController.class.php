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
 * ThinkBlog 后台首页类
 */
class ArticleController extends CommonController {

    /**
     * 发布文章
     */
    public function add(){
        if (IS_POST) {
            $post = I('post.');
            $Article = D('Article');
            $post['is_draft'] = IS_AJAX ? 'y' : 'n';
            $post['open_comment'] = !isset($post['open_comment']) ? 'n' : 'y';
            if (C('is_excerpt') == 'y'){
                $post['excerpt'] = msubstr(extractHtml($post['content']), 0, C('excerpt_num'), 'utf-8', false);
            }
            $post['post_time'] = strtotime($post['post_time']);
            $post['user_id'] = cookie('uid');
            if ($post['aid'] > 0) {//自动保存草稿后,添加变为更新
                $Article->updateArticle($post['aid'], $post);
                M('File')->where(array('article_id' => '-1'))->setField('article_id', $post['aid']);
            } else{
                if (!$post['aid'] = $Article->isRepeatPost($post['title'])) {
                    $post['aid'] = $Article->addArticle($post);
                }
            }
            D('Tag')->addTag($post['aid'], $post['tag']);
            self::$Cache->updateCache();
            if (IS_AJAX){
                exit(json_encode(array('status' => '100', 'aid' => $post['aid'])));
            }else{
                $this->success('发布成功！', U('Article/logList'));
            }
        }else{
            $this->display();
        }
    }


    /**
     * 草稿列表页面
     */
    public function draft(){
        $Article = D('Article');
        if (IS_POST) {
            $post = I('post.');
            if ($post['operate'] == 'del') {
                foreach ($post['aid'] as $v){
                    $Article->deleteArticle($v);
                }
                $this->success('删除成功！', U('Article/draft'));
            }else if($post['operate'] == 'pub'){
                foreach ($post['aid'] as $v){
                    $Article->updateArticle($v, array('is_draft' => 'n'));
                }
               $this->success('发布成功！', U('Article/draft'));
            }
            self::$Cache->updateCache();
        }else{
            $get = I('get.');
            $articleList = array();
            if (!empty($get['tag_id'])) {
                $articleList = $Article->getDraftsByTag($get['tag_id']);
            }else if(!empty($get['keyword'])){
                $map['title']  = array('like', '%' . $get['keyword'] . '%');
                $map['is_draft'] = array('eq', 'y');
                $map['type'] = array('eq', 'blog');
                $articleList = $Article->getArticles($map);
            }else{
                $articleList = $Article->getArticles(array('is_draft' => 'y'));
            }
            $this->assign('articleList', $articleList);
            $this->display();
        }
    }
    
    /**
     * 编辑草稿
     */
    public function editDraft(){
        if (IS_POST) {
            $post = I('post.');
            if (empty($post['title'])) { $this->error('标题不能为空！'); }
            if (empty($post['content'])) { $this->error('内容不能为空！'); }
            if ($post['sort'] == -1) { $this->error('请选择分类！！'); }
            if (C('is_excerpt') == 'y'){
                $post['excerpt'] = msubstr(extractHtml($post['content']), 0, C('excerpt_num'), 'utf-8', false);
            }
            $post['open_comment'] = !isset($post['open_comment']) ? 'n' : 'y';
            $post['post_time'] = strtotime($post['post_time']);
            $post['user_id'] = cookie('uid');
            $post['is_draft'] = ($post['submit'] == '保存并返回') ? 'y' : 'n';
            D('Article')->updateArticle($post['aid'], $post);
            D('Tag')->addTag($post['aid'], $post['tag']);
            self::$Cache->updateCache();
            $this->success('保存成功！', U('Article/draft'));
        }else{
            $aid = I('get.aid');
            if (!empty($aid)) {
                $articleInfo = D('Article')->getOneArticle($aid);
                if ($articleInfo) {
                    Tools::createToken();
                    $this->assign('article', $articleInfo);
                    $this->display();
                }else{
                    $this->error('文章不存在！', U('Index/index'));
                }
            }else{
                $this->error('页面不存在！', U('Index/index'));
            }
        }
    }
    
    /**
     * 文章列表
     */
    public function logList(){
        $Article = D('Article');
        if (IS_POST) {
            $post = I('post.');
            if ($post['operate'] == 'del') {
                foreach ($post['aid'] as $v){
                    deleteFile($v);
                    $Article->deleteArticle($v);
                }
                $this->success('删除成功！', U('Article/logList'));
            }else if($post['operate'] == 'hide'){
                foreach ($post['aid'] as $v){
                    $Article->updateArticle($v, array('is_draft' => 'y'));
                }
                $this->success('放入草稿箱成功！', U('Article/logList'));
            }else if($post['operate'] == 'top'){
                foreach ($post['aid'] as $v){
                    $Article->updateArticle($v, array('is_top' => ($post['is_top'] == 'y') ? 'y' : 'n'));
                }
                $this->success('置顶成功！', U('Article/logList'));
            }else if ($post['operate'] == 'move') {
                foreach ($post['aid'] as $v){
                    $Article->updateArticle($v, array('category' => $post['category']));
                }
                $this->success('修改分类成功！', U('Article/logList'));
            }
            self::$Cache->updateCache();
        }else{
            $get = I('get.');
            $articleList = array();
            if (!empty($get['tag_id'])) {
                $articleList =  M()->table('__TAG__ as Tag, __ARTICLE_TAG__ as ArticleTag, __ARTICLE__ as Article')
                                    ->field('Article.id, Article.title')
                                    ->where('Tag.id = ArticleTag.tid and ArticleTag.aid = Article.id and Article.is_draft = "n" and Article.type = "blog" and Tag.id = "' . $get['tag_id'] . '"')
                                    ->order('post_time desc')
                                    ->select();
            }else if (!empty($get['keyword'])) {
                $map['title']  = array('like', '%' . $get['keyword'] . '%');
                $map['is_draft'] = array('eq', 'n');
                $map['type'] = array('eq', 'blog');
                $articleList = $Article->getArticles($map);
            }else{
                $articleList = $Article->getArticlesByAdmin();
            }
            $this->assign('articleList', $articleList);
            $this->display();
        }
    }

    /**
     * 编辑文章
     */
    public function editLog(){
        if (IS_POST) {
            $post = I('post.');
            if (empty($post['title'])) { $this->error('标题不能为空！'); }
            if (empty($post['content'])) { $this->error('内容不能为空！'); }
            if ($post['sort'] == -1) { $this->error('请选择分类！！'); }
            $post['open_comment'] = !isset($post['open_comment']) ? 'n' : 'y';
            if (C('is_excerpt') == 'y'){
                $post['excerpt'] = msubstr(extractHtml($post['content']), 0, C('excerpt_num'), 'utf-8', false);
            }
            $post['post_time'] = strtotime($post['post_time']);
            $post['user_id'] = cookie('uid');
            D('Article')->updateArticle($post['aid'], $post);
            D('Tag')->addTag($post['aid'], $post['tag']);
            $this->success('保存成功！', U('Article/logList'));
            self::$Cache->updateCache();
        }else{
            $aid = I('get.aid');
            if (!empty($aid)) {
                $articleInfo = D('Article')->getOneArticle($aid);
                if ($articleInfo) {
                    $this->assign('article', $articleInfo);
                    $this->display();
                }else{
                    $this->error('文章不存在！', U('Index/index'));
                }
            }else{
                $this->error('该页面不存在！', U('Index/index'));
            }
        }
    }

    /**
     * UE编辑器
     */
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }
}