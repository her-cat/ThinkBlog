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

namespace Admin\Model;
use Org\Util\BlogCache;
use Org\Util\Tools;
use Think\Model;

/**
 * 文章模型
 * @package Admin\Model
 */
class ArticleModel extends Model{

    /**
     * 增加文章浏览量
     * @param $aid 文章ID
     */
    public function addViewCount($aid){
        $this->where(array('id' => $aid))->setInc('view_num', 1);
    }

    /**
     * 增加文章评论数
     * @param $aid 文章ID
     */
    public function addCommentCount($aid){
        $this->where(array('id' => $aid))->setInc('comment_num', 1);
    }

    /**
     * 减少文章评论数
     * @param $aid 文章ID
     */
    public function reduceCommentCount($aid){
        $this->where(array('id' => $aid))->setDec('comment_num', 1);
    }

    /**
     * 添加文章
     * @param $articleData 文章数据
     * @return mixed
     */
    public function addArticle($articleData){
        $articleData['content'] = replaceHost2Tag($articleData['content']);
        return $this->add($articleData);
    }

    /**
     * 删除文章
     * @param $aid 文章ID
     */
    public function deleteArticle($aid){
        $this->where(array('id' => $aid))->delete();
        // 评论
        $this->table('__COMMENT__')->where(array('article_id' => $aid))->delete();
        // 标签
        $this->table('__ARTICLE_TAG__')->where(array('aid' => $aid))->delete();
        // 附件
        $this->table('__FILE__')->where(array('article_id' => $aid))->delete();
    }

    /**
     * 更新文章内容
     * @param $aid 文章ID
     * @param $data 文章数据
     * @return bool 是否成功
     */
    public function updateArticle($aid, $articleData) {
        $articleData['content'] = replaceHost2Tag($articleData['content']);
        return $this->where(array('id' => $aid))->setField($articleData);
    }

    /**
     * 首页获取文章列表
     * @param mixed $condition 条件表达式
     * @return array
     */
    public function getArticlesByHome($condition = array()){
        $this->where(array_merge($condition, array('is_draft' => 'n', 'type' => 'blog')));
        $count = count(BlogCache::getInstance()->readCache('allArticle'));
        $Page = new \Think\Page($count, C('index_article_num'), '', 'page');
        foreach($condition as $key => $val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $data['articles'] = $this->field('id, user_id, title, category, excerpt, is_top, comment_num, view_num, post_time')
                                 ->order('is_top desc, post_time desc')
                                 ->limit($Page->firstRow . ',' . $Page->listRows)
                                 ->select();
        $data['page'] = $Page->show();
        return $data;
    }

    public function getArticlesByAdmin(){
        $articles = $this->field('id, user_id, title, category, excerpt, is_top, comment_num, view_num, post_time')
                         ->where(array('is_draft' => 'n', 'type' => 'blog'))
                        ->order('post_time desc')
                        ->select();
        return $articles;
    }

    /**
     * 根据分类别名获取文章列表
     * @param $alias 分类别名
     * @return array
     */
    public function getArticlesByCate($alias){
        $count = $this->table('__ARTICLE__ as Article, __CATEGORY__ as Category')
                                ->where('Article.category = Category.id and Article.is_draft = "n" and Article.type = "blog" and Category.alias = "' . $alias. '"')
                                ->count();
        $Page = new \Think\Page($count, C('index_article_num'), '', 'category/' . $alias . '/p');
        $data['articles'] = $this->table('__ARTICLE__ as Article, __CATEGORY__ as Category')
                            ->where('Article.category = Category.id and Article.is_draft = "n" and Article.type = "blog" and Category.alias = "' . $alias. '"')
                            ->field('Article.id, Article.title, Article.user_id, Article.category, Article.excerpt, Article.comment_num, Article.view_num, Article.post_time')
                            ->limit($Page->firstRow . ', ' . $Page->listRows)
                            ->order('post_time desc')
                            ->select();
        $data['page'] = $Page->show();
        return $data;
    }

    /**
     * 根据作者ID获取文章列表
     * @param $uid 作者ID
     * @return array
     */
    public function getArticlesByAuthor($uid){
        $condition = array('user_id' => $uid, 'is_draft' => 'n', 'type' => 'blog');
        $count = $this->where($condition)->count();
        $Page = new \Think\Page($count,  C('index_article_num'), '', 'author/' . $uid . '/p');
        $data['articles'] = $this->where($condition)
                         ->field('id, user_id, title, category, excerpt, comment_num, view_num, post_time')
                         ->limit($Page->firstRow . ', ' . $Page->listRows)
                         ->order('post_time desc')
                         ->select();
        $data['page'] = $Page->show();
        return $data;
    }

    /**
     * 根据标签名获取文章列表
     * @param $tag 标签名
     * @return array
     */
    public function getArticlesByTag($tag){
        $count = $this->table('__TAG__ as Tag, __ARTICLE_TAG__ as ArticleTag, __ARTICLE__ as Article')
                    ->where('Tag.id = ArticleTag.tid and ArticleTag.aid = Article.id and Article.is_draft = "n" and Article.type = "blog" and Tag.name = "' . $tag . '"')
                    ->count();
        $Page = new \Think\Page($count,  C('index_article_num'), '', 'tag/' . $tag . '/p');
        $data['articles'] = $this->table('__TAG__ as Tag, __ARTICLE_TAG__ as ArticleTag, __ARTICLE__ as Article')
                       ->field('Article.id, Article.user_id, Article.title, Article.category, Article.excerpt, Article.comment_num, Article.view_num, Article.post_time')
                       ->where('Tag.id = ArticleTag.tid and ArticleTag.aid = Article.id and Article.is_draft = "n" and Article.type = "blog" and Tag.name = "' . $tag . '"')
                       ->limit($Page->firstRow . ', ' . $Page->listRows)
                       ->order('post_time desc')
                       ->select();
        $data['page'] = $Page->show();
        return $data;
    }

    /**
     * 根据标签ID获取文章列表
     * @param $tagId 标签ID
     * @return mixed
     */
    public function getDraftsByTag($tagId){
        $draftList = $this->table('__TAG__ as Tag, __ARTICLE_TAG__ as ArticleTag, __ARTICLE__ as Article')
                          ->field('Article.id, Article.title')
                          ->where('Tag.id = ArticleTag.tid and ArticleTag.aid = Article.id and Article.is_draft = "y" and Article.type = "blog" and Tag.id = "' . $tagId . '"')
                          ->order('post_time desc')
                          ->select();
        return $draftList;
    }

    /**
     * 根据表达式获取文章
     * @param array $condition 条件表达式
     * @return mixed
     */
    public function getArticles($condition = array()){
        $articles = $this->where($condition)->select();
        return $articles;
    }

    /**
     * 获取单篇文章
     * @param $aid 文章ID
     * @return mixed
     */
    public function getOneArticle($aid){
        $article = $this->field('id, user_id, title, category, excerpt, content, comment_num, view_num, open_comment, post_time')->where(array('id' => $aid))->find();
        return $article;
    }

    /**
     * 判断是否重复
     * @param $title 文章标题
     * @return bool|int
     */
    function isRepeatPost($title) {
        $article = $this->where(array('title' => $title))->find();
        return isset($article['id']) ? (int)$article['id'] : false;
    }


}