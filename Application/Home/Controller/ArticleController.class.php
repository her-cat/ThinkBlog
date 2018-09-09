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
use Org\Util\Tools;
use Org\Util\BlogCache;

class ArticleController extends CommonController {
    /**
     * 文章内容页面
     */
    public function index(){
        $aid =  I('get.aid', '');
        if (!empty($aid) && isArticleExist($aid)){
            $Article = D('Admin/Article');
            $this->assign('article', $Article->getOneArticle($aid));
            $Article->addViewCount($aid);
            $this->display();
        }else{
            $this->_empty();
        }
    }

    /**
     * 发布评论
     */
    public function addComment(){
        if (IS_POST){
            //{"isAjax":"true",
            //"postId":"30",
            //"name":"\u8bbf\u5ba2",
            //"email":"125803425@qq.com",
            //"content":"\u4e0d\u9519\u54e6",
            //"homepage":"",
            //"replyId":"0",
            //"token":"9574d42558d3ec6f3b4a691c321bffef"}
            $post = I('post.');
            if ($post['isAjax'] == true){
                $Comment = M('Comment');
                if (!preg_match("/^\d+$/", $post['postId'])){
                    exit(json_encode(array('state' => '101', 'msg' => '文章不存在！')));
                }
                if ($post['name'] == ''){
                    exit(json_encode(array('state' => '102', 'msg' => '昵称不能为空或格式不正确！')));
                }
                $user = D('Admin/User')->getOneUser(1);
                if ($post['name'] == $user['nickname'] || $post['name'] == $user['nickname']. '博客' && !Tools::isLogin()){
                    exit(json_encode(array('state' => '107', 'msg' => '不能冒用他人昵称！')));
                }
                if ($post['content'] == ''){
                    exit(json_encode(array('state' => '103', 'msg' => '评论内容不能为空或过长！')));
                }
                if ($post['email'] == '' && !preg_match("/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $post['email'])){
                    exit(json_encode(array('state' => '104', 'msg' => '邮箱格式不正确，可能过长或为空！')));
                }
                if ($post['token'] != session('comment_key')){
                    exit(json_encode(array('state' => '105', 'msg' => '请刷新页面后重新提交！')));
                }
                $isPost = $Comment->where(array('ip' => get_client_ip(), 'post_time' => array('gt', time() - C('comment_interval'))))->getField('id');
                if ($isPost){
                    exit(json_encode(array('state' => '106', 'msg' => '您评论的太快了,评论间隔必须大于30秒！')));
                }
                //TODO 发送邮件提醒
                if (Tools::isLogin()){
                    $post['user_id'] = cookie('uid');
                }
                if (!isset($post['url'])){
                    $post['url'] = '#';
                }
                $post['article_id'] = $post['postId'];
                $post['parent_id'] = $post['replyId'];
                $post['post_time'] = time();
                $post['ip'] = get_client_ip();
                $result = $Comment->add($post);
                if ($result){
                    D('Admin/Article')->addCommentCount($post['postId']);
                    BlogCache::getInstance()->updateCache('comment');
                    $post['cid'] = $result;
                    $post['aid'] = $post['postId'];
                    $post['pid'] = $post['replyId'];
                    isset($post['email']) && sendEmailTip($post);
                    $msg = array('state' => '100',
                                 'cid' => $result,
                                 'replyId' => $post['replyId'],
                                 'replyName' => getReplyName($post['replyId']),
                                 'nickname' => $post['name'],
                                 'headImg' => getGravatar($post['email']),
                                 'url' => $post['url'],
                                 'add_time' => date('Y-m-d H:i:s', $post['post_time']),
                                 'content' => $post['content']);
                    exit(json_encode($msg));
                }else{
                    exit(json_encode(array('state' => '106', 'msg' => '系统出错，请重新提交！')));
                }
            }else{
                $this->_empty();
            }
        }else{
            $this->_empty();
        }
    }

    /**
     * 获取评论TOKEN
     */
    function getCommToken(){
        if (IS_POST){
            $token['key'] = md5(time() . C('SITE_KEY'));
            session('comment_key', $token['key']);
            exit($token['key']);
        }else{
            $this->_empty();
        }
    }
}