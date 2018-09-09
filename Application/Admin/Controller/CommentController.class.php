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
use Org\Util\BlogCache;

/**
 * 评论模块
 * @package Admin\Controller
 */
class CommentController extends CommonController{
    public function commentList(){
        if(IS_POST){
            $post = I('post.');
            $Comment = D('Comment');
            $Article = D('Article');
            if ($post['operate'] == 'del') {
                foreach ($post['cid'] as $id) {
                    $com = $Comment->getOneComment($id);
                    $Article->reduceCommentCount($com['article_id']);
                    $Comment->deleteComment($id);
                }
                self::updateCache(array('sta', 'comment'));
                $this->success('删除成功！', U('Comment/commentList'));
            }else if ($post['operate'] == 'hide' || $post['operate'] == 'show') {
                foreach ($post['cid'] as $id) {
                    $Comment->updateComment($id, array('is_hide' => ($post['operate'] == 'show') ? 'n' : 'y'));
                }
                self::updateCache(array('sta', 'comment'));
                $this->success('删除成功！', U('Comment/commentList'));
            }else{
                $this->redirect('Comment/commentList');
            }
        }else{
            $hide = I('get.hide');
            $condition = array();
            ($hide == 'y') && $condition['is_hide'] = 'y';
            ($hide == 'n') && $condition['is_hide'] = 'n';
            $Comment = M('Comment');
            $sta = self::$Cache->readCache('sta');
            $count = $Comment->where($condition)->count();
            $Page = new \Think\Page($count, 20);
            $comments = $Comment->field('id, parent_id, article_id, name, content, is_hide, post_time')->where($condition)->limit($Page->firstRow . ', ' . $Page->listRows)->order('post_time desc')->select();
            $this->assign('page', $Page->show());
            $this->assign('hideNum', $sta['hideComm']);
            $this->assign('commentList', $comments);
            $this->display();
        }
    }

    /**
     * 编辑评论
     */
    public function editComment(){
        if(IS_POST){
            $post = I('post.');
            if (empty($post['name'])) { $this->error('评论人不能为空！'); }
            if (empty($post['content'])) { $this->error('评论内容不能为空！'); }
            D('Comment')->updateComment($post['cid'], $post);
            self::$Cache->updateCache('comment');
            $this->success('修改成功！', U('Comment/commentList'));
        }else{
            $cid = isset($_GET['cid']) ? I('get.cid') : '';
            if (!empty($cid)) {
                $comment = D('Comment')->getOneComment($cid);
                if($comment) {
                    $this->assign('comment', $comment);
                    $this->display();
                }else{
                    $this->error('不存在该评论！');
                }
            }else{
                $this->redirect('Comment/commentList');
            }
        }
    }

    /**
     * 回复评论
     */
    public function replyComment(){
        if(IS_POST){
            $post = I('post.');
            if (empty($post['content'])) { $this->error('回复内容不能为空！'); }
            //TODO 待修改
            $user = M('User')->where(array('id' => cookie('uid')))->find();
            $post['parent_id'] = $post['cid'];
            $post['user_id'] = cookie('uid');
            $post['name'] = $user['nickname'];
            $post['url'] = C('blog_url');
            $post['email'] = $user['email'];
            $post['ip'] = get_client_ip();
            $post['post_time'] = time();
            $result = D('Comment')->addComment($post);
            if ($result) {
                D('Admin/Article')->addCommentCount($post['article_id']);
                $post['cid'] = $result;
                $post['aid'] = $post['article_id'];
                $post['pid'] = $post['parent_id'];
                sendEmailTip($post);
                self::$Cache->updateCache(array('sta', 'comment'));
                $this->success('回复成功！', U('Comment/commentList'));
            }else{
                $this->error('回复失败！');
            }
        }else{
            $cid = I('get.cid', '');
            if (!empty($cid)) {
                $comment = D('Comment')->getOneComment($cid);
                if($comment) {
                    $this->assign('comment', $comment);
                    $this->display();
                }else{
                    $this->error('不存在该评论！');
                }
            }else{
                $this->redirect('Comment/commentList');
            }
        }
    }

    /**
     * 删除评论
     */
    public function deleteComment(){
        $cid = I('get.cid', '');
        if (!empty($cid)) {
            $Comment = D('Comment');
            $com = $Comment->getOneComment($cid);
            D('Article')->reduceCommentCount($com['article_id']);
            $Comment->deleteComment($cid);
            self::$Cache->updateCache(array('sta', 'comment'));
            $this->success('删除成功！', U('Comment/commentList'));
        }else{
            $this->redirect('Comment/commentList');
        }
    }

    /**
     * 更新评论状态
     */
    public function updateComment(){
        $cid = I('get.cid', '');
        $action = I('get.action', '');
        if (!empty($cid) && !empty($action)) {
            D('Comment')->updateComment($cid, array('is_hide' => ($action == 'show') ? 'n' : 'y'));
            self::$Cache->updateCache(array('sta', 'comment'));
            $this->success('操作成功！', U('Comment/commentList'));
        } else {
            $this->redirect('Comment/commentList');
        }
    }


}

