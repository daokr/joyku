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
