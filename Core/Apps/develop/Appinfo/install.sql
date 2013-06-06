
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
  `count_vote` int(11) NOT NULL DEFAULT '0' COMMENT '投票数',   
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`appid`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- 表的结构 `ik_develop_cate`
--
DROP TABLE IF EXISTS `ik_develop_cate`;
CREATE TABLE `ik_develop_cate` (
  `cateid` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `catename` char(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `orderid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cateid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `ik_develop_cate` VALUES ('1', '内容聚合', '1');
INSERT INTO `ik_develop_cate` VALUES ('2', '广告', '2');
INSERT INTO `ik_develop_cate` VALUES ('3', '图片相册', '3');
INSERT INTO `ik_develop_cate` VALUES ('4', '附件下载', '4');
INSERT INTO `ik_develop_cate` VALUES ('5', '生活服务', '5');
INSERT INTO `ik_develop_cate` VALUES ('6', '分享推广', '6');
INSERT INTO `ik_develop_cate` VALUES ('7', 'SEO', '7');
INSERT INTO `ik_develop_cate` VALUES ('8', '注册登录', '8');
INSERT INTO `ik_develop_cate` VALUES ('9', '视听娱乐', '9');
INSERT INTO `ik_develop_cate` VALUES ('10', '小工具', '10');
INSERT INTO `ik_develop_cate` VALUES ('11', '增强互动', '11');
INSERT INTO `ik_develop_cate` VALUES ('12', '电子商务', '12');
INSERT INTO `ik_develop_cate` VALUES ('13', '看帖增强', '13');
INSERT INTO `ik_develop_cate` VALUES ('14', '管理增强', '14');
INSERT INTO `ik_develop_cate` VALUES ('15', '积分流通', '15');
INSERT INTO `ik_develop_cate` VALUES ('16', '发帖增强', '16');
INSERT INTO `ik_develop_cate` VALUES ('17', '权限规则', '17');
INSERT INTO `ik_develop_cate` VALUES ('18', '邮件短信', '18');
INSERT INTO `ik_develop_cate` VALUES ('19', '信息安全', '19');
INSERT INTO `ik_develop_cate` VALUES ('20', '手机客户端', '20');

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

-- --------------------------------------------------------

--
-- 表的结构 `ik_develop_down`
--
DROP TABLE IF EXISTS `ik_develop_down`;
CREATE TABLE `ik_develop_down` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID', 
  `appid` int(11) NOT NULL DEFAULT '0' COMMENT 'APPID',    
  `downtime` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='统计下载';


-- --------------------------------------------------------

--
-- 表的结构 `ik_develop_vote`
--
DROP TABLE IF EXISTS `ik_develop_vote`;
CREATE TABLE `ik_develop_vote` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `appid` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  UNIQUE KEY `userid_2` (`userid`,`appid`),
  KEY `userid` (`userid`),
  KEY `appid` (`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='投票';
