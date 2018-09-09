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
 * 生成文章URL地址
 * @param $aid 文章ID
 * @return string 文章URL
 */
function articleUrl($aid){
//    $alias = M()->table('__ARTICLE__ as Article, __CATEGORY__ as Category')
//                ->field('Category.alias as name')
//                ->where('Article.category = Category.id and Article.id = ' . $aid)
//                ->find();
    $cacheData = \Org\Util\BlogCache::getInstance()->readCache('articleCategory');
    $alias = isset($cacheData[$aid]['alias']) ? $cacheData[$aid]['alias'] : 'post';
    $url = C('blog_url') . '/' . $alias . '/' . $aid . '.html';
    return $url;
}

/**
 * 生成分类URL地址
 * @param $cid 分类ID
 * @return string 分类URL
 */
function categoryUrl($cid){
    $url = C('blog_url') . '/category/' . getCategoryAlias($cid);
    return $url;
}

/**
 * 生成作者URL地址
 * @param $uid 用户ID
 * @return string 作者URL
 */
function authorUrl($uid){
    $url = C('blog_url') . '/author/' . $uid;
    return $url;
}

/**
 * 生成标签URL地址
 * @param $tagName 标签ID
 * @return string 标签URL
 */
function tagUrl($tagName){
    $url = C('blog_url') . '/tag/' . $tagName;
    return $url;
}

/**
 * 获取文章数量
 * @param null $type 类型
 * @return int 文章数量
 */
function getArticleCount($type = null){
    $condition = array();
    if ($type == 'draft'){
        $condition['is_draft'] = array('eq', 'y');
    }elseif ($type == 'top'){
        $condition['is_top'] = array('eq', 'y');
    }else{
        $condition['is_draft'] = array('eq', 'n');
    }
    $count = M('Article')->where($condition)->count();
    return $count;
}


/**
 * 获取数据数量
 * @param string $type 表名
 * @return int 数量
 */
function getCount($type = 'comment'){
    $tableModel = '';
    if ($type == 'comment') {
        $tableModel = M('Comment');
    }elseif ($type == 'category'){
        $tableModel = M('Category');
    } elseif ($type == 'tag') {
        $tableModel = M('Tag');
    }elseif($type == 'File'){
        $tableModel = M('File');
    }else{
        $tableModel = M('Link');
    }
    return $tableModel->count();
}

/**
 * 验证email地址格式
 * @param $email 电子邮箱地址
 * @return bool 是否正确
 */
function checkMail($email) {
    if (preg_match("/^[\w\.\-]+@\w+([\.\-]\w+)*\.\w+$/", $email) && strlen($email) <= 60) {
        return true;
    } else {
        return false;
    }
}

/**
 * 检测登录名是否存在
 * @param $name 登录名
 * @param $id 用户ID
 * @return bool 是否存在
 */
function isUserExist($name, $id){
    $map['name'] = array('eq', $name);
    $map['id'] = array('neq', $id);
    $isExist = M('User')->where($map)->count();
    return ($isExist > 0);
}

/**
 * 检测昵称是否存在
 * @param $nickname 昵称
 * @param $id 用户ID
 * @return bool 是否存在
 */
function isNicknameExist($nickname, $id){
    $map['nickname'] = array('eq', $nickname);
    $map['id'] = array('neq', $id);
    $isExist = M('User')->where($map)->count();
    return ($isExist > 0);
}

/**
 * 检测分类是否存在
 * @param $alias 分类别名
 * @return bool 是否存在
 */
function isCategoryExist($alias){
    $isExist = M('Category')->where(array('alias' => $alias))->count();
    return ($isExist > 0);
}

/**
 * 检测文章是否存在
 * @param $aid 文章ID
 * @return bool 是否存在
 */
function isArticleExist($aid){
//    $isExist = M('Article')->where(array('id' => $aid))->count();
    $article = \Org\Util\BlogCache::getInstance()->readCache('allArticle');
    return isset($article[$aid]['id']) ? true : false;
}

/**
 * 获取作者姓名
 * @param $uid 用户ID
 * @return mixed 用户名
 */
function getAuthorName($uid){
//    $author = M('User')->where(array('id' => $uid))->getField('nickname');
    $author = \Org\Util\BlogCache::getInstance()->readCache('user');
    return $author[$uid]['nickname'];
}

/**
 * 获取分类名称
 * @param Int $cid 分类ID OR 分类别名
 * @return String 分类名
 */
function getCategoryName($cid){
//    $map = array();
//    if (is_numeric($cid)){
//        $map['id'] = $cid;
//    }else{
//        $map['alias'] = $cid;
//    }
//    $categoryName = M('Category')->where($map)->getField('name');
//    if ($categoryName) {
//        return $categoryName;
//    } else {
//        return '未分类';
//    }
    $cacheData = \Org\Util\BlogCache::getInstance()->readCache('category');
    if (is_numeric($cid)){
        return isset($cacheData[$cid]['name']) ? $cacheData[$cid]['name'] : '未分类';
    }else{
        foreach ($cacheData as $v){
            if ($v['alias'] == $cid){
                return $v['name'];
            }
        }
    }
    return '未分类';
}

/**
 * 获取分类别名
 * @param $cid 分类ID
 * @return mixed 分类别名
 */
function getCategoryAlias($cid){
//    $categoryAlias = M('Category')->where(array('id' => $cid))->getField('alias');
//    if ($categoryAlias) {
//        return $categoryAlias;
//    }
    $cacheData = \Org\Util\BlogCache::getInstance()->readCache('category');
    return isset($cacheData[$cid]['alias']) ? $cacheData[$cid]['alias'] : 'post';
}

/**
 * 使用递归获取分类列表
 * @param $id 父级ID
 * @return array 分类列表
 */
function getCategoryList($id){
    $category = M('Category')->where(array('parent_id' => $id))->select();
    $Article = M('Article');
    $categoryList = array();
    if($category){
        foreach ($category as $k => $v){
            $v['children'] = getCategoryList($v['id']);
            $v['logNum'] = $Article->where(array('category' => $v['id'], 'is_draft' => 'n'))->count();
            $categoryList[] = $v;
        }
        return $categoryList;
    }else{
        return $categoryList;
    }
}

/**
 * 使用递归获取导航列表
 * @param $id 父级ID
 * @return array 导航列表
 */
function getNavList($id){
//    $nav = M('Nav')->where(array('parent_id' => $id))->order('taxis asc')->select();
//    $navList = array();
//    if($nav){
//        foreach ($nav as $k => $v){
//            $v['children'] = getNavList($v['id']);
//            $navList[] = $v;
//        }
//        return $navList;
//    }else{
//        return $navList;
//    }
    $navList = \Org\Util\BlogCache::getInstance()->readCache('nav');
    return $navList;
}


/**
 * 获取子级数量
 * @param $type 表名
 * @param $pid 父级ID
 * @return int 数量
 */
function getChildrenNum($type, $pid){
    $model = '';
    if ($type == 'nav'){
        $model = M('Nav');
    }else{
        $model = M('Category');
    }
    $count = $model->where(array('parent_id' => $pid))->count();
    return $count;
}

/**
 * 去除文章中的HTML标签
 * @param $data 文章内容
 * @return string 去除后的内容
 */
function extractHtml($data) {
    $data = strip_tags(htmlspecialchars_decode($data));
    $search = array("/([\r\n])[\s]+/", // 去掉空白字符
        "/&(quot|#34);/i", // 替换 HTML 实体
        "/&(amp|#38);/i",
        "/&(lt|#60);/i",
        "/&(gt|#62);/i",
        "/&(nbsp|#160);/i",
        "/&(iexcl|#161);/i",
        "/&(cent|#162);/i",
        "/&(pound|#163);/i",
        "/&(copy|#169);/i",
        "/\"/i",
    );
    $replace = array(" ", "\"", "&", " ", " ", "", chr(161), chr(162), chr(163), chr(169), "");
    $data = trim(preg_replace($search, $replace, $data));
    return $data;
}

/**
 * 获取文章标签字符串
 * @param int $aid 文章ID
 * @return string 标签字符串
 */
function getTagStr($aid){
    $tagStr = "";
    $allTag = M()->table('__TAG__ as Tag, __ARTICLE_TAG__ as ArticleTag')
        ->field('Tag.name')
        ->where('Tag.id = ArticleTag.tid and ArticleTag.aid = ' . $aid)
        ->select();
    for ($i = 0; $i < count($allTag); $i++){
        $tagStr .= $allTag[$i]['name'];
        if ($i + 1 != count($allTag)){
            $tagStr .=  ',';
        }
    }
    return $tagStr;
}

/**
 * 获取Gravatar头像
 * @link http://en.gravatar.com/site/implement/images/
 * @param $email
 * @param int $s
 * @param string $d
 * @param string $g
 * @return string
 */
function getGravatar($email, $s = 64, $d = 'mm', $g = 'g') {
    $hash = md5(strtolower(trim($email)));
//    $avatar = "https://cdn.v2ex.com/gravatar/$hash.png?s=$s&d=$d&r=$g";
    $avatar = "https://cn.gravatar.com/avatar/$hash?s=$s";
    return $avatar;
}

/**
 * 获取回复人用户名
 * @param $cid 评论ID
 * @return mixed 用户名
 */
function getReplyName($cid){
    $name = M('Comment')->where(array('id' => $cid))->getField('name');
    return $name;
}

function SendMail($address,$title,$message){
    $mail=new Org\Net\PHPMailer();
// 设置PHPMailer使用SMTP服务器发送Email
    $mail->IsSMTP();
// 设置邮件的字符编码，若不指定，则为'UTF-8'
    $mail->CharSet='UTF-8';
// 添加收件人地址，可以多次使用来添加多个收件人
    $mail->AddAddress($address);
// 设置邮件正文
    $mail->Body=$message;
// 设置邮件头的From字段。
    $mail->From = C('MAIL_USER');
// 设置发件人名字
    $mail->FromName = '何湘辉博客';
// 设置邮件标题
    $mail->Subject=$title;
// 设置SMTP服务器。
    $mail->Host=C('MAIL_SMTP');
// 设置为“需要验证”
    $mail->SMTPAuth=true;
// 设置用户名和密码。
    $mail->Username=C('MAIL_USER');
    $mail->Password=C('MAIL_PWD');
// 发送邮件。
    $mail->IsHTML(true);
    return($mail->Send());
}

function sendEmailTip($data){
    $articleTitle = M('Article')->where(array('id' => $data['aid']))->getField('title');
    $comm = M('Comment')->where(array('id' => $data['pid']))->find();
    $subject = "文章《{$articleTitle}》收到了新的评论";
    $content = '<table cellpadding="0" cellspacing="0" style="font-family: 微软雅黑,verdana, arial; margin: 0 auto; width: 100%;">
                    <tbody>
                        <tr>
                            <td style="background: #08c; color: #fff; font-family: 微软雅黑,verdana, arial; font-size:15px;line-height: 50px;"><strong>  文章《' . $articleTitle . '》收到了新的评论：</strong></td>
                        </tr>
                        <tr>
                            <td style="border: solid 1px #ccc; font-size: 13px; line-height: 180%; padding: 20px;">
                                <p>评论者昵称:<span style="color:#ba4c32;">' . $data['nickname'] . '</p>
                                <p>评论者Email:<span style="color:#ba4c32;">'.$data['email'].'</p>
                                <p>评论内容：</p><blockquote style="width: 94%;color: #8b8b8b;margin: 0 auto;padding: 10px;clear: both;border: 1px solid #ebebeb;">
                                    <p>' . $data['content'] . '</p>
                                </blockquote>
                                <hr>
                                <p><strong>=> 现在就前往<a href="' . articleUrl($data['aid']) . '#cmt' . $data['cid'] . '" target="_blank">文章页面</a>进行查看</strong></p>
                            </td>
                        </tr>
                    </tbody>
                </table>';
    if (C('IS_SEND_MAIL') == 'y'){
        if (!(\Org\Util\Tools::isLogin())){
            SendMail(C('MAIL_ADMIN'), $subject, $content);
        }
        if($data['pid'] > 0)
        {
            $subject = "您在【" . C('blog_name') . "】发表的评论收到了回复";
            $content = '<table cellpadding="0" cellspacing="0" style="font-family: 微软雅黑,verdana, arial; margin: 0 auto; width: 100%;">
                            <tbody>
                            <tr>
                                <td style="background: #08c; color: #fff; font-family: 微软雅黑,verdana, arial; font-size:15px;line-height: 50px;"><strong>  您在' . C('blog_name') . '的留言有了新的回复：</strong></td>
                            </tr>
                            <tr>
                                <td style="border: solid 1px #ccc;font-size: 13px;line-height: 180%;padding: 20px;"><span style="color: rgb(186, 76, 50); font-family:微软雅黑, verdana, arial; line-height: 23.4px;">' . getReplyName($comm['id']) . '</span>, 您好!
                                <p>您曾在<span style="color:#ba4c32;">《' . $articleTitle . '》</span>的留言:</p>
                                <blockquote style="width: 94%;color: #8b8b8b;margin: 0 auto;padding: 10px;clear: both;border: 1px solid #ebebeb;">
                                    <p>' . $comm['content'] . '</p>
                                </blockquote>
                                <p><span style="color:#ba4c32;">' . getReplyName($data['cid']) . '</span> 给你的回复:</p>
                                <blockquote style="width: 94%;color: #8b8b8b;margin: 0 auto;padding: 10px;clear: both;border: 1px solid #ebebeb;">
                                    <p>' . $data['content'] . '</p>
                                </blockquote>
                                <p style="padding: 5px;">您可以点此 <a href="' . articleUrl($data['aid']) . '#cmt' . $data['cid'] . '" target="_blank">查看完整回复內容</a>，欢迎您再度光临 <a href="' . C('blog_url') . '" target="_blank">' . C('blog_name') . '</a>！</p>
                                <hr>
                                <p><strong>温馨提示：此邮件由' . C('blog_name') . '自动发送，请勿直接回复。</strong></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>';
            if (!empty($data['email'])){
                SendMail($comm['email'], $subject, $content);
            }
        }
    }
}

/**
 * 将标签转换成域名
 * @param $value
 * @return mixed
 */
function replaceTag2Host($value){
    return str_replace('{#BLOG_HOST#}', C('blog_url'), $value);
}

/**
 * 将域名转换成标签
 * @param string $value
 * @return string
 */
function replaceHost2Tag($value){
    return str_replace(C('blog_url'), '{#BLOG_HOST#}',$value);
}



