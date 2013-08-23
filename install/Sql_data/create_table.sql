-- --------------------------------------------------------

--
-- 表的结构 `ik_home_info`
--
DROP TABLE IF EXISTS `ik_home_info`;
CREATE TABLE `ik_home_info` (
  `infoid` int(11) NOT NULL AUTO_INCREMENT,
  `infokey` char(32) NOT NULL DEFAULT '',
  `infocontent` text NOT NULL,
  PRIMARY KEY (`infoid`),
  UNIQUE KEY `infokey` (`infokey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ik_home_info`
--

INSERT INTO `ik_home_info` (`infoid`, `infokey`, `infocontent`) VALUES
(1, 'about', '<h2>爱客网（IKPHP.COM）</h2>
<p  style="margin:5px 0px">爱客网是开放、多元的泛科技兴趣社区，并提供负责任、有智趣的科技内容。你可以在这里：</p> 
<ul style="margin:5px 0px">
<li style="list-style: disc inside none;">依兴趣关注不同的小站和小组，阅读有意思的科技内容；</li> 
<li style="list-style: disc inside none;">在"爱客问答"里提出困惑你的科技问题，或提供靠谱的答案；</li> 
<li style="list-style: disc inside none;">关注各个门类和领域的爱客达人，加入兴趣小组讨论，分享智趣话题。</li> 
</ul>      
<p  style="margin:5px 0px">爱客网的创始人是小麦，他是一位IT爱好者；热衷于PHP和前端开发，经过不懈的努力和追求；他在不断的完善爱客网；为广大爱好互联网科技者提供点点贡献。</p>
<p  style="margin:5px 0px">爱客网(IKPHH)社区将不断完善社区系统的建设，以简单和高扩展的形式为用户提供各种不同功能的社区应用，爱客网(IKPHH)开源社区将不断满足用户对社区建设和运营等方面的需求。</p>
<p  style="margin:5px 0px">爱客网是一个非盈利性个人网站， 它是在不违背社会主义道德底线的公益网站！它有着和其他社区同仁一样的激情！</p>
<p  style="margin:5px 0px">官方网站：<a href="http://www.ikphp.com/">http://www.ikphp.com</a></p>'),
(2, 'contact', '<p>Email:160780470#qq.com(#换@)</p>\r\n<p>QQ号:160780470</p>\r\n<p>QQ群:141611512 、288584398</p>\r\n<p>Location:北京 朝阳区 </p>'),
(3, 'agreement', '<p>1、爱客网(IKPHP)开源社区免费开源</p>\r\n<p>2、你可以免费使用爱客网(IKPHP)开源社区</p>\r\n<p>3、你可以在爱客网(IKPHP)开源社区基础上进行二次开发和修改</p>\r\n<p>4、你可以拿爱客网(IKPHP)开源社区建设你的商业运营网站</p>\r\n\r\n<p>5、在爱客网(IKPHP)开源社区未进行商业运作之前，爱客网(IKPHP)开源社区(小麦)将拥有对爱客网(IKPHP)开源社区的所有权，任何个人，公司和组织不得以任何形式和目的侵犯爱客网(IKPHP)开源社区的版权和著作权</p>\r\n<p>6、爱客网(IKPHP)开源社区拥有对此协议的修改和不断完善。</p>'),
(4, 'privacy', '<p>爱客网(IKPHP)开源社区（ikphp.com）以此声明对本站用户隐私保护的许诺。爱客网(IKPHP)开源社区的隐私声明正在不断改进中，随着本站服务范围的扩大，会随时更新隐私声明。我们欢迎你随时查看隐私声明。</p>');

-- --------------------------------------------------------

--
-- 表的结构 `ik_admin`
--

DROP TABLE IF EXISTS `ik_admin`;
CREATE TABLE `ik_admin` (
  `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` smallint(5) NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `last_time` int(10) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `user_name` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- 表的结构 `ik_user`
--
DROP TABLE IF EXISTS `ik_user`;
CREATE TABLE `ik_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码',  
  `username` char(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '用户email',
  `fuserid` int(11) NOT NULL DEFAULT '0' COMMENT '来自邀请用户',
  `doname` char(32) NOT NULL DEFAULT '',  
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `phone` char(16) NOT NULL DEFAULT '' COMMENT '电话号码',
  `roleid` int(11) NOT NULL DEFAULT '1' COMMENT '角色ID',
  `areaid` int(11) NOT NULL DEFAULT '0' COMMENT '区县ID',
  `path` char(32) NOT NULL DEFAULT '' COMMENT '头像路径',
  `face` char(64) NOT NULL DEFAULT '' COMMENT '会员头像',
  `signed` char(64) NOT NULL DEFAULT '' COMMENT '签名',
  `blog` char(32) NOT NULL DEFAULT '' COMMENT '博客',
  `about` char(255) NOT NULL DEFAULT '' COMMENT '关于我',
  `ip` varchar(16) NOT NULL DEFAULT '' COMMENT '登陆IP',
  `address` char(64) NOT NULL DEFAULT '',
  `qq_openid` char(32) NOT NULL DEFAULT '',
  `qq_access_token` char(32) NOT NULL DEFAULT '' COMMENT 'access_token',
  `count_score` int(11) NOT NULL DEFAULT '0' COMMENT '统计积分',
  `count_follow` int(11) NOT NULL DEFAULT '0' COMMENT '统计用户跟随的',
  `count_followed` int(11) NOT NULL DEFAULT '0' COMMENT '统计用户被跟随的',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是管理员',
  `isenable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用：0启用1禁用',
  `isverify` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未验证1验证',
  `verifycode` char(11) NOT NULL DEFAULT '' COMMENT '验证码',
  `resetpwd` char(32) NOT NULL DEFAULT '' COMMENT '重设密码',  
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `uptime` int(11) DEFAULT '0' COMMENT '登陆时间',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `qq_openid` (`qq_openid`),
  KEY `fuserid` (`fuserid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户';
-- --------------------------------------------------------

--
-- 表的结构 `ts_user_role` 2013年8月23日 新增积分表
--
DROP TABLE IF EXISTS `ik_user_score`;
CREATE TABLE `ik_user_score` (
  `scoreid` int(11) NOT NULL AUTO_INCREMENT COMMENT '积分ID',
  `actionname` char(64) NOT NULL DEFAULT '' COMMENT '积分名称',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '积分数',
  `maxnum` int(11) NOT NULL DEFAULT '0' COMMENT '积分数',
  PRIMARY KEY (`scoreid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户积分设置表' AUTO_INCREMENT=1 
--
-- 转存表中的数据 `ik_user_role` 2013年8月22日 新增等级表
--
-- --------------------------------------------------------

--
-- 表的结构 `ts_user_role`
--
DROP TABLE IF EXISTS `ik_user_role`;
CREATE TABLE `ik_user_role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `rolename` char(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `score_start` int(11) NOT NULL DEFAULT '0' COMMENT '积分开始',
  `score_end` int(11) NOT NULL DEFAULT '0' COMMENT '积分结束',
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='角色' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `ts_user_role`
--

INSERT INTO `ik_user_role` (`roleid`, `rolename`, `score_start`, `score_end`) VALUES
(1, '列兵', 0, 5000),
(2, '下士', 5000, 20000),
(3, '中士', 20000, 40000),
(4, '上士', 40000, 80000),
(5, '三级准尉', 80000, 160000),
(6, '二级准尉', 160000, 320000),
(7, '一级准尉', 320000, 640000),
(8, '少尉', 640000, 1280000),
(9, '中尉', 1280000, 2560000),
(10, '上尉', 2560000, 5120000),
(11, '少校', 5120000, 10240000),
(12, '中校', 10240000, 20480000),
(13, '上校', 20480000, 40960000),
(14, '准将', 40960000, 81920000),
(15, '少将', 81920000, 123840000),
(16, '中将', 123840000, 327680000),
(17, '上将', 327680000, 0);
-- --------------------------------------------------------

--
-- 表的结构 `ik_user_stat` 2013年8月22日 新加用户动作行为表
--
DROP TABLE IF EXISTS `ik_user_stat`;
CREATE TABLE `ik_user_stat` (
  `uid` int(10) unsigned NOT NULL,
  `action` varchar(20) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `last_time` int(10) unsigned NOT NULL,
  UNIQUE KEY `uid_type` (`uid`,`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- 表的结构 `ik_user_stat` 2013年8月22日 新加积分日志表
--
DROP TABLE IF EXISTS `ik_user_score_log`;
CREATE TABLE `ik_user_score_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `actionname` varchar(50) NOT NULL,
  `score` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- 表的结构 `ik_user_online`
--
DROP TABLE IF EXISTS `ik_user_online`;
CREATE TABLE `ik_user_online` (
  `userid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='在线用户';
-- --------------------------------------------------------

--
-- 表的结构 `ik_setting`
--
DROP TABLE IF EXISTS `ik_setting`;
CREATE TABLE `ik_setting` (
  `name` char(32) NOT NULL DEFAULT '' COMMENT '选项名字',
  `data` varchar(500) NOT NULL DEFAULT '' COMMENT '选项内容',
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统管理配置';

--
-- 转存表中的数据 `ik_system_options`
--

INSERT INTO `ik_setting` (`name`, `data`) VALUES
('site_title', '爱客网(IKPHP)开源社区'),
('site_subtitle', '又一个爱客网(IKPHP)开源社区'),
('site_url', 'http://'),
('site_email', 'admin@admin.com'),
('site_icp', '正在备案中'),
('site_keywords', 'IKPHP'),
('site_desc', '又一个爱客网(IKPHP)开源社区'),
('site_theme', 'blue'),
('isgzip', '0'),
('timezone', '8'),
('isinvite', '0'),
('charset', 'UTF-8'),
('integrate_code', 'default'),
('integrate_config', ''),
('avatar_size', '24,32,48,64,100,160,200'),
('attr_allow_exts', 'jpg,gif,png,jpeg'),
('attr_allow_size', '2048'),
('attach_path', 'data/upload/'),
('simg', 'a:2:{s:5:"width";s:3:"120";s:6:"height";s:3:"120";}'),
('mimg', 'a:2:{s:5:"width";s:3:"500";s:6:"height";s:3:"500";}'),
('bimg', 'a:2:{s:5:"width";s:4:"1000";s:6:"height";s:4:"1000";}'),
('mailhost', 'smtp.qq.com'),
('mailport', '25'),
('mailuser', 'test'),
('mailpwd', 'test');

-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- 表的结构 `ik_area`
--
DROP TABLE IF EXISTS `ik_area`;
CREATE TABLE `ik_area` (
  `areaid` int(11) NOT NULL AUTO_INCREMENT,
  `areaname` varchar(32) NOT NULL DEFAULT '',
  `zm` char(1) NOT NULL DEFAULT '' COMMENT '首字母',
  `referid` int(11) NOT NULL DEFAULT '0',
  `ishot` int(1) NOT NULL DEFAULT '0',
  `pinyin` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`areaid`),
  KEY `referid` (`referid`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8 COMMENT='本地化';

-- ----------------------------
-- Records of ik_area
-- ----------------------------
INSERT INTO `ik_area` VALUES ('1', '北京', 'B', '0', '1', 'beijing');
INSERT INTO `ik_area` VALUES ('2', '上海', 'S', '0', '1', 'shanghai');
INSERT INTO `ik_area` VALUES ('3', '广东', 'G', '0', '0', 'guangdong');
INSERT INTO `ik_area` VALUES ('4', '江苏', 'J', '0', '0', 'jiangsu');
INSERT INTO `ik_area` VALUES ('5', '浙江', 'Z', '0', '0', 'zhejiang');
INSERT INTO `ik_area` VALUES ('6', '山东', 'S', '0', '0', 'shandong');
INSERT INTO `ik_area` VALUES ('7', '四川', 'S', '0', '0', 'sichuan');
INSERT INTO `ik_area` VALUES ('8', '湖北', 'H', '0', '0', 'hubei');
INSERT INTO `ik_area` VALUES ('9', '福建', 'F', '0', '0', 'fujian');
INSERT INTO `ik_area` VALUES ('10', '河南', 'H', '0', '0', 'henan');
INSERT INTO `ik_area` VALUES ('11', '辽宁', 'L', '0', '0', 'liaoning');
INSERT INTO `ik_area` VALUES ('12', '陕西', 'S', '0', '0', 'shanxi');
INSERT INTO `ik_area` VALUES ('13', '湖南', 'H', '0', '0', 'hunan');
INSERT INTO `ik_area` VALUES ('14', '河北', 'H', '0', '0', 'hebei');
INSERT INTO `ik_area` VALUES ('15', '安徽', 'A', '0', '0', 'anhui');
INSERT INTO `ik_area` VALUES ('16', '黑龙江', 'H', '0', '0', 'heilongjiang');
INSERT INTO `ik_area` VALUES ('17', '重庆', 'C', '0', '0', 'zhongqing');
INSERT INTO `ik_area` VALUES ('18', '天津', 'T', '0', '0', 'tianjin');
INSERT INTO `ik_area` VALUES ('19', '广西', 'G', '0', '0', 'guangxi');
INSERT INTO `ik_area` VALUES ('20', '山西', 'S', '0', '0', 'shanxi');
INSERT INTO `ik_area` VALUES ('21', '江西', 'J', '0', '0', 'jiangxi');
INSERT INTO `ik_area` VALUES ('22', '吉林', 'J', '0', '0', 'jilin');
INSERT INTO `ik_area` VALUES ('23', '云南', 'Y', '0', '0', 'yunnan');
INSERT INTO `ik_area` VALUES ('24', '内蒙古', 'N', '0', '0', 'neimenggu');
INSERT INTO `ik_area` VALUES ('25', '贵州', 'G', '0', '0', 'guizhou');
INSERT INTO `ik_area` VALUES ('26', '甘肃', 'G', '0', '0', 'gansu');
INSERT INTO `ik_area` VALUES ('27', '新疆', 'X', '0', '0', 'xinjiang');
INSERT INTO `ik_area` VALUES ('28', '海南', 'H', '0', '0', 'hainan');
INSERT INTO `ik_area` VALUES ('29', '宁夏', 'N', '0', '0', 'ningxia');
INSERT INTO `ik_area` VALUES ('30', '青海', 'Q', '0', '0', 'qinghai');
INSERT INTO `ik_area` VALUES ('31', '西藏', 'X', '0', '0', 'xicang');
INSERT INTO `ik_area` VALUES ('32', '香港', 'X', '0', '0', 'xianggang');
INSERT INTO `ik_area` VALUES ('33', '澳门', 'A', '0', '0', 'aomen');
INSERT INTO `ik_area` VALUES ('34', '台湾', 'T', '0', '0', 'taiwan');
INSERT INTO `ik_area` VALUES ('35', '钓鱼岛', 'D', '0', '0', 'diaoyudao');
INSERT INTO `ik_area` VALUES ('36', '东城区', 'D', '1', '0', 'dongchengqu');
INSERT INTO `ik_area` VALUES ('37', '西城区', 'X', '1', '0', 'xichengqu');
INSERT INTO `ik_area` VALUES ('38', '朝阳区', 'C', '1', '0', 'chaoyangqu');
INSERT INTO `ik_area` VALUES ('39', '丰台区', 'F', '1', '0', 'fengtaiqu');
INSERT INTO `ik_area` VALUES ('40', '石景山区', 'S', '1', '0', 'shijingshanqu');
INSERT INTO `ik_area` VALUES ('41', '海淀区', 'H', '1', '0', 'haidianqu');
INSERT INTO `ik_area` VALUES ('42', '门头沟区', 'M', '1', '0', 'mentougouqu');
INSERT INTO `ik_area` VALUES ('43', '房山区', 'F', '1', '0', 'fangshanqu');
INSERT INTO `ik_area` VALUES ('44', '通州区', 'T', '1', '0', 'tongzhouqu');
INSERT INTO `ik_area` VALUES ('45', '顺义区', 'S', '1', '0', 'shunyiqu');
INSERT INTO `ik_area` VALUES ('46', '昌平区', 'C', '1', '0', 'changpingqu');
INSERT INTO `ik_area` VALUES ('47', '大兴区', 'D', '1', '0', 'daxingqu');
INSERT INTO `ik_area` VALUES ('48', '怀柔区', 'H', '1', '0', 'huairouqu');
INSERT INTO `ik_area` VALUES ('49', '平谷区', 'P', '1', '0', 'pingguqu');
INSERT INTO `ik_area` VALUES ('50', '密云县', 'M', '1', '0', 'miyunxian');
INSERT INTO `ik_area` VALUES ('51', '延庆县', 'Y', '1', '0', 'yanqingxian');
INSERT INTO `ik_area` VALUES ('52', '地安门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('53', '和平里', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('54', '王府井/东单', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('55', '建国门/北京站', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('56', '东四', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('57', '安定门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('58', '朝阳门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('59', '东直门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('60', '广渠门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('61', '左安门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('62', '沙子口', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('63', '前门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('64', '崇文门', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('65', '天坛', '', '36', '0', '');
INSERT INTO `ik_area` VALUES ('85', '杨浦区', 'Y', '2', '0', 'yangpuqu');
INSERT INTO `ik_area` VALUES ('83', '闸北区', 'Z', '2', '0', 'zhabeiqu');
INSERT INTO `ik_area` VALUES ('82', '普陀区', 'P', '2', '0', 'putuoqu');
INSERT INTO `ik_area` VALUES ('80', '长宁区', 'C', '2', '0', 'changningqu');
INSERT INTO `ik_area` VALUES ('79', '徐汇区', 'X', '2', '0', 'xuhuiqu');
INSERT INTO `ik_area` VALUES ('78', '黄浦区', 'H', '2', '0', 'huangpuqu');
INSERT INTO `ik_area` VALUES ('84', '虹口区', 'H', '2', '0', 'hongkouqu');
INSERT INTO `ik_area` VALUES ('81', '静安区', 'J', '2', '0', 'jinganqu');
INSERT INTO `ik_area` VALUES ('66', '呼和浩特', 'H', '24', '0', 'huhehaote');
INSERT INTO `ik_area` VALUES ('67', '包头', 'B', '24', '0', 'baotou');
INSERT INTO `ik_area` VALUES ('68', '呼伦贝尔', 'H', '24', '0', 'hulunbeier');
INSERT INTO `ik_area` VALUES ('69', '赤峰', 'C', '24', '0', 'chifeng');
INSERT INTO `ik_area` VALUES ('70', '鄂尔多斯', 'E', '24', '0', 'eerduosi');
INSERT INTO `ik_area` VALUES ('71', '通辽', 'T', '24', '0', 'tongliao');
INSERT INTO `ik_area` VALUES ('72', '锡林郭勒', 'X', '24', '0', 'xilinguole');
INSERT INTO `ik_area` VALUES ('73', '巴彦淖尔', 'B', '24', '0', 'bayannaoer');
INSERT INTO `ik_area` VALUES ('74', '兴安盟', 'X', '24', '0', 'xinganmeng');
INSERT INTO `ik_area` VALUES ('75', '乌海', 'W', '24', '0', 'wuhai');
INSERT INTO `ik_area` VALUES ('76', '乌兰察布', 'W', '24', '0', 'wulanchabu');
INSERT INTO `ik_area` VALUES ('77', '阿拉善盟', 'A', '24', '0', 'alashanmeng');
INSERT INTO `ik_area` VALUES ('86', '闵行区', '', '2', '0', 'xingqu');
INSERT INTO `ik_area` VALUES ('87', '宝山区', 'B', '2', '0', 'baoshanqu');
INSERT INTO `ik_area` VALUES ('88', '嘉定区', 'J', '2', '0', 'jiadingqu');
INSERT INTO `ik_area` VALUES ('89', '浦东新区', 'P', '2', '0', 'pudongxinqu');
INSERT INTO `ik_area` VALUES ('90', '金山区', 'J', '2', '0', 'jinshanqu');
INSERT INTO `ik_area` VALUES ('91', '松江区', 'S', '2', '0', 'songjiangqu');
INSERT INTO `ik_area` VALUES ('92', '青浦区', 'Q', '2', '0', 'qingpuqu');
INSERT INTO `ik_area` VALUES ('93', '奉贤区', 'F', '2', '0', 'fengxianqu');
INSERT INTO `ik_area` VALUES ('94', '崇明县', 'C', '2', '0', 'chongmingxian');
INSERT INTO `ik_area` VALUES ('95', '广州', 'G', '3', '1', 'guangzhou');
INSERT INTO `ik_area` VALUES ('96', '深圳', 'S', '3', '1', 'shen');
INSERT INTO `ik_area` VALUES ('97', '东莞', 'D', '3', '1', 'dong');
INSERT INTO `ik_area` VALUES ('98', '佛山', 'F', '3', '0', 'foshan');
INSERT INTO `ik_area` VALUES ('99', '汕头', 'S', '3', '0', 'shantou');
INSERT INTO `ik_area` VALUES ('100', '珠海', 'Z', '3', '0', 'zhuhai');
INSERT INTO `ik_area` VALUES ('101', '惠州', 'H', '3', '0', 'huizhou');
INSERT INTO `ik_area` VALUES ('102', '中山', 'Z', '3', '0', 'zhongshan');
INSERT INTO `ik_area` VALUES ('103', '江门', 'J', '3', '0', 'jiangmen');
INSERT INTO `ik_area` VALUES ('104', '揭阳', 'J', '3', '0', 'jieyang');
INSERT INTO `ik_area` VALUES ('105', '湛江', 'Z', '3', '0', 'zhanjiang');
INSERT INTO `ik_area` VALUES ('106', '茂名', 'M', '3', '0', 'maoming');
INSERT INTO `ik_area` VALUES ('107', '潮州', 'C', '3', '0', 'chaozhou');
INSERT INTO `ik_area` VALUES ('108', '梅州', 'M', '3', '0', 'meizhou');
INSERT INTO `ik_area` VALUES ('109', '肇庆', 'Z', '3', '0', 'zhaoqing');
INSERT INTO `ik_area` VALUES ('110', '韶关', 'S', '3', '0', 'shaoguan');
INSERT INTO `ik_area` VALUES ('111', '清远', 'Q', '3', '0', 'qingyuan');
INSERT INTO `ik_area` VALUES ('112', '河源', 'H', '3', '0', 'heyuan');
INSERT INTO `ik_area` VALUES ('113', '汕尾', 'S', '3', '0', 'shanwei');
INSERT INTO `ik_area` VALUES ('114', '阳江', 'Y', '3', '0', 'yangjiang');
INSERT INTO `ik_area` VALUES ('115', '云浮', 'Y', '3', '0', 'yunfu');
INSERT INTO `ik_area` VALUES ('116', '南京', 'N', '4', '0', 'nanjing');
INSERT INTO `ik_area` VALUES ('117', '苏州', 'S', '4', '0', 'suzhou');
INSERT INTO `ik_area` VALUES ('118', '昆山', 'K', '4', '0', 'kunshan');
INSERT INTO `ik_area` VALUES ('119', '常熟', 'C', '4', '0', 'changshu');
INSERT INTO `ik_area` VALUES ('120', '张家港', 'Z', '4', '0', 'zhangjiagang');
INSERT INTO `ik_area` VALUES ('121', '太仓', 'T', '4', '0', 'taicang');
INSERT INTO `ik_area` VALUES ('122', '无锡', 'W', '4', '0', 'wuxi');
INSERT INTO `ik_area` VALUES ('123', '江阴', 'J', '4', '0', 'jiangyin');
INSERT INTO `ik_area` VALUES ('124', '常州', 'C', '4', '0', 'changzhou');
INSERT INTO `ik_area` VALUES ('125', '徐州', 'X', '4', '0', 'xuzhou');
INSERT INTO `ik_area` VALUES ('126', '南通', 'N', '4', '0', 'nantong');
INSERT INTO `ik_area` VALUES ('127', '如皋', 'R', '4', '0', 'rugao');
INSERT INTO `ik_area` VALUES ('128', '启东', 'Q', '4', '0', 'qidong');
INSERT INTO `ik_area` VALUES ('129', '扬州', 'Y', '4', '0', 'yangzhou');
INSERT INTO `ik_area` VALUES ('130', '盐城', 'Y', '4', '0', 'yancheng');
INSERT INTO `ik_area` VALUES ('131', '连云港', 'L', '4', '0', 'lianyungang');
INSERT INTO `ik_area` VALUES ('132', '镇江', 'Z', '4', '0', 'zhenjiang');
INSERT INTO `ik_area` VALUES ('133', '泰州', 'T', '4', '0', 'taizhou');
INSERT INTO `ik_area` VALUES ('134', '淮安', 'H', '4', '0', 'huaian');
INSERT INTO `ik_area` VALUES ('135', '宿迁', 'S', '4', '0', 'suqian');
INSERT INTO `ik_area` VALUES ('136', '杭州', 'H', '5', '1', 'hangzhou');
INSERT INTO `ik_area` VALUES ('137', '温州', 'W', '5', '0', 'wenzhou');
INSERT INTO `ik_area` VALUES ('138', '宁波', 'N', '5', '0', 'ningbo');
INSERT INTO `ik_area` VALUES ('139', '台州', 'T', '5', '0', 'taizhou');
INSERT INTO `ik_area` VALUES ('140', '金华', 'J', '5', '0', 'jinhua');
INSERT INTO `ik_area` VALUES ('141', '嘉兴', 'J', '5', '0', 'jiaxing');
INSERT INTO `ik_area` VALUES ('142', '绍兴', 'S', '5', '0', 'shaoxing');
INSERT INTO `ik_area` VALUES ('143', '湖州', 'H', '5', '0', 'huzhou');
INSERT INTO `ik_area` VALUES ('144', '丽水', 'L', '5', '0', 'lishui');
INSERT INTO `ik_area` VALUES ('145', '衢州', 'Q', '5', '0', 'quzhou');
INSERT INTO `ik_area` VALUES ('146', '舟山', 'Z', '5', '0', 'zhoushan');
INSERT INTO `ik_area` VALUES ('147', '青岛', 'Q', '6', '1', 'qingdao');
INSERT INTO `ik_area` VALUES ('148', '济南', 'J', '6', '0', 'jinan');
INSERT INTO `ik_area` VALUES ('149', '烟台', 'Y', '6', '0', 'yantai');
INSERT INTO `ik_area` VALUES ('150', '潍坊', 'W', '6', '0', 'weifang');
INSERT INTO `ik_area` VALUES ('151', '临沂', 'L', '6', '0', 'linyi');
INSERT INTO `ik_area` VALUES ('152', '淄博', 'Z', '6', '0', 'zibo');
INSERT INTO `ik_area` VALUES ('153', '济宁', 'J', '6', '0', 'jining');
INSERT INTO `ik_area` VALUES ('154', '威海', 'W', '6', '0', 'weihai');
INSERT INTO `ik_area` VALUES ('155', '泰安', 'T', '6', '0', 'taian');
INSERT INTO `ik_area` VALUES ('156', '聊城', 'L', '6', '0', 'liaocheng');
INSERT INTO `ik_area` VALUES ('157', '东营', 'D', '6', '0', 'dongying');
INSERT INTO `ik_area` VALUES ('158', '枣庄', 'Z', '6', '0', 'zaozhuang');
INSERT INTO `ik_area` VALUES ('159', '菏泽', 'H', '6', '0', 'heze');
INSERT INTO `ik_area` VALUES ('160', '日照', 'R', '6', '0', 'rizhao');
INSERT INTO `ik_area` VALUES ('161', '德州', 'D', '6', '0', 'dezhou');
INSERT INTO `ik_area` VALUES ('162', '滨州', 'B', '6', '0', 'binzhou');
INSERT INTO `ik_area` VALUES ('163', '莱芜', 'L', '6', '0', 'laiwu');
INSERT INTO `ik_area` VALUES ('164', '成都', 'C', '7', '1', 'chengdu');
INSERT INTO `ik_area` VALUES ('165', '绵阳', 'M', '7', '0', 'mianyang');
INSERT INTO `ik_area` VALUES ('166', '南充', 'N', '7', '0', 'nanchong');
INSERT INTO `ik_area` VALUES ('167', '德阳', 'D', '7', '0', 'deyang');
INSERT INTO `ik_area` VALUES ('168', '达州', 'D', '7', '0', 'dazhou');
INSERT INTO `ik_area` VALUES ('169', '乐山', 'L', '7', '0', 'leshan');
INSERT INTO `ik_area` VALUES ('170', '宜宾', 'Y', '7', '0', 'yibin');
INSERT INTO `ik_area` VALUES ('171', '内江', 'N', '7', '0', 'neijiang');
INSERT INTO `ik_area` VALUES ('172', '自贡', 'Z', '7', '0', 'zigong');
INSERT INTO `ik_area` VALUES ('173', '泸州', '', '7', '0', 'zhou');
INSERT INTO `ik_area` VALUES ('174', '遂宁', 'S', '7', '0', 'suining');
INSERT INTO `ik_area` VALUES ('175', '广安', 'G', '7', '0', 'guangan');
INSERT INTO `ik_area` VALUES ('176', '眉山', 'M', '7', '0', 'meishan');
INSERT INTO `ik_area` VALUES ('177', '广元', 'G', '7', '0', 'guangyuan');
INSERT INTO `ik_area` VALUES ('178', '攀枝花', 'P', '7', '0', 'panzhihua');
INSERT INTO `ik_area` VALUES ('179', '资阳', 'Z', '7', '0', 'ziyang');
INSERT INTO `ik_area` VALUES ('180', '凉山', 'L', '7', '0', 'liangshan');
INSERT INTO `ik_area` VALUES ('181', '巴中', 'B', '7', '0', 'bazhong');
INSERT INTO `ik_area` VALUES ('182', '雅安', 'Y', '7', '0', 'yaan');
INSERT INTO `ik_area` VALUES ('183', '阿坝', 'A', '7', '0', 'aba');
INSERT INTO `ik_area` VALUES ('184', '甘孜', 'G', '7', '0', 'ganzi');
INSERT INTO `ik_area` VALUES ('185', '武汉', 'W', '8', '0', 'wuhan');
INSERT INTO `ik_area` VALUES ('186', '宜昌', 'Y', '8', '0', 'yichang');
INSERT INTO `ik_area` VALUES ('187', '荆州', 'J', '8', '0', 'jingzhou');
INSERT INTO `ik_area` VALUES ('188', '襄阳', 'X', '8', '0', 'xiangyang');
INSERT INTO `ik_area` VALUES ('189', '十堰', 'S', '8', '0', 'shiyan');
INSERT INTO `ik_area` VALUES ('190', '黄冈', 'H', '8', '0', 'huanggang');
INSERT INTO `ik_area` VALUES ('191', '黄石', 'H', '8', '0', 'huangshi');
INSERT INTO `ik_area` VALUES ('192', '孝感', 'X', '8', '0', 'xiaogan');
INSERT INTO `ik_area` VALUES ('193', '荆门', 'J', '8', '0', 'jingmen');
INSERT INTO `ik_area` VALUES ('194', '咸宁', 'X', '8', '0', 'xianning');
INSERT INTO `ik_area` VALUES ('195', '恩施', 'E', '8', '0', 'enshi');
INSERT INTO `ik_area` VALUES ('196', '随州', 'S', '8', '0', 'suizhou');
INSERT INTO `ik_area` VALUES ('197', '鄂州', 'E', '8', '0', 'ezhou');
INSERT INTO `ik_area` VALUES ('198', '仙桃', 'X', '8', '0', 'xiantao');
INSERT INTO `ik_area` VALUES ('199', '天门', 'T', '8', '0', 'tianmen');
INSERT INTO `ik_area` VALUES ('200', '潜江', 'Q', '8', '0', 'qianjiang');
INSERT INTO `ik_area` VALUES ('201', '神农架林区', 'S', '8', '0', 'shennongjialinqu');

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- 表的结构 `ik_images`
--
DROP TABLE IF EXISTS `ik_images`;
CREATE TABLE `ik_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `seqid` int(11) NOT NULL DEFAULT '0' COMMENT 'seqid',
  `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '日记ID或帖子id',
  `type` char(64) NOT NULL DEFAULT '0' COMMENT '日记或帖子或其他组件',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` char(64) NOT NULL DEFAULT '' COMMENT '文件名',
  `path` char(32) NOT NULL DEFAULT '' COMMENT '源文件路径',
  `size` char(32) NOT NULL DEFAULT '',
  `title` char(120) NOT NULL DEFAULT '' COMMENT '图片描述',
  `align` char(32) NOT NULL DEFAULT 'C' COMMENT '图片对齐方式',
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ik_videos`
--
DROP TABLE IF EXISTS `ik_videos`;
CREATE TABLE `ik_videos` (
  `videoid` int(11) NOT NULL AUTO_INCREMENT COMMENT '视频id',
  `seqid` int(11) NOT NULL DEFAULT '0' COMMENT '顺序id',
  `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '日记ID或帖子id',
  `type` char(64) NOT NULL DEFAULT '0' COMMENT '日记或帖子或其他组件',
  `userid` int(11) NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '视频网址',
  `imgurl` char(255) NOT NULL DEFAULT '' COMMENT '视频截图',
  `videourl` char(255) NOT NULL DEFAULT '' COMMENT 'swf地址',
  `title` char(120) NOT NULL DEFAULT '' COMMENT '视频标题',
  `count_view` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`videoid`),
  KEY `typeid` (`typeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `ik_user_follow`
--
DROP TABLE IF EXISTS `ik_user_follow`;
CREATE TABLE `ik_user_follow` (
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `userid_follow` int(11) NOT NULL DEFAULT '0' COMMENT '被关注的用户ID',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  UNIQUE KEY `userid_2` (`userid`,`userid_follow`),
  KEY `userid` (`userid`),
  KEY `userid_follow` (`userid_follow`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户关注跟随';
-- --------------------------------------------------------

--
-- 表的结构 `ik_tag`
--
DROP TABLE IF EXISTS `ik_tag`;
CREATE TABLE `ik_tag` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` char(16) NOT NULL DEFAULT '',
  `count_user` int(11) NOT NULL DEFAULT '0',
  `count_group` int(11) NOT NULL DEFAULT '0',
  `count_topic` int(11) NOT NULL DEFAULT '0',
  `count_bang` int(11) NOT NULL DEFAULT '0',
  `count_article` int(11) NOT NULL DEFAULT '0',
  `count_note` int(11) NOT NULL DEFAULT '0',
  `count_site` int(11) NOT NULL DEFAULT '0',
  `isenable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可用',
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `tagname` (`tagname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
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
-- 第三方登陆 `ik_oauth`
--
DROP TABLE IF EXISTS `ik_oauth`;
CREATE TABLE `ik_oauth` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `config` text NOT NULL,
  `desc` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `ordid` tinyint(3) unsigned NOT NULL DEFAULT '255',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `ik_oauth` (`id`, `code`, `name`, `config`, `desc`, `author`, `ordid`, `status`) VALUES
(1, 'qq', 'QQ登录', 'a:2:{s:7:"app_key";s:9:"100401235";s:10:"app_secret";s:32:"567e145f267ccde6694acb2c2582cf42";}', '申请地址：http://connect.opensns.qq.com/', 'IKPHP TEAM', 1, 1),
(2, 'sina', '微博登陆', 'a:2:{s:7:"app_key";s:10:"1001094537";s:10:"app_secret";s:32:"4228d0fe4e7000c37aad1727c1cca385";}', '申请地址：http://open.weibo.com/', 'IKPHP TEAM', 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ik_user_bind`
--

DROP TABLE IF EXISTS `ik_user_bind`;
CREATE TABLE `ik_user_bind` (
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(60) NOT NULL,
  `keyid` varchar(100) NOT NULL,
  `info` text NOT NULL,
  KEY `uid` (`uid`),
  KEY `uid_type` (`uid`,`type`),
  KEY `type_keyid` (`type`,`keyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ik_message`
--
DROP TABLE IF EXISTS `ik_message`;
CREATE TABLE `ik_message` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息ID',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '发送用户ID',
  `touserid` int(11) NOT NULL DEFAULT '0' COMMENT '接收消息的用户ID',
  `title` char(64) NOT NULL DEFAULT '' COMMENT '标题',  
  `content` text NOT NULL COMMENT '内容',
  `isread` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读',
  `isspam` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否垃圾邮件',  
  `isinbox` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在收件箱显示',  
  `isoutbox` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在发件箱显示',  
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`messageid`),
  KEY `touserid` (`touserid`,`isread`),
  KEY `userid` (`userid`,`touserid`,`isread`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='短消息表' AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `ik_words`
--
DROP TABLE IF EXISTS `ik_words`;
CREATE TABLE `ik_words` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `admin` varchar(50) NOT NULL,
  `find` varchar(255) NOT NULL DEFAULT '' COMMENT '违禁词语',  
  `replacement` varchar(255) NOT NULL DEFAULT '' COMMENT '替换词',  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='词组过滤' AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `ik_downcount`
--
DROP TABLE IF EXISTS `ik_downcount`;
CREATE TABLE `ik_downcount` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userip` char(64) NOT NULL DEFAULT '' COMMENT '下载者ip',    
  `downfrom` char(64) NOT NULL DEFAULT '' COMMENT '下载来源',       
  `downtime` int(11) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='统计下载次数';

-- --------------------------------------------------------

--
-- 表的结构 `ik_app`
--
DROP TABLE IF EXISTS `ik_app`;
CREATE TABLE `ik_app` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) NOT NULL COMMENT 'app名称',
  `app_alias` varchar(255) NOT NULL COMMENT 'app别名',
  `description` text COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:''关闭'',1:开启',
  `host_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0，1',
  `app_entry` varchar(255) DEFAULT NULL COMMENT '前台入口，例：''group/index''',
  `icon_url` varchar(255) DEFAULT NULL COMMENT '小图标地址',
  `large_icon_url` varchar(255) DEFAULT NULL COMMENT '图标地址',
  `admin_entry` varchar(255) DEFAULT NULL COMMENT '后台管理地址',
  `statistics_entry` varchar(255) DEFAULT NULL COMMENT '接口地址',
  `display_order` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `setuptime` int(11) DEFAULT NULL COMMENT '安装时间戳',
  `version` varchar(255) DEFAULT NULL COMMENT '版本号',
  `api_key` varchar(255) DEFAULT NULL COMMENT '用户api_key',
  `secure_key` varchar(255) DEFAULT NULL COMMENT 'API密钥',
  `author_name` varchar(255) NOT NULL COMMENT '作者',
  `author_url` varchar(255) DEFAULT NULL COMMENT '作者网站',
  `is_nav` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:''否'',1:是',
  `child_menu` text NOT NULL COMMENT '子导航数据',
  PRIMARY KEY (`app_id`),
  KEY `app_name` (`app_name`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;