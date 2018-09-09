<?php if(!defined('APP_PATH')) {exit('error!');} ?>
<div id="sidebar">
<ul>
  <li class="widget divPrevious">
    <header>
        <h3>热门文章</h3>
    </header>
    <div class="main">
        <ul class="menu">
          <volist name=":getHotArticle()" id="vo">
            <li class="widget-links__item">
              <a title="{$vo.title}" href="{$vo.id|articleUrl=###}">{$vo.title}</a>
            </li>
          </volist>
        </ul>
    </div>
  </li>
  <li class="widget divTags">
    <header>
        <h3>标签列表</h3>
    </header>
    <div class="main">
        <ul class="menu">
          <volist name=":getTagList()" id="vo">
            <li class="tagPopup">
                <a class="tag" href="{$vo.name|tagUrl=###}" title="{$vo.name}">{$vo.name}</a>
            </li>
          </volist>
        </ul>
    </div>
  </li>
  <li class="widget divComments">
    <header>
        <h3>最新留言</h3>
    </header>
    <div class="main">
        <ul class="menu">
          <volist name=":getNewComment()" id="vo">
            <li class="widget-links__item">
                <small class="text-muted">{$vo.name}说:</small>
                <a title="{$vo.article_id|getArticleTitle=###}" href="{$vo.article_id|articleUrl=###}#cmt{$vo.id}">{$vo.content}</a>
            </li>
          </volist>
        </ul>
    </div>
  </li>
  <li class="widget divLinkage">
    <header>
      <h3>友情链接</h3></header>
    <div class="main">
      <ul class="menu">
        <volist name=":getLink()" id="vo">
          <li>
          <neq name="vo.is_hide" value="y">
            <a href="{$vo.url}" target="_blank" title="{$vo.name}">{$vo.name}</a></li>
          </neq>
          <li>
        </volist>
      </ul>
    </div>
  </li>
</ul>
</div>