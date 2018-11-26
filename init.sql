

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hxh_article
-- ----------------------------
DROP TABLE IF EXISTS `hxh_article`;
CREATE TABLE `hxh_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `category` int(6) NOT NULL COMMENT '文章分类',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `excerpt` varchar(200) DEFAULT NULL COMMENT '文章摘要',
  `content` longtext NOT NULL COMMENT '文章内容',
  `type` varchar(10) NOT NULL DEFAULT 'blog' COMMENT '页面类型',
  `is_top` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否置顶',
  `is_draft` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否为草稿',
  `open_comment` enum('n','y') NOT NULL DEFAULT 'y' COMMENT '开启评论',
  `comment_num` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
  `view_num` int(11) NOT NULL COMMENT '浏览量',
  `post_time` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Table structure for hxh_article_tag
-- ----------------------------
DROP TABLE IF EXISTS `hxh_article_tag`;
CREATE TABLE `hxh_article_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '文章ID',
  `tid` int(11) NOT NULL DEFAULT '0' COMMENT '标签ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='文章标签表';

-- ----------------------------
-- Table structure for hxh_category
-- ----------------------------
DROP TABLE IF EXISTS `hxh_category`;
CREATE TABLE `hxh_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) NOT NULL COMMENT '分类名',
  `alias` varchar(255) NOT NULL COMMENT '分类别名',
  `taxis` int(6) NOT NULL COMMENT '分类排序',
  `parent_id` int(11) NOT NULL COMMENT '父级ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Table structure for hxh_comment
-- ----------------------------
DROP TABLE IF EXISTS `hxh_comment`;
CREATE TABLE `hxh_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `article_id` int(11) NOT NULL COMMENT '文章ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` varchar(20) NOT NULL COMMENT '评论者名字',
  `email` varchar(50) NOT NULL COMMENT '评论者邮箱',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '评论者主页',
  `content` text NOT NULL COMMENT '评论内容',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '评论者IP',
  `is_hide` enum('n','y') DEFAULT 'n' COMMENT '是否隐藏',
  `post_time` int(11) NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=622 DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Table structure for hxh_config
-- ----------------------------
DROP TABLE IF EXISTS `hxh_config`;
CREATE TABLE `hxh_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(50) NOT NULL COMMENT '配置名称',
  `value` text NOT NULL COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- ----------------------------
-- Table structure for hxh_file
-- ----------------------------
DROP TABLE IF EXISTS `hxh_file`;
CREATE TABLE `hxh_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章ID',
  `user_id` int(11) NOT NULL COMMENT '用户D',
  `name` varchar(255) NOT NULL COMMENT '文件名称',
  `size` int(11) NOT NULL COMMENT '文件大小',
  `mime` varchar(50) NOT NULL COMMENT '文件Mime',
  `save_path` varchar(255) DEFAULT NULL COMMENT '文件保存路径',
  `post_time` int(11) NOT NULL COMMENT '文件上传时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=362 DEFAULT CHARSET=utf8 COMMENT='文件表';

-- ----------------------------
-- Table structure for hxh_link
-- ----------------------------
DROP TABLE IF EXISTS `hxh_link`;
CREATE TABLE `hxh_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '站点名称',
  `url` varchar(75) NOT NULL DEFAULT '' COMMENT '站点地址',
  `description` varchar(255) DEFAULT NULL COMMENT '说明',
  `is_hide` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否隐藏',
  `taxis` int(10) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for hxh_nav
-- ----------------------------
DROP TABLE IF EXISTS `hxh_nav`;
CREATE TABLE `hxh_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '导航名',
  `url` varchar(75) NOT NULL DEFAULT '' COMMENT '地址',
  `new_tab` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否在新标签打开',
  `is_hide` enum('n','y') NOT NULL DEFAULT 'n' COMMENT '是否隐藏',
  `taxis` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for hxh_tag
-- ----------------------------
DROP TABLE IF EXISTS `hxh_tag`;
CREATE TABLE `hxh_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `name` varchar(60) NOT NULL COMMENT '标签名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Table structure for hxh_user
-- ----------------------------
DROP TABLE IF EXISTS `hxh_user`;
CREATE TABLE `hxh_user` (
  `id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '登录名',
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `head` varchar(255) DEFAULT 'default.png' COMMENT '头像',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `email` varchar(50) NOT NULL COMMENT '用户邮箱',
  `homepage` varchar(255) NOT NULL COMMENT '用户主页',
  `iP` varchar(15) NOT NULL COMMENT '用户IP',
  `role` varchar(10) DEFAULT 'visitor' COMMENT '用户权限',
  `level` int(1) NOT NULL DEFAULT '0' COMMENT '用户权限等级',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '用户状态',
  `reg_time` int(11) NOT NULL COMMENT '用户注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `hxh_config` VALUES ('1', 'blog_name', '何湘辉博客');
INSERT INTO `hxh_config` VALUES ('2', 'blog_url', 'http://thinkblog.com');
INSERT INTO `hxh_config` VALUES ('3', 'blog_info', '一个关注 PHP 开发的博客');
INSERT INTO `hxh_config` VALUES ('4', 'index_article_num', '10');
INSERT INTO `hxh_config` VALUES ('5', 'index_comment_num', '1');
INSERT INTO `hxh_config` VALUES ('6', 'login_code', 'n');
INSERT INTO `hxh_config` VALUES ('7', 'is_excerpt', 'y');
INSERT INTO `hxh_config` VALUES ('8', 'excerpt_num', '100');
INSERT INTO `hxh_config` VALUES ('9', 'rss_output_num', '10');
INSERT INTO `hxh_config` VALUES ('10', 'rss_output_full_text', 'y');
INSERT INTO `hxh_config` VALUES ('11', 'is_comment', 'y');
INSERT INTO `hxh_config` VALUES ('12', 'comment_interval', '30');
INSERT INTO `hxh_config` VALUES ('13', 'is_check_comment', 'n');
INSERT INTO `hxh_config` VALUES ('14', 'comment_code', 'n');
INSERT INTO `hxh_config` VALUES ('15', 'is_gravatar', 'n');
INSERT INTO `hxh_config` VALUES ('16', 'comment_order', 'new');
INSERT INTO `hxh_config` VALUES ('17', 'is_thumb', 'n');
INSERT INTO `hxh_config` VALUES ('18', 'icp', '123456');
INSERT INTO `hxh_config` VALUES ('19', 'footer_info', 'Copyright © 2016 her-cat.com All rights reserved.');
INSERT INTO `hxh_config` VALUES ('20', 'blog_keywords', '何湘辉,个人博客,PHP实例,PHP采集');
INSERT INTO `hxh_config` VALUES ('21', 'blog_description', '欢迎来到何湘辉博客，一个记录PHP学习笔记的博客，爱分享网络资源，分享学到的知识，分享生活的乐趣。网址是thinkblog.com');

INSERT INTO `hxh_user` VALUES ('1', 'admin', '管理员', '/Head/20160911/57d4f77861213.jpg', 'e10adc3949ba59abbe56e057f20f883e', 'hxhsoft@foxmail.com', 'https://github.com/her-cat/ThinkBlog', '127.0.0.1', 'admin', '1', '0', '123456');
