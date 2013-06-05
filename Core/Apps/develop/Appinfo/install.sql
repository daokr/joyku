
-- --------------------------------------------------------

--
-- 表的结构 `ik_develop`
--
DROP TABLE IF EXISTS `ik_develop`;
CREATE TABLE `ik_develop` (
  `appid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` varchar(255) NOT NULL COMMENT '应用标题',
  `version` varchar(255) NOT NULL DEFAULT '1.0' COMMENT '版本号',
  `desc` text COMMENT '描述',
  `apptype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:应用,2:插件,3:皮肤',  
  `cateid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `package_name` varchar(255) NOT NULL DEFAULT '' COMMENT '应用包名',
  `ikphpversion` varchar(255) NOT NULL DEFAULT '' COMMENT 'IKPHP版本',
  `applogo` char(255) DEFAULT '' COMMENT 'logo',
  `appfile` char(255) DEFAULT '' COMMENT '应用安装包',
  `appsite` char(255) DEFAULT '' COMMENT '官方网站',
  `isaudit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未审核,1:已经审核',
  `isrecommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐 0否 1是',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未通过,1:通过',
  `count_view` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量', 
  `count_down` int(11) NOT NULL DEFAULT '0' COMMENT '下载次数', 
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`appid`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ik_develop_comments`
--
DROP TABLE IF EXISTS `ik_develop_comments`;
CREATE TABLE `ik_develop_comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `referid` int(11) NOT NULL DEFAULT '0',
  `appid` int(11) NOT NULL DEFAULT '0' COMMENT '应用ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` text NOT NULL COMMENT '回复内容',
  `addtime` int(11) DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`commentid`),
  KEY `appid` (`appid`),
  KEY `userid` (`userid`),
  KEY `referid` (`referid`,`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='话题回复/评论' AUTO_INCREMENT=1 ;