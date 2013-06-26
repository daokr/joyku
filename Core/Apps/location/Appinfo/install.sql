-- ----------------------------
-- Table structure for `ik_event_cate`
-- ----------------------------
DROP TABLE IF EXISTS `ik_event_cate`;
CREATE TABLE `ik_event_cate` (
  `cateid` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动分类ID',
  `catename` char(120) NOT NULL DEFAULT '' COMMENT '分类名',
  `enname` char(120) NOT NULL DEFAULT '' COMMENT '英文名称',
  `tag` text NOT NULL COMMENT '分类标签',
  `referid` int(11) NOT NULL DEFAULT '0' COMMENT '父ID',
  PRIMARY KEY (`cateid`),
  KEY `cateid` (`referid`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='活动分类';

-- ----------------------------
-- Records of ik_event_cate
-- ----------------------------
INSERT INTO `ik_event_cate` VALUES ('1', '音乐', 'music', 'a:10:{i:0;s:9:\"音乐会\";i:1;s:6:\"乐团\";i:2;s:6:\"独奏\";i:3;s:9:\"交响乐\";i:4;s:6:\"钢琴\";i:5;s:9:\"音乐节\";i:6;s:6:\"弦乐\";i:7;s:9:\"音乐剧\";i:8;s:6:\"管弦\";i:9;s:9:\"小提琴\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('2', '戏剧', 'drama', 'a:5:{i:0;s:6:\"说客\";i:1;s:12:\"老舍五则\";i:2;s:9:\"利剧院\";i:3;s:21:\"达人未爱狂想曲\";i:4;s:9:\"工作室\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('3', '讲座', 'salon', 'a:10:{i:0;s:6:\"公益\";i:1;s:6:\"学术\";i:2;s:6:\"健康\";i:3;s:6:\"理财\";i:4;s:6:\"育儿\";i:5;s:6:\"文学\";i:6;s:6:\"投资\";i:7;s:6:\"国学\";i:8;s:18:\"走进心灵世界\";i:9;s:6:\"文化\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('4', '聚会', 'party', 'a:10:{i:0;s:6:\"交友\";i:1;s:6:\"单身\";i:2;s:6:\"桌游\";i:3;s:6:\"恋爱\";i:4;s:4:\"K歌\";i:5;s:9:\"三国杀\";i:6;s:6:\"游戏\";i:7;s:6:\"杀人\";i:8;s:6:\"深圳\";i:9;s:6:\"唱歌\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('5', '电影', 'film', 'a:8:{i:0;s:6:\"放映\";i:1;s:6:\"影展\";i:2;s:9:\"奥斯卡\";i:3;s:6:\"咖啡\";i:4;s:15:\"戛纳电影节\";i:5;s:18:\"威尼斯电影节\";i:6;s:15:\"天堂电影院\";i:7;s:6:\"观影\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('6', '展览', 'exhibition', 'a:10:{i:0;s:15:\"傻瓜的情歌\";i:1;s:9:\"艺术馆\";i:2;s:9:\"个人展\";i:3;s:9:\"艺术展\";i:4;s:6:\"国际\";i:5;s:6:\"艺术\";i:6;s:6:\"当代\";i:7;s:6:\"图片\";i:8;s:6:\"建筑\";i:9;s:6:\"设计\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('7', '运动', 'sports', 'a:6:{i:0;s:6:\"恋爱\";i:1;s:6:\"旅行\";i:2;s:6:\"爬山\";i:3;s:6:\"健康\";i:4;s:6:\"交友\";i:5;s:6:\"聚会\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('8', '公益', 'commonweal', 'a:11:{i:0;s:6:\"讲座\";i:1;s:6:\"冥想\";i:2;s:6:\"瑜伽\";i:3;s:6:\"爱心\";i:4;s:6:\"关爱\";i:5;s:6:\"迎春\";i:6;s:12:\"道家养生\";i:7;s:12:\"灵性舞蹈\";i:8;s:9:\"宇宙能\";i:9;s:12:\"身心健康\";i:10;s:12:\"舞蹈静心\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('9', '旅行', 'travel', 'a:10:{i:0;s:6:\"游历\";i:1;s:12:\"城市行走\";i:2;s:24:\"中国城市行走攻略\";i:3;s:6:\"行走\";i:4;s:6:\"生活\";i:5;s:6:\"恋爱\";i:6;s:6:\"运动\";i:7;s:6:\"露营\";i:8;s:6:\"摄影\";i:9;s:6:\"爬山\";}', '0');
INSERT INTO `ik_event_cate` VALUES ('10', '其他', 'others', '', '0');
INSERT INTO `ik_event_cate` VALUES ('11', '小型现场', '', '', '1');
INSERT INTO `ik_event_cate` VALUES ('12', '音乐会', '', '', '1');
INSERT INTO `ik_event_cate` VALUES ('13', '演唱会', '', '', '1');
INSERT INTO `ik_event_cate` VALUES ('14', '音乐节', '', '', '1');
INSERT INTO `ik_event_cate` VALUES ('15', '话剧', '', '', '2');
INSERT INTO `ik_event_cate` VALUES ('16', '音乐剧', '', '', '2');
INSERT INTO `ik_event_cate` VALUES ('17', '舞剧', '', '', '2');
INSERT INTO `ik_event_cate` VALUES ('18', '歌剧', '', '', '2');
INSERT INTO `ik_event_cate` VALUES ('19', '戏曲', '', '', '2');
INSERT INTO `ik_event_cate` VALUES ('20', '生活', '', '', '4');
INSERT INTO `ik_event_cate` VALUES ('21', '集市', '', '', '4');
INSERT INTO `ik_event_cate` VALUES ('22', '摄影', '', '', '4');
INSERT INTO `ik_event_cate` VALUES ('23', '外语', '', '', '4');
INSERT INTO `ik_event_cate` VALUES ('24', '桌游', '', '', '4');
INSERT INTO `ik_event_cate` VALUES ('25', '交友', '', '', '4');
INSERT INTO `ik_event_cate` VALUES ('26', '夜店', '', '', '4');
INSERT INTO `ik_event_cate` VALUES ('27', '主题放映', '', '', '5');
INSERT INTO `ik_event_cate` VALUES ('28', '影展', '', '', '5');
INSERT INTO `ik_event_cate` VALUES ('29', '影院活动', '', '', '5');
INSERT INTO `ik_event_cate` VALUES ('30', '恋爱', '', '', '7');
INSERT INTO `ik_event_cate` VALUES ('31', '旅行', '', '', '7');
INSERT INTO `ik_event_cate` VALUES ('32', '爬山', '', '', '7');
INSERT INTO `ik_event_cate` VALUES ('33', '健康', '', '', '7');
INSERT INTO `ik_event_cate` VALUES ('34', '交友', '', '', '7');
INSERT INTO `ik_event_cate` VALUES ('35', '聚会', '', '', '7');
-- --------------------------------------------------------
--
-- 表的结构 `ik_event`
--
DROP TABLE IF EXISTS `ik_event`;
CREATE TABLE `ik_event` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `cateid` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `subcateid` int(11) NOT NULL DEFAULT '0' COMMENT '子分类ID',
  `title` char(120) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `coordinate` varchar(255) NOT NULL DEFAULT '' COMMENT '地图坐标',
  `direction` varchar(255) NOT NULL DEFAULT '' COMMENT '乘车路线',  
  
  `begin_date` int(11) NOT NULL DEFAULT '0' COMMENT '当天活动开始日期',
  `end_date` int(11) NOT NULL DEFAULT '0' COMMENT '当天活动结束日期',
  `begin_time` varchar(255) NOT NULL DEFAULT '' COMMENT '当天活动开始时间',
  `end_time` varchar(255) NOT NULL DEFAULT '' COMMENT '当天活动结束时间',
  
  `repeat_type` int(11) NOT NULL DEFAULT '0' COMMENT '活动时间类型',
  `repeat_time` varchar(255) NOT NULL DEFAULT '' COMMENT '重复活动时间',
  
  `more_begin_day` varchar(255) NOT NULL DEFAULT '' COMMENT '重复活动时间',
  `more_end_day` varchar(255) NOT NULL DEFAULT '' COMMENT '重复活动时间',
  `one_begin_time` varchar(255) NOT NULL DEFAULT '' COMMENT '重复活动时间',
  `one_end_time` varchar(255) NOT NULL DEFAULT '' COMMENT '重复活动时间',
  
  `week_begin_day` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_end_day` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_begin_time` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_end_time` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_mon` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间 on',
  `week_tue` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_wed` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_thu` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_fri` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_sat` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  `week_sun` varchar(255) NOT NULL DEFAULT '' COMMENT '周活动时间',
  
  `loc_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市ID',
  `city` char(32) NOT NULL DEFAULT '' COMMENT '城市',
  `district_id` int(11) NOT NULL DEFAULT '0' COMMENT '街道ID',
  `region_id` int(11) NOT NULL DEFAULT '0' COMMENT '商圈ID',
  `street_address` char(255) NOT NULL DEFAULT '' COMMENT '详细地址',
  `fee` int(11) NOT NULL DEFAULT '0' COMMENT '是否免费 0免费 1收费',
  `fee_detail` char(255) NOT NULL DEFAULT '' COMMENT '费用详情',
  `poster` text NOT NULL COMMENT '海报图片',
  `count_userjion` int(11) NOT NULL DEFAULT '0' COMMENT '统计参加的',
  `count_userwish` int(11) NOT NULL DEFAULT '0' COMMENT '统计感兴趣的',
  `isaudit` int(1) NOT NULL DEFAULT '0' COMMENT '是否已经审核0默认1未审核',
  `isrecommend` int(1) NOT NULL DEFAULT '0' COMMENT '是否推荐0默认1推荐',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`eventid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='活动' AUTO_INCREMENT=1 ;