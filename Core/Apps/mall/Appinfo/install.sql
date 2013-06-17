-- --------------------------------------------------------

--
-- 表的结构 `ik_mall_album`
--

DROP TABLE IF EXISTS `ik_mall_album`;
CREATE TABLE `ik_mall_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` smallint(4) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `cover_cache` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `orderid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `count_like` int(10) NOT NULL,
  `count_item` int(10) unsigned NOT NULL DEFAULT '0',
  `count_follow` int(10) unsigned NOT NULL DEFAULT '0',
  `is_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ik_mall_album_cate`
--

DROP TABLE IF EXISTS `ik_mall_album_cate`;
CREATE TABLE `ik_mall_album_cate` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `orderid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `albums` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `seo_title` varchar(255) NOT NULL,
  `seo_keys` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;