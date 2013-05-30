
-- --------------------------------------------------------

--
-- 表的结构 `ik_develop`
--
DROP TABLE IF EXISTS `ik_develop`;
CREATE TABLE `ik_develop` (
  `appid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '应用标题',
  `version` varchar(255) NOT NULL DEFAULT '1.0' COMMENT '版本号',
  `desc` text COMMENT '描述',
  `apptype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:应用,2:插件,3:皮肤',  
  `cateid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `package_name` varchar(255) NOT NULL DEFAULT '' COMMENT '应用包名',
  `ikphpversion` varchar(255) NOT NULL DEFAULT '' COMMENT 'IKPHP版本',
  `applogo` char(255) DEFAULT '' COMMENT 'logo',
  `appfile` char(255) DEFAULT '' COMMENT '应用安装包',
  `isaudit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未审核,1:已经审核',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未通过,1:通过',
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`appid`),
  KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
