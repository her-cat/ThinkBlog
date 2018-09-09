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

namespace Home\Controller;
use Home\Controller\CommonController;
use Org\Util\BlogCache;
use Think\Core_Lib_Page;

/**
 * ThinkBlog 前台首页
 */
class IndexController extends CommonController {
    /**
     * 首页
     */
    public function index(){
        $Article = D('Admin/Article');
        $keywords = I('get.keyword');
        $condition['is_draft'] = array('eq', 'n');
        $params = array();
        if ($keywords != ''){
            $condition['title|content'] = array('like', '%' . $keywords . '%');
            $params = array('name' => 'keyword', 'value' => $keywords);
        }
        $data = $Article->getArticlesByHome($condition);
        $this->assign('params', $params);
        $this->assign('page', $data['page']);
        $this->assign('articleList', $data['articles']);
        $this->display();
    }

    /**
     * 分类文章列表页面
     */
    public function category(){
        $alias =  I('get.alias');
            if ($alias != '' && isCategoryExist($alias)){
                $Article = D('Admin/Article');
                $data = $Article->getArticlesByCate($alias);
                $this->assign('params', array('name' => 'category', 'value' => getCategoryName($alias)));
                $this->assign('articleList', $data['articles']);
                $this->assign("page", $data['page']);
                $this->display('Index/other');
        }else{
            $this->_empty();
        }
    }

    /**
     * 作者页面
     */
    public function author(){
        $uid = isset($_GET['uid']) ? I('get.uid') : '';
        if (!empty($uid)){
            $Article = D('Admin/Article');
            $data = $Article->getArticlesByAuthor($uid);
            $this->assign('params', array('name' => 'author', 'value' => getAuthorName($uid)));
            $this->assign('articleList', $data['articles']);
            $this->assign('page', $data['page']);
            $this->display('Index/other');
        }else{
            $this->_empty();
        }
    }

    /**
     * 标签页面
     */
    public function tag(){
        $tag = isset($_GET['tag']) ? I('get.tag') : '';
        if (!empty($tag)){
            $Article = D('Admin/Article');
            $data = $Article->getArticlesByTag($tag);
            $this->assign('params', array('name' => 'tag', 'value' => $tag));
            $this->assign('articleList', $data['articles']);
            $this->assign('page', $data['page']);
            $this->display('Index/other');
        }else{
            $this->_empty();
        }
    }

    /**
     * RSS输出
     */
    public function rss(){
        header('Content-type: application/xml');
        echo '<?xml version="1.0" encoding="utf-8"?>
                <rss version="2.0">
                <channel>
                <title>'.C('BLOG_NAME').'</title> 
                <description>'.C('BLOG_INFO').'</description>
                <link>' . C('BLOG_URL') . '</link>
                <language>zh-cn</language>
                <generator>www.hexianghui.net</generator>';
        $articles = $this->getArticles();
        if (!empty($articles)) {
            foreach($articles as $value){
                $link = articleUrl($value['id']);
                $pubdate =  gmdate('r',$value['post_time']);
                echo <<< END
                    <item>
                        <title>{$value['title']}</title>
                        <link>{$link}</link>
                        <description>{$value['content']}</description>
                        <pubDate>{$pubdate}</pubDate>
                    </item>
END;
            }
        }
        echo <<< END
            </channel>
        </rss>
END;

    }

    /**
     * 获取文章信息
     *
     * @return array
     */
    private function getArticles() {
        $outNum = C('rss_output_num');
        if ($outNum == 0) {
            return array();
        }
        $res = M('Article')->field('id, title, excerpt, content, post_time')->where(array('type' => 'blog', 'is_draft' => 'n'))->order('post_time desc')->limit('0, ' . $outNum)->select();
        $articles = array();
        foreach ($res as $key => $value){
            if(C('RSS_OUTPUT_FULL_TEXT') == 'n')
            {
                if (!empty($value['excerpt'])) {
                    $value['content'] = $value['excerpt'];
                }else {
                    $value['content'] = extractHtmlData($value['content'], 330);
                }
                $value['content'] .= ' <a href="' . articleUrl($value['id']) . '">阅读全文&gt;&gt;</a>';
            }
            $value['content'] = htmlspecialchars(replaceTag2Host($value['content']));
            $articles[] = $value;
        }
        return $articles;
    }
}