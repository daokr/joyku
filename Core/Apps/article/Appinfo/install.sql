-- --------------------------------------------------------

--
-- 表的结构 `ik_article`
--
DROP TABLE IF EXISTS `ik_article`;
CREATE TABLE `ik_article` (
  `aid` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `itemid` int(11) NOT NULL DEFAULT '0' COMMENT '信息ID',
  `content` text NOT NULL COMMENT '内容',
  `postip` varchar(15) NOT NULL DEFAULT '' COMMENT '发布者ip',
  `newsauthor` varchar(20) NOT NULL DEFAULT '' COMMENT '作者',
  `newsfrom` varchar(50) NOT NULL DEFAULT '' COMMENT '来源',
  `newsfromurl` varchar(150) NOT NULL DEFAULT '' COMMENT '来源连接',
  PRIMARY KEY (`aid`),
  KEY `itemid` (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `ik_article_item`
--
DROP TABLE IF EXISTS `ik_article_item`;
CREATE TABLE `ik_article_item` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `cateid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `title` char(64) NOT NULL DEFAULT '' COMMENT '标题',
  `count_comment` int(11) NOT NULL DEFAULT '0' COMMENT '回复统计',
  `count_view` int(11) NOT NULL DEFAULT '0' COMMENT '展示数',
  `photoid` int(11) NOT NULL DEFAULT '0' COMMENT '文章主图id',
  `orderid` int(11) NOT NULL DEFAULT '0' COMMENT '排序id',  
  `isphoto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有图片',
  `isvideo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有视频',  
  `istop` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `iscomment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许评论',
  `isdigest` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否精华帖子',
  `isaudit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否审核', 
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`itemid`),
  KEY `userid` (`userid`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `ik_article_cate`
--
DROP TABLE IF EXISTS `ik_article_cate`;
CREATE TABLE `ik_article_cate` (
  `cateid` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `catename` char(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `nameid` char(30) NOT NULL DEFAULT '' COMMENT '频道id',  
  `orderid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cateid`),
  KEY `nameid` (`nameid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ik_article_channel`
--
DROP TABLE IF EXISTS `ik_article_channel`;
CREATE TABLE `ik_article_channel` (
  `nameid` char(30) NOT NULL DEFAULT '' COMMENT '频道英文名称',
  `name` char(50) NOT NULL DEFAULT '' COMMENT '频道名',
  `isnav` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启导航',  
  PRIMARY KEY (`nameid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章频道';

-- --------------------------------------------------------
--
-- 表的结构 `ik_article_comment`
--
DROP TABLE IF EXISTS `ik_article_comment`;
CREATE TABLE `ik_article_comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '文章ID',
  `referid` int(11) NOT NULL DEFAULT '0' COMMENT '回复ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` text NOT NULL COMMENT '评论内容',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`cid`),
  KEY `aid` (`aid`),
  KEY `userid` (`userid`),
  KEY `referid` (`referid`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章回复/评论' AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 'ik_robots'
--
DROP TABLE IF EXISTS `ik_article_robots`;
CREATE TABLE `ik_article_robots` (
  `robotid` smallint(6) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '机器人名称',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '添加者id',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加机器人的时间',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次采集时间',
  `importcatid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '插入的分类ID',
  `robotnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `listurltype` varchar(10) NOT NULL DEFAULT '' COMMENT '索引列表方式',
  `listurl` text NOT NULL COMMENT '索引列表链接',
  `listpagestart` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '索引列表开始页码',
  `listpageend` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '索引列表结束页码',
  `reverseorder` tinyint(1) NOT NULL DEFAULT '1' COMMENT '索引列表结束页码',
  `allnum` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '总的采集数目',
  `pernum` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '每次采集信息数目',
  `savepic` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否保存信息内的图片',
  `encode` varchar(20) NOT NULL DEFAULT '' COMMENT '采集页面的字符集编码',
  `picurllinkpre` text NOT NULL,
  `saveflash` tinyint(1) NOT NULL DEFAULT '0',
  `subjecturlrule` text NOT NULL,
  `subjecturllinkrule` text NOT NULL,
  `subjecturllinkpre` text NOT NULL,
  `subjectrule` text NOT NULL,
  `subjectfilter` text NOT NULL,
  `subjectreplace` text NOT NULL,
  `subjectreplaceto` text NOT NULL,
  `subjectkey` text NOT NULL,
  `subjectallowrepeat` tinyint(1) NOT NULL DEFAULT '0',
  `datelinerule` text NOT NULL,
  `fromrule` text NOT NULL,
  `authorrule` text NOT NULL,
  `messagerule` text NOT NULL,
  `messagefilter` text NOT NULL,
  `messagepagetype` varchar(10) NOT NULL DEFAULT '',
  `messagepagerule` text NOT NULL,
  `messagepageurlrule` text NOT NULL,
  `messagepageurllinkpre` text NOT NULL,
  `messagereplace` text NOT NULL,
  `messagereplaceto` text NOT NULL,
  `autotype` tinyint(1) NOT NULL DEFAULT '0',
  `wildcardlen` tinyint(1) NOT NULL DEFAULT '0',
  `subjecturllinkcancel` text NOT NULL,
  `subjecturllinkfilter` text NOT NULL,
  `subjecturllinkpf` text NOT NULL,
  `subjectkeycancel` text NOT NULL,
  `messagekey` text NOT NULL,
  `messagekeycancel` text NOT NULL,
  `messageformat` tinyint(1) NOT NULL DEFAULT '0',
  `messagepageurllinkpf` text NOT NULL,
  `uidrule` text NOT NULL COMMENT '发布者UID',
  `defaultaddtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '默认发布时间',
  PRIMARY KEY  (robotid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='采集器' AUTO_INCREMENT=1 ;