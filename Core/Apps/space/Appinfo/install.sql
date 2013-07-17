-- --------------------------------------------------------

--
-- 表的结构 `ik_user_photo`
--
DROP TABLE IF EXISTS `ik_user_photo`;
CREATE TABLE `ik_user_photo` (
  `photoid` int(11) NOT NULL AUTO_INCREMENT,
  `albumid` int(11) NOT NULL DEFAULT '0' COMMENT '相册ID',
  `userid` int(11) NOT NULL DEFAULT '0',
  `photopath` varchar(255) NOT NULL DEFAULT '' COMMENT '图片路径',
  `photoname` varchar(255) NOT NULL DEFAULT '',
  `photodesc` varchar(255) NOT NULL DEFAULT '',
  `count_view` int(11) NOT NULL DEFAULT '0',
  `count_comment` int(11) NOT NULL DEFAULT '0',  
  `isrecommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0不推荐1推荐',
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`photoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `ik_photo`
--


-- --------------------------------------------------------

--
-- 表的结构 `ik_user_photo_album`
--
DROP TABLE IF EXISTS `ik_user_photo_album`;
CREATE TABLE `ik_user_photo_album` (
  `albumid` int(11) NOT NULL AUTO_INCREMENT COMMENT '相册ID',
  `userid` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '相册路径',
  `albumface` varchar(255) NOT NULL DEFAULT '' COMMENT '相册封面',
  `albumname` char(64) NOT NULL DEFAULT '',
  `albumdesc` varchar(400) NOT NULL DEFAULT '' COMMENT '相册介绍',
  `count_photo` int(11) NOT NULL DEFAULT '0',
  `count_view` int(11) NOT NULL DEFAULT '0',
  `orderid` varchar(20) NOT NULL DEFAULT 'desc' COMMENT '排序desc asc',  
  `privacy` tinyint(1) NOT NULL DEFAULT '1' COMMENT '浏览权限:1所有人可见 2仅朋友可见 3仅自己可见',    
  `isreply` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许回复:0不允许 1允许',  
  `isrecommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`albumid`),
  KEY `userid` (`userid`),
  KEY `isrecommend` (`isrecommend`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='相册' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `ik_photo_album`
--


-- --------------------------------------------------------

--
-- 表的结构 `ik_photo_comment`
--
DROP TABLE IF EXISTS `ik_user_photo_comment`;
CREATE TABLE `ik_user_photo_comment` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `referid` int(11) NOT NULL DEFAULT '0',
  `photoid` int(11) NOT NULL DEFAULT '0' COMMENT '相册ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` char(255) NOT NULL DEFAULT '' COMMENT '回复内容',
  `addtime` int(11) DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`commentid`),
  KEY `userid` (`userid`),
  KEY `referid` (`referid`,`photoid`),
  KEY `photoid` (`photoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图片回复/评论' AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `ik_feed`;
CREATE TABLE `ik_feed` (
  `feedid` int(11) NOT NULL AUTO_INCREMENT COMMENT '动态ID',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `type` char(50) DEFAULT NULL COMMENT 'feed类型',
  `share_link` varchar(250) DEFAULT NULL COMMENT '分享链接地址',
  `share_name` varchar(250) DEFAULT NULL COMMENT '分享链接标题',  
  `topicid` char(50) DEFAULT NULL COMMENT '关联的话题id',
  `addtime` int(11) NOT NULL COMMENT '产生时间戳',
  `is_del` int(2) NOT NULL DEFAULT '0' COMMENT '是否删除 默认为0',
  `count_comment` int(10) DEFAULT '0' COMMENT '评论数',
  `count_repost` int(10) DEFAULT '0' COMMENT '分享数 转发数',
  `is_image` int(2) DEFAULT '0' COMMENT '是否有图片 0-否  1-是',  
  `is_repost` int(2) DEFAULT '0' COMMENT '是否转发 0-否  1-是',
  `is_audit` int(2) DEFAULT '1' COMMENT '是否已审核 0-未审核 1-已审核',
  PRIMARY KEY (`feedid`),
  KEY `is_del` (`is_del`,`addtime`),
  KEY `userid` (`userid`,`is_del`,`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ik_feed_images`;
CREATE TABLE `ik_feed_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `feedid` int(11) NOT NULL DEFAULT '0' COMMENT 'feedid',
  `name` char(64) NOT NULL DEFAULT '' COMMENT '文件名',
  `path` char(32) NOT NULL DEFAULT '' COMMENT '源文件路径',
  PRIMARY KEY (`id`),
  KEY `feedid` (`feedid`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `ik_feed_topic`;
CREATE TABLE `ik_feed_topic` (
  `topicid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '话题ID',
  `topicname` varchar(150) NOT NULL COMMENT '话题标题',
  `count_topic` int(11) NOT NULL COMMENT '关联的话题数',
  `addtime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`topicid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ik_feed_data`;
CREATE TABLE `ik_feed_data` (
  `feedid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '关联feed表，feedid',
  `feeddata` text COMMENT '动态数据，序列化保存',
  `template` text COMMENT '模版内容',
  PRIMARY KEY (`feedid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
