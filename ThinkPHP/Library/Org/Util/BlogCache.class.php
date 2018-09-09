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
use Think\Cache;

/**
 * 博客缓存类
 * @package Org\Util
 */
class BlogCache {
    /**
     * 缓存类实例
     * @var mixed|null
     */
    private $Cache= null;
    /**
     * 博客缓存类实例
     * @var null
     */
    private static $instance = null;
    /**
     * 数据库实例
     * @var \Model|\Think\Model
     */
    private $db;

    private $config_cache;
    private $user_cache;
    private $sta_cache;
    private $comment_cache;
    private $tag_cache;
    private $category_cache;
    private $link_cache;
    private $nav_cache;
    private $allArticle_cache;
    private $newArticle_cache;
    private $hotArticle_cache;
    private $articleTag_cache;
    private $articleCategory_cache;
    private $articleAlias_cache;
    private $articleFile_cache;

    private function __construct() {
        $this->db = M();
        if ($this->Cache == null){
            $this->Cache = Cache::getInstance();
        }
    }

    /**
     * 返回博客缓存实例
     * @return null|BlogCache
     */
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new BlogCache();
        }
        return self::$instance;
    }

    /**
     * 更新缓存
     *
     * @param array/string $cacheMethodName 需要更新的缓存，更新多个采用数组方式：array('config', 'user'),单个采用字符串方式：'config',全部则留空
     * @return unknown_type
     */
    public function updateCache($cacheMethodName = null) {
        // 更新单个缓存
        if (is_string($cacheMethodName)) {
            if (method_exists($this, $cacheMethodName . 'Cache')) {
                call_user_func(array($this, $cacheMethodName . 'Cache'));
            }
            return;
        }
        // 更新多个缓存
        if (is_array($cacheMethodName)) {
            foreach ($cacheMethodName as $name) {
                if (method_exists($this, $name . 'Cache')) {
                    call_user_func(array($this, $name . 'Cache'));
                }
            }
            return;
        }
        // 更新全部缓存
        if ($cacheMethodName == null) {
            // 自动运行本类所有更新缓存的方法(此类方法的名称必须由Cache结尾)
            $cacheMethodNames = get_class_methods($this);
            foreach ($cacheMethodNames as $method) {
                if (preg_match('/Cache$/', $method) && !in_array($method, array('updateCache', 'writeCache', 'readCache'))) {
                    call_user_func(array($this, $method));
                }
            }
        }
    }

    /**
     * 博客配置缓存
     * 更新缓存的方法必须为Cache
     */
    public function configCache(){
        $cacheData = array();
        $res = $this->db->table('__CONFIG__')->select();
        foreach ($res as $v){
            if (in_array($v['name'], array('blog_name', 'blog_info', 'blog_url', 'icp'))) {
                $v['value'] = htmlspecialchars($v['value']);
            }
            $cacheData[$v['name']] = $v['value'];
        }
        $this->writeCache('config', $cacheData);
    }

    /**
     * 用户信息缓存
     */
    public function userCache(){
        $cacheData = array();
        $res = $this->db->table('__USER__')->select();
        foreach ($res as $v){
            $cacheData[$v['id']] = array(
                'head' => $v['head'],
                'name' => htmlspecialchars($v['nickname']),
                'nickname' => htmlspecialchars($v['nickname']),
                'mail' => htmlspecialchars($v['email']),
                'homepage' => $v['homepage'],
                'state' => htmlspecialchars($v['state']),
                'role' => $v['role'],
            );
        }
        $this->writeCache('user', $cacheData);
    }

    /**
     * 统计信息缓存
     */
    public function staCache(){
        $cacheData = array();
        $cacheData['articleNum'] = $this->db->table('__ARTICLE__')->where(array('is_draft' => 'n', 'type' => 'blog'))->count();
        $cacheData['topArticleNum'] = $this->db->table('__ARTICLE__')->where(array('is_draft' => 'n', 'is_top' => 'y', 'type' => 'blog'))->count();
        $cacheData['draftNum'] = $this->db->table('__ARTICLE__')->where(array('is_draft' => 'y', 'type' => 'blog'))->count();
        $cacheData['commNum'] = $this->db->table('__COMMENT__')->where(array('is_hide' => 'n'))->count();
        $cacheData['hideComm'] = $this->db->table('__COMMENT__')->where(array('is_hide' => 'y'))->count();
        $cacheData['allComm'] = $cacheData['commNum'] + $cacheData['hideComm'];
        $cacheData['cateNum'] = $this->db->table('__CATEGORY__')->count();
        $cacheData['tagNum'] = $this->db->table('__TAG__')->count();
        $cacheData['fileNum'] = $this->db->table('__FILE__')->count();
        $cacheData['linkNum'] = $this->db->table('__LINK__')->count();
        $this->writeCache('sta', $cacheData);
    }

    /**
     * 最新评论缓存
     */
    public function commentCache(){
        $cacheData = $this->db->table('__COMMENT__')->where(array('is_hide' => 'n'))->field('id, article_id, parent_id, name, url, email, content')->order('post_time desc')->limit(10)->select();
        for ($i = 0; $i < count($cacheData); $i++) {
            if ($cacheData[$i]['parent_id'] != 0) {
                $cacheData[$i]['replyName'] = getReplyName($cacheData[$i]['parent_id']);
            }
        }
        $this->writeCache('comment', $cacheData);
    }

    /**
     * 侧边栏标签缓存
     */
    public function tagCache(){
        $tags = $this->db->table('__TAG__')->field('id, name')->select();
        $cacheData = array();
        foreach ($tags as $v){
            $cacheData[$v['id']] = $v;
        }
        $this->writeCache('tag', $cacheData);
    }

    /**
     * 侧边栏分类缓存
     */
    public function categoryCache(){
        $cacheData = array();
        $cates = $this->db->table('__CATEGORY__')->field('id, name, alias')->select();
        foreach ($cates as $key => $value) {
            $cacheData[$value['id']] = $value;
        }
        $this->writeCache('category', $cacheData);
    }

    /**
     * 友情链接缓存
     */
    public function linkCache(){
        $cacheData = $this->db->table('__LINK__')->field('id, name, description as des, is_hide , url')->select();
        $this->writeCache('link', $cacheData);
    }

    /**
     * 导航缓存
     */
    public function navCache(){
        $cacheData = array();
        $caches = $this->db->table('__NAV__')->where(array('is_hide' => 'n', 'parent_id' => 0))->order('taxis asc')->select();
        foreach ($caches as $value){
            $cacheData[$value['id']] = $value;
        }
        $this->writeCache('nav', $cacheData);
    }

    public function allArticleCache(){
        $cacheData = array();
        $articles = $this->db->table('__ARTICLE__')->field('id, user_id, title, category, excerpt, comment_num, view_num, post_time')->where(array('is_draft' => 'n', 'type' => 'blog'))->order('id asc')->select();
        foreach ($articles as $value){
            $cacheData[$value['id']] = $value;
        }
        $this->writeCache('allArticle', $cacheData);
    }

    /**
     * 最新文章缓存
     */
    public function newArticleCache(){
        $cacheData = array();
        $articles = $this->db->table('__ARTICLE__')->field('id, title, post_time')->where(array('is_draft' => 'n', 'type' => 'blog'))->order('post_time desc')->limit(10)->select();
        foreach ($articles as $value){
            $cacheData[$value['id']] = $value;
        }
        $this->writeCache('newArticle', $cacheData);
    }

    /**
     * 热门文章缓存
     */
    public function hotArticleCache(){
        $cacheData = array();
        $articles = $this->db->table('__ARTICLE__')->field('id, title, post_time')->where(array('is_draft' => 'n', 'type' => 'blog'))->order('view_num desc, comment_num')->limit(10)->select();
        foreach ($articles as $value){
            $cacheData[$value['id']] = $value;
        }
        $this->writeCache('hotArticle', $cacheData);
    }

    /**
     * 文章标签缓存
     */
    public function articleTagCache(){
        $cacheData = array();
        $articleId = $this->db->table('__ARTICLE__')->where(array('type' => 'blog'))->order('id asc')->getField('id', true);
        foreach ($articleId as $aid){
            $tags = array();
            $row = $this->db->table('__TAG__ as Tag, __ARTICLE_TAG__ as ArticleTag')
                            ->field('Tag.id, Tag.name')
                            ->where('Tag.id = ArticleTag.tid and ArticleTag.aid = "' . $aid . '"')
                            ->select();
            foreach ($row as $v){
                $v['name'] = htmlspecialchars($v['name']);
                $v['id'] = intval($v['id']);
                $tags[] = $v;
            }
            $cacheData[$aid] = $tags;
            unset($tags);
        }
        $this->writeCache('articleTag', array_filter($cacheData));
    }

    /**
     * 文章分类缓存
     */
    public function articleCategoryCache(){
        $article = $this->db->table('__ARTICLE__')->where(array('type' => 'blog'))->order('id asc')->getField('id, category', true);
        $cacheData = array();
        foreach ($article as $aid => $cid){
            if ($cid > 0) {
                $res = $this->db->table('__CATEGORY__')->field('id, name, alias')->where(array('id' => $cid))->find();
                $cacheData[$aid] = array(
                    'id' => htmlspecialchars($res['id']),
                    'name' => htmlspecialchars($res['name']),
                    'alias' => htmlspecialchars($res['alias']),
                );
            }
        }
        $this->writeCache('articleCategory', $cacheData);
    }

    public function articleFileCache(){
        $article = $this->db->table('__ARTICLE__')->where(array('type' => 'blog'))->order('id asc')->getField('id', true);
        $cacheData = array();
        foreach ($article as $aid){
            $file = $this->db->table('__FILE__')->field('id, save_path')->where(array('article_id' => $aid))->find();
            $cacheData[$aid] = array(
                'id' => htmlspecialchars($file['id']),
                'save_path' => htmlspecialchars($file['save_path']),
            );
        }
        $this->writeCache('articleFile', $cacheData);
    }

    /**
     * 写入缓存数据
     * @param $cacheName 缓存变量名
     * @param $cacheData 存储数据
     * @param null $expire 有效时间 0为永久
     */
    public function writeCache($cacheName, $cacheData, $expire = null){
        $this->Cache->set($cacheName, $cacheData, $expire);
        $this->{$cacheName. '_cache'} = $cacheData;
    }

    /**
     * 读取缓存文件
     * @param $cacheName 缓存变量名
     * @return mixed 存储的数据
     */
    public function readCache($cacheName){
        if ($this->{$cacheName . '_cache'} != null){
            return $this->{$cacheName. '_cache'};
        }else{
            $cacheData = $this->Cache->get($cacheName);
            if (!$cacheData){
                if (method_exists($this,  $cacheName . 'Cache')) {
                    call_user_func(array($this, $cacheName . 'Cache'));
                }
            }else{
                $this->{$cacheName . '_cache'} = $cacheData;
            }
            return $this->{$cacheName.'_cache'};
        }
    }

}