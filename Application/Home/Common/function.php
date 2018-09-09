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

/**
 * 热门文章
 * @param int $num 文章数量
 * @return mixed
 */
function getHotArticle($num = 6){
//    $articles = M('Article')->where(array('is_draft' => 'n', 'type' => 'blog'))->field('id, title, post_time')->order('view_num desc, comment_num')->limit($num)->select();
    $articles = \Org\Util\BlogCache::getInstance()->readCache('hotArticle');
    return $articles;
}

/**
 * 标签列表
 * @param int $num 数量
 * @return mixed
 */
function getTagList($num = 24){
//    $tags = M('Tag')->field('id, name')->limit($num)->select();
    $tags = \Org\Util\BlogCache::getInstance()->readCache('tag');
    return $tags;
}

/**
 * 最新评论
 * @param int $num 评论数量
 * @return mixed
 */
function getNewComment($num = 10){
//    $comments = M('Comment')->where(array('is_hide' => 'n'))->field('id, article_id, parent_id, name, email, content')->order('post_time desc')->limit($num)->select();
//    for ($i = 0; $i < count($comments); $i++) {
//        if ($comments[$i]['parent_id'] != 0) {
//            $comments[$i]['replyName'] = getReplyName($comments[$i]['parent_id']);
//        }
//    }
    $comments = \Org\Util\BlogCache::getInstance()->readCache('comment');
    return $comments;
}

/**
 * 获取所有分类
 * @return mixed
 */
function getAllCategory(){
    $category = \Org\Util\BlogCache::getInstance()->readCache('category');
    return  $category;
}

/**
 * 获取文章中的一张图片
 * @param $aid 文章ID
 * @return string 图片完整路径
 */
function getArticleOneImg($aid){
    $file = \Org\Util\BlogCache::getInstance()->readCache('articleFile');
    if (!empty($file[$aid]['save_path'])){
        return C('blog_url') . $file[$aid]['save_path'];
    }else{
        //TODO 改为匹配文章中的html标签
        $files = M('File')->where(array('article_id' => $aid))->getField('save_path');
        if ($files) {
            return $files;
        }else{
            $fileName =  rand(1, 20) . '.jpg';
            $url = '/Uploads/Random/' . $fileName;
            M('File')->add(array('article_id' => $aid,
                'user_id' => cookie('uid'),
                'name' => $fileName,
                'size' => 0,
                'mime' => 0,
                'save_path' =>  $url,
                'post_time' => time()));
            return C('blog_url') . $url;
        }
    }
}

/**
 * 获取友情链接
 * @return mixed
 */
function getLink(){
    $links = \Org\Util\BlogCache::getInstance()->readCache('link');
    return $links;
}

/**
 * 获取文章标题
 * @param $aid 文章ID
 * @return mixed
 */
function getArticleTitle($aid){
//    $title = M('Article')->where(array('id' => $aid))->getField('title');
    $article = \Org\Util\BlogCache::getInstance()->readCache('allArticle');
    return $article[$aid]['title'];
}

/**
 * 获取文章标签
 * @param $aid 文章ID
 * @return mixed 标签数组
 */
function getArticleTag($aid){
//    $tags = M()->table('__ARTICLE_TAG__ as ArticleTag, __TAG__ as Tag')
//               ->field('Tag.id, Tag.name')
//               ->where('ArticleTag.tid = Tag.id and ArticleTag.aid = ' . $aid)
//               ->select();
    $tags = \Org\Util\BlogCache::getInstance()->readCache('articleTag');
    return $tags[$aid];
}


/**
 * 获取上一篇文章
 * @param $date 文章发布时间
 * @return string html字符串
 */
function getPrevArticle($date){
    $htmlStr = '';
    $article = M('Article')->field('id, title, post_time')->where(array('post_time' => array('gt', $date), 'is_draft' => 'n', 'type' => 'blog'))->order('post_time asc')->find();
    if ($article){
        $htmlStr = '<a href="' . articleUrl($article['id']) . '" title="' . $article['title'] . '"><span>上一篇</span>' . $article['title'] . '</a>';
    }else{
        $htmlStr = '<a title="没错这就是本分类第一篇文章"><span>上一篇</span>这就是第一篇了</a>';
    }
    return $htmlStr;
}

/**
 * 获取下一篇文章
 * @param $date 文章发布时间
 * @return string html字符串
 */
function getNextArticle($date){
    $htmlStr = '';
    $article = M('Article')->field('id, title')->where(array('post_time' => array('lt', $date), 'is_draft' => 'n', 'type' => 'blog'))->find();
    if ($article){
        $htmlStr = '<a href="' . articleUrl($article['id']) . '" title="' . $article['title'] . '"><span>下一篇</span>' . $article['title'] . '</a>';
    }else{
        $htmlStr = ' <a title="没错这就是本分类最后一篇文章"><span>下一篇</span>这就是最后一篇了</a>';
    }
    return $htmlStr;
}

/**
 * 获取访客Cookie信息
 * @param $info
 * @return mixed
 */
function getVisitor($info){
    return cookie('visitor_' . $info);
}

/**
 * 获取评论列表
 * @param $aid 文章ID
 * @return array 评论列表
 */
function getCommentList($aid){
    return D('Admin/Comment')->getComments($aid);
}

/**
 * 获取文章评论数量
 * @param $aid 文章ID
 * @return int 评论数量
 */
function getCommentNum($aid){
    $commNum = M('Comment')->where(array('article_id' => $aid))->count();
    return $commNum;
}

/**
 * 获取用户头像
 * @param $uid 用户id
 * @return mixed
 */
function getUserHead($uid){
    $user = \Org\Util\BlogCache::getInstance()->readCache('user');
    return $user[$uid]['head'];
}