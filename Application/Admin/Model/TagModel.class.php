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
use Think\Model;

/**
 * 标签模型
 * @package Admin\Model
 */
class TagModel extends Model{
    /**
     * 根据文章ID获取标签
     * @param int $aid 文章ID
     * @return array
     */
    public function getTag($aid) {
        $tags = M()->table('__TAG__ as Tag, __ARTICLE_TAG__ as ArticleTag, __ARTICLE__ as Article')
                   ->field('Tag.id as id, Tag.name as name')
                   ->where('Tag.id = ArticleTag.tid and ArticleTag.aid = Article.id and Article.type = "blog" and Article.id = "' . $aid . '"')
                   ->select();
        return $tags;
    }

    /**
     * 根据标签ID获取标签
     * @param $tid
     * @return array
     */
    public function getOneTag($tid) {
        $tag = array();
        $row = $this->where(array('id' => $tid))->find();
        $tag['name'] = htmlspecialchars(trim($row['name']));
        $tag['id'] = intval($row['id']);
        return $tag;
    }

    /**
     * 添加文章标签
     * @param int $aid 文章ID
     * @param string $tagStr 标签
     */
    function addTag($aid, $tagStr){
        $tagArr = array_filter(explode(',', $tagStr));
        $Tag = M('Tag');
        $ArticleTag = M('Article_tag');
        $allTag = $Tag->getField('id,name',true);
        foreach ($tagArr as $name){
            if (in_array($name, $allTag)){
                foreach ($allTag as $k => $v){
                    if ($name == $v) {
                        if (!($ArticleTag->where(array('aid' => $aid, 'tid' => $k))->find())) {
                            $ArticleTag->add(array('aid' => $aid, 'tid' => $k));
                        }
                    }
                }
            }else{
                $tid = $Tag->add(array('name' => $name));
                if (!($ArticleTag->where(array('aid' => $aid, 'tid' => $tid))->find())) {
                    $ArticleTag->add(array('aid' => $aid, 'tid' => $tid));
                }
            }
        }
    }

    /**
     * 修改标签名称
     * @param $tid 标签ID
     * @param $name 新的标签名
     * @return bool
     */
    function updateTagName($tid, $name) {
        return $this->where(array('id' => $tid))->setField('name', $name);
    }

    /**
     * 删除标签
     * @param $tid
     */
    function deleteTag($tid) {
        $this->where(array('id' => $tid))->delete();
        M('Article_tag')->where(array('tid' => $tid))->delete();
    }
}