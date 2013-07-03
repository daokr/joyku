
-- --------------------------------------------------------

--
-- 表的结构 `ik_group`
--
DROP TABLE IF EXISTS `ik_group`;
CREATE TABLE `ik_group` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT COMMENT '小组ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `cateid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `groupname` char(32) NOT NULL DEFAULT '' COMMENT '群组名字',
  `groupname_en` char(32) NOT NULL DEFAULT '' COMMENT '小组英文名称',
  `groupdesc` text NOT NULL COMMENT '小组介绍',
  `groupicon` char(255) DEFAULT '' COMMENT '小组图标',
  `count_topic` int(11) NOT NULL DEFAULT '0' COMMENT '帖子统计',
  `count_topic_today` int(11) NOT NULL DEFAULT '0' COMMENT '统计今天发帖',
  `count_user` int(11) NOT NULL DEFAULT '0' COMMENT '小组成员数',
  `joinway` tinyint(1) NOT NULL DEFAULT '0' COMMENT '加入方式',
  `role_leader` char(32) NOT NULL DEFAULT '组长' COMMENT '组长角色名称',
  `role_admin` char(32) NOT NULL DEFAULT '管理员' COMMENT '管理员角色名称',
  `role_user` char(32) NOT NULL DEFAULT '成员' COMMENT '成员角色名称',
  `addtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `isrecommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `isopen` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否公开或者私密',
  `isaudit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否审核',
  `ispost` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许会员发帖',
  `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`groupid`),
  KEY `userid` (`userid`),
  KEY `isshow` (`isshow`),
  KEY `groupname` (`groupname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='小组' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ik_group_setting`
--
DROP TABLE IF EXISTS `ik_group_setting`;
CREATE TABLE `ik_group_setting` (
  `name` char(32) NOT NULL DEFAULT '' COMMENT '选项名字',
  `data` char(255) NOT NULL DEFAULT '' COMMENT '选项内容',
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理配置';
--
-- 转存表中的数据 `ik_system_options`
--

INSERT INTO `ik_group_setting` (`name`, `data`) VALUES
('iscreate', '0'),
('group_isaudit', '0'),
('topic_isaudit', '0'),
('maxgroup', '10'),
('jionmax', '50');
-- --------------------------------------------------------

--
-- 表的结构 `ik_group_users`
--
DROP TABLE IF EXISTS `ik_group_users`;
CREATE TABLE `ik_group_users` (
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `groupid` int(11) NOT NULL DEFAULT '0' COMMENT '群组ID',
  `isadmin` int(11) NOT NULL DEFAULT '0' COMMENT '是否管理员',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '加入时间',
  UNIQUE KEY `userid_2` (`userid`,`groupid`),
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='群组和用户对应关系' ;

-- --------------------------------------------------------

--
-- 表的结构 `ik_group_topics`
--
DROP TABLE IF EXISTS `ik_group_topics`;
CREATE TABLE `ik_group_topics` (
  `topicid` int(11) NOT NULL AUTO_INCREMENT COMMENT '话题ID',
  `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '帖子分类ID',
  `groupid` int(11) NOT NULL DEFAULT '0' COMMENT '小组ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(64) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `count_comment` int(11) NOT NULL DEFAULT '0' COMMENT '回复统计',
  `count_view` int(11) NOT NULL DEFAULT '0' COMMENT '帖子展示数',
  `count_collect` int(11) NOT NULL DEFAULT '0' COMMENT '喜欢收藏数',  
  `count_attach` int(11) NOT NULL DEFAULT '0' COMMENT '统计附件',
  `count_recommend` int(11) NOT NULL DEFAULT '0' COMMENT '推荐人数',
  `istop` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `isaudit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否审核',
  `iscomment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许评论',
  `isphoto` tinyint(1) NOT NULL DEFAULT '0',
  `isattach` tinyint(1) NOT NULL DEFAULT '0',
  `isnotice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否通知',
  `isdigest` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否精华帖子',
  `isvideo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有视频',
  `addtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`topicid`),
  KEY `groupid` (`groupid`),
  KEY `userid` (`userid`),
  KEY `title` (`title`),
  KEY `groupid_2` (`groupid`,`isshow`),
  KEY `typeid` (`typeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='小组话题' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ik_group_topics_collects`
--
DROP TABLE IF EXISTS `ik_group_topics_collects`;
CREATE TABLE `ik_group_topics_collects` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `topicid` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '收藏时间',
  UNIQUE KEY `userid_2` (`userid`,`topicid`),
  KEY `userid` (`userid`),
  KEY `topicid` (`topicid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子收藏';

-- --------------------------------------------------------

--
-- 表的结构 `ik_group_topics_comments`
--
DROP TABLE IF EXISTS `ik_group_topics_comments`;
CREATE TABLE `ik_group_topics_comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `referid` int(11) NOT NULL DEFAULT '0',
  `topicid` int(11) NOT NULL DEFAULT '0' COMMENT '话题ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `content` text NOT NULL COMMENT '回复内容',
  `addtime` int(11) DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`commentid`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`),
  KEY `referid` (`referid`,`topicid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='话题回复/评论' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ik_group_topics_recommend`
--
DROP TABLE IF EXISTS `ik_group_topics_recommend`;
CREATE TABLE `ik_group_topics_recommend` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `topicid` int(11) NOT NULL DEFAULT '0',
  `content` char(250) NOT NULL DEFAULT '',  
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '推荐时间',
  UNIQUE KEY `userid_2` (`userid`,`topicid`),
  KEY `userid` (`userid`),
  KEY `topicid` (`topicid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子推荐';

-- --------------------------------------------------------

--
-- 表的结构 `ik_tag_group_index`
--
DROP TABLE IF EXISTS `ik_tag_group_index`;
CREATE TABLE `ik_tag_group_index` (
  `groupid` int(11) NOT NULL DEFAULT '0',
  `tagid` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `groupid_2` (`groupid`,`tagid`),
  KEY `groupid` (`groupid`),
  KEY `tagid` (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- 表的结构 `ik_tag_topic_index`
--
DROP TABLE IF EXISTS `ik_tag_topic_index`;
CREATE TABLE `ik_tag_topic_index` (
  `topicid` int(11) NOT NULL DEFAULT '0' COMMENT '帖子ID',
  `tagid` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `topicid_2` (`topicid`,`tagid`),
  KEY `topicid` (`topicid`),
  KEY `tagid` (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ik_group_cate` 更新时间2013年7月3日 新加表
--
-- ----------------------------
-- Table structure for `ik_group_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ik_group_cate`;
CREATE TABLE `ik_group_cate` (
  `cateid` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `catename` char(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `referid` int(11) NOT NULL DEFAULT '0',
  `orderid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cateid`),
  KEY `catename` (`catename`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ik_group_cate
-- ----------------------------
INSERT INTO `ik_group_cate` VALUES ('1', '兴趣', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('2', '旅行', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('3', '摄影', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('4', '影视', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('5', '音乐', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('6', '文学', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('7', '游戏', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('8', '动漫', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('9', '运动', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('10', '戏曲', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('11', '桌游', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('12', '怪癖', '1', '0');
INSERT INTO `ik_group_cate` VALUES ('13', '生活', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('14', '健康', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('15', '美食', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('16', '宠物', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('17', '美容', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('18', '化妆', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('19', '护肤', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('20', '服饰', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('21', '公益', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('22', '家庭', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('23', '育儿', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('24', '汽车', '13', '0');
INSERT INTO `ik_group_cate` VALUES ('25', '购物', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('26', '淘宝', '25', '0');
INSERT INTO `ik_group_cate` VALUES ('27', '二手', '25', '0');
INSERT INTO `ik_group_cate` VALUES ('28', '团购', '25', '0');
INSERT INTO `ik_group_cate` VALUES ('29', '数码', '25', '0');
INSERT INTO `ik_group_cate` VALUES ('30', '品牌', '25', '0');
INSERT INTO `ik_group_cate` VALUES ('31', '文具', '25', '0');
INSERT INTO `ik_group_cate` VALUES ('32', '社会', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('33', '求职', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('34', '租房', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('35', '励志', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('36', '留学', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('37', '出国', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('38', '理财', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('39', '传媒', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('40', '创业', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('41', '考试', '32', '0');
INSERT INTO `ik_group_cate` VALUES ('42', '艺术', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('43', '设计', '42', '0');
INSERT INTO `ik_group_cate` VALUES ('44', '手工', '42', '0');
INSERT INTO `ik_group_cate` VALUES ('45', '展览', '42', '0');
INSERT INTO `ik_group_cate` VALUES ('46', '曲艺', '42', '0');
INSERT INTO `ik_group_cate` VALUES ('47', '舞蹈', '42', '0');
INSERT INTO `ik_group_cate` VALUES ('48', '雕塑', '42', '0');
INSERT INTO `ik_group_cate` VALUES ('49', '纹身', '42', '0');
INSERT INTO `ik_group_cate` VALUES ('50', '学术', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('51', '人文', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('52', '社科', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('53', '自然', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('54', '建筑', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('55', '国学', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('56', '语言', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('57', '宗教', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('58', '哲学', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('59', '软件', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('60', '硬件', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('61', '互联网', '50', '0');
INSERT INTO `ik_group_cate` VALUES ('62', '情感', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('63', '恋爱', '62', '0');
INSERT INTO `ik_group_cate` VALUES ('64', '心情', '62', '0');
INSERT INTO `ik_group_cate` VALUES ('65', '心理学', '62', '0');
INSERT INTO `ik_group_cate` VALUES ('66', '星座', '62', '0');
INSERT INTO `ik_group_cate` VALUES ('67', '塔罗', '62', '0');
INSERT INTO `ik_group_cate` VALUES ('68', 'LES', '62', '0');
INSERT INTO `ik_group_cate` VALUES ('69', 'GAY', '62', '0');
INSERT INTO `ik_group_cate` VALUES ('70', '闲聊', '0', '0');
INSERT INTO `ik_group_cate` VALUES ('71', '吐槽', '70', '0');
INSERT INTO `ik_group_cate` VALUES ('72', '笑话', '70', '0');
INSERT INTO `ik_group_cate` VALUES ('73', '直播', '70', '0');
INSERT INTO `ik_group_cate` VALUES ('74', '八卦', '70', '0');
INSERT INTO `ik_group_cate` VALUES ('75', '发泄', '70', '0');