DROP TABLE IF EXISTS `ik_mall_item_site`;
CREATE TABLE `ik_mall_item_site` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `config` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `ik_mall_item_site` (`id`, `code`, `name`, `domain`, `url`, `desc`, `config`, `author`, `ordid`, `status`) VALUES
(5, 'taobao', '淘宝', 'taobao.com,tianmao.com,tmall.com', 'http://www.taobao.com', '通过淘宝开放平台获取商品数据，可到 http://open.taobao.com/ 查看详细', 'a:3:{s:7:"app_key";s:8:"21509482";s:10:"app_secret";s:32:"9d99e5a73a30ce41e19c35a877e64005";s:9:"taoke_pid";s:8:"16185888";}', 'PinPHP TEAM', 255, 1);

-- --------------------------------------------------------



DROP TABLE IF EXISTS `ik_tag_mall_item_index`;
CREATE TABLE `ik_tag_mall_item_index` (
  `itemid` int(11) NOT NULL DEFAULT '0',
  `tagid` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `itemid_2` (`itemid`,`tagid`),
  KEY `itemid` (`itemid`),
  KEY `tagid` (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ik_mall_item_orig`;
CREATE TABLE `ik_mall_item_orig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `ik_mall_item_orig` (`id`, `img`, `name`, `url`, `ordid`) VALUES
(1, '50b2e721a6c1e_thumb.jpg', '淘宝', 'taobao.com', 0),
(2, '50b2e726d4ade_thumb.jpg', '天猫', 'tmall.com', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ik_mall_item_img`
--

DROP TABLE IF EXISTS `ik_mall_item_img`;
CREATE TABLE `ik_mall_item_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- 表的结构 `ik_mall_item`
--

DROP TABLE IF EXISTS `ik_mall_item`;
CREATE TABLE `ik_mall_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(4) unsigned DEFAULT NULL,
  `orig_id` smallint(6) NOT NULL,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `key_id` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `intro` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rates` float(8,2) NOT NULL COMMENT '佣金比率xxx.xx%',
  `url` text,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:商品,2:图片',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `likes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '喜欢数',
  `comments` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `cmt_taobao_time` int(10) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL,
  `tag_cache` text NOT NULL,
  `comments_cache` text NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_keys` varchar(255) DEFAULT NULL,
  `seo_desc` text,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_id` (`key_id`),
  KEY `cid` (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

DROP TABLE IF EXISTS `ik_mall_item_cate`;
CREATE TABLE `ik_mall_item_cate` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `tags` varchar(50) NOT NULL,
  `pid` smallint(4) unsigned NOT NULL,
  `spid` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `fcolor` varchar(10) NOT NULL,
  `remark` text NOT NULL,
  `add_time` int(10) NOT NULL,
  `items` int(10) unsigned NOT NULL DEFAULT '0',
  `likes` int(10) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:商品分类 1:标签分类',
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) NOT NULL,
  `is_index` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
