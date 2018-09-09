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
 * 评论模型
 * @package Admin\Model
 */
class CommentModel extends Model{

    /**
     * 获取评论列表
     * @param $aid 文章ID
     * @return mixed
     */
    public function getComments($aid){
        $comments = $this->field('id, parent_id, name, content, email, url, post_time')
                         ->where(array('article_id' => $aid, 'is_hide' => 'n', 'parent_id' => 0))
                         ->order('post_time asc')
                         ->select();
        foreach ($comments as $k => &$v){
            $v['children'] = $this->getChildComments($v['id']);
            $v['i'] = $k + 1;
        }
        if (C('comment_order') == 'new'){
            $comments = array_reverse($comments, true);
        }
        return $comments;
    }

    /**
     * 获取父级ID下的所有评论
     * @param $pid 父级ID
     * @return array
     */
    public function getChildComments($pid){
        $comments = $this->field('id, parent_id, name, content,email, url, post_time')->where(array('is_hide' => 'n', 'parent_id' => $pid))->order('post_time asc')->select();
        $arr = array();
        if($comments){
            foreach ($comments as $v){
                $arr = $this->getChildComments($v['id']);
            }
        }
        return array_filter(array_merge($comments, $arr));
    }

    /**
     * 获取一条评论
     * @param $cid 评论ID
     * @return mixed
     */
    public function getOneComment($cid){
        return $this->where(array('id' => $cid))->find();
    }

    /**
     * 更新评论
     * @param $cid 评论ID
     * @param $commData 评论数据
     * @return bool
     */
    public function updateComment($cid, $commData){
        return $this->where(array('id' => $cid))->setField($commData);
    }

    /**
     * 删除评论
     * @param $cid 评论ID
     */
    public function deleteComment($cid){
        $this->where(array('parent_id' => $cid))->setField('parent_id', 0);
        $this->where(array('id' => $cid))->delete();
    }

    public function addComment($commData){
        return $this->add($commData);
    }
}
