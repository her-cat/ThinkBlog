<?php if(!defined('APP_PATH')) {exit('error!');} ?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="zh-CN" />
    <meta name="generator" content="ThinkBlog By HeXiangHui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{$article.title}-{:C('blog_name')}</title>
    <meta name="keywords" content="{$article.id|getTagStr=###}" />
    <meta name="description" content="{$article.excerpt}" />
    <link rel="stylesheet" rev="stylesheet" href="__TPL__/Public/Css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" rev="stylesheet" href="__TPL__/Public/Css/prettify.css" type="text/css" media="all" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script type="text/javascript" src="__PUBLIC__/Js/jquery-1.12.1.min.js"></script>
    <script src="__TPL__/Public/Js/common.js" type="text/javascript"></script>
    <script type="text/javascript" src="__TPL__/Public/Js/com.js"></script>
    <script src="__TPL__/Public/Js/prettify.js" type="text/javascript"></script>
  </head>
  <body class="home blog">
    <div id="wrapper-innerIE6"></div>
    <div id="wrapper">
      <div id="wrapper-inner" data-bymts="theme-bymt mouse-title ajax-posts ajax-search highlight">
        <!-- 引用header -->
        <include file="Public:header" />
        <div id="content-wrap">
          <div id="content-main">
            <div class="post-single">
              <div class="post-header">
                <h2 class="post-title">{$article.title}</h2></div>
              <div class="post-meta">
                <ul class="resizer">
                  <li id="f_s">
                    <a href="javascript:;" title="缩小字体">小</a></li>
                  <li id="f_m">
                    <a href="javascript:;" title="默认字体">中</a></li>
                  <li id="f_l">
                    <a href="javascript:;" title="加大字体">大</a></li>
                  <li id="f_c">
                    <a href="javascript:;" title="关闭侧边栏">
                      <i class="icon-stop"></i>
                    </a>
                  </li>
                  <li id="f_o">
                    <a href="javascript:;" title="打开侧边栏">
                      <i class="icon-pause"></i>
                    </a>
                  </li>
                </ul>
                <span class="pauthor">
                  <i class="icon-user-add"></i>
                  <a href="{$article.user_id|authorUrl=###}" title="由{$article.user_id|getAuthorName=###}发布" rel="author">{$article.user_id|getAuthorName=###}</a></span>
                <span class="ptime">
                  <i class="icon-calendar"></i>{$article.post_time|date="Y-m-d", ###}</span>
                <span class="pcate">
                  <i class="icon-category"></i>
                  <a href="{$article.category|categoryUrl=###}" title="查看{$article.category|getCategoryName=###}中的全部文章" rel="category tag">{$article.category|getCategoryName=###}</a></span>
                <span class="pview">
                  <i class="icon-pass"></i>{$article.view_num}人路过</span>
                <span class="pcomm">
                  <i class="icon-chat"></i>
                  <a href="#respond_box" rel="nofollow" title="《{$article.title}》上的评论">{$article.comment_num}条评论</a></span>
              </div>
              <div class="post-content">{$article.content|replaceTag2Host=###|htmlspecialchars_decode}</div>
              <div class="post-footer">
                <div class="post-tagsshare">
                  <div class="post-tags">
                    <i class="icon-tags">
                      <volist name=":getArticleTag($article['id'])" id="v">
                        <a href="{$v.name|tagUrl=###}" class="tag-link" title="查看标签为《{$v.name}》的所有文章">{$v.name}</a>
                      </volist>
                    </i>
                  </div>
                </div>
                <div class="post-copyright">
                  <div id="author-avatar">
                    <img src="__UPLOAD__/{$article.user_id|getUserHead=###}" alt="avatar" class="avatar avatar-42 photo" height="42" width="42" /></div>
                  <div id="copy-info">
                    <span id="copy-arrow">
                      <span></span>
                    </span>
                    <p>
                      <strong>版权声明：</strong>本文除特别说明外均由
                        <a href="{$article.user_id|authorUrl=###}" title="由{$article.user_id|getAuthorName=###}发布" rel="author">{$article.user_id|getAuthorName=###} </a>原创</p>
                    <p>
                      <strong>本文链接：</strong>
                      <a class="copy-link-3" href="{$article.id|articleUrl=###}" title="{$article.id|articleUrl=###}">{$article.id|articleUrl=###}</a>，尊重共享，欢迎转载！</p></div>
                </div>
                <div class="post-navigation">
                  <div class="post-previous">{$article.post_time|getPrevArticle=###}</div>
                  <div class="post-next">{$article.post_time|getNextArticle=###}</div>
                </div>
              </div>
            <eq name="article.open_comment" value="y">
              <div class="comments">
                <h3 id="comments">{$article.comment_num}条大神的评论</h3>
                <div class="commentshow">
                  <ol class="commentlist">
                    <label id="AjaxCommentBegin"></label>
                    <volist name=":getCommentList($article['id'])" id="vo">
                      <label id="cmt{$vo.id}"></label>
                      <li class="comment even thread-even depth-1" id="comment-{$vo.id}">
                        <div id="div-comment-{$vo.id}" class="comment-body">
                          <div class="comment-author vcard gravatar">
                            <img src="{$vo.email|getGravatar=###}" alt="avatar" class="avatar avatar-50 photo" height="50" width="50"></div>
                          <div class="floor">{$vo.i}楼</div>
                          <div class="commenttext">
                            <span class="commentid">
                              <a href="{$vo.url}" rel="external nofollow" class="url" target="_blank">{$vo.name}</a></span>
                            <span class="datetime">{$vo.post_time|date="Y-m-d H:i:s", ###}</span>
                            <span class="reply">
                              <a class="comment-reply-link" href="#reply" onclick="RevertComment('{$vo.id}');" rel="nofollow">回复</a></span>
                            <span class="edit_comment"></span>
                            <div class="comment_text">
                              <p><eq name="vo.parent_id" value="0"><else />@{$vo.parent_id|getReplyName=###}</a>，</eq>{$vo.content}</p>
                            </div>
                          </div>
                        </div>
                      </li>
                      <ul class="children">
                      <volist name="vo.children" id="v">
                        
                          <label id="cmt{$v.id}"></label><li class="comment even thread-even depth-1" id="comment-{$v.id}">
                            <div id="div-comment-{$v.id}" class="comment-body">
                                <div class="comment-author vcard gravatar">
                                    <img src="{$v.email|getGravatar=###, 50}" alt="avatar" class="avatar avatar-50 photo" height="50" width="50">
                                </div>
                                <div class="floor"></div>
                                <div class="commenttext">
                                    <span class="commentid">
                                        <a href="{$v.url}" rel="external nofollow" class="url">{$v.name}</a>
                                    </span>
                                    <span class="datetime">{$v.post_time|date="Y-m-d H:i:s", ###}</span>
                                    <span class="reply">
                                        <a class="comment-reply-link" href="#reply" onclick="RevertComment('{$v.id}');" rel="nofollow">回复</a>
                                    </span>
                                    <span class="edit_comment"></span>
                                    <div class="comment_text">
                                        <p><eq name="v.parent_id" value="0"><else />回复 <a href="javascript:void(0);" class="at">{$v.parent_id|getReplyName=###}</a>：</eq> {$v.content}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <label id="AjaxComment{$v.id}"></label> 
                      </volist>
                      <label id="AjaxComment{$vo.id}"></label>
                      </ul>
                    </volist>
                    <div class="pagination">
                      <div class="clear"></div>
                    </div>
                    <label id="AjaxCommentEnd"></label>
                  </ol>
                </div>
                <div id="respond_box">
                  <div id="respond" class="respond">
                    <h3>发表评论</h3>
                    <form method="post" id="comment_form" target="_self" action="{:C('blog_url')}/action/" onsubmit="return false;">
                      <input type="hidden" name="inpId" id="inpId" value="{$article.id}" />
                      <input type="hidden" name="inpRevID" id="inpRevID" value="0" />
                      <input type="hidden" name="isChild" id="isChild" valeu="">
                      <div id="input-box">
                        <div id="real-avatar"></div>
                        <div id="author-input">
                          <p id="welcome">
                            <a rel="nofollow" id="cancel-comment-reply-link" href="#divCommentPost" style="display:none;">[取消回复]</a></p>
                          <p id="author-info">
                            <label for="author">昵称</label>
                            <input type="text" name="inpName" id="inpName" class="replytext text" value="访客" size="28" tabindex="1" placeholder="nickname" required />
                            <label for="email">邮箱</label>
                            <input type="text" name="inpEmail" id="inpEmail" class="replytext text" value="" size="28" tabindex="2" placeholder="name@example.com" required />
                            <span id="Get_Gravatar"></span>
                            <label for="url">网址</label>
                            <input type="text" name="inpHomePage" id="inpHomePage" class="replytext text" value="{:getVisitor('url')}" size="28" tabindex="3" placeholder="www.hexianghui.net"/></p>
                        </div>
                      </div>
                      <div class="comment-box">
                        <textarea name="txaArticle" class="textarea text" id="txaArticle" tabindex="5" cols="45" rows="4" placeholder="任何广告行为都会被封杀的哦~" required></textarea>
                      </div>
                      <div class="comment-btns">
                        <input name="btnSumbit" id="btnSumbit" type="submit" id="submit" tabindex="6" value="发表评论/快捷回复:Ctrl+Enter"/>
                        <input name="reset" type="reset" id="reset" tabindex="6" value="清除" /></div>
                    </form>
                  </div>
                </div>
              </div>
            </eq>
            </div>
          </div>
          <!-- 引入侧边栏 -->
          <include file="Public:side" />
        </div>
        <!-- 引入底部 -->
      <include file="Public:footer" />
    </div>
  </body>
</html>