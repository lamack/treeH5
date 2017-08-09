-- ----------------------------
--  Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '会员名称',
  `area` varchar(255) DEFAULT NULL COMMENT '所在区域',
  `company` varchar(255) DEFAULT NULL COMMENT '所在企业',
  `class` varchar(255) DEFAULT NULL COMMENT '所在班组',
  `mileage` int(10) unsigned NOT NULL COMMENT '里程数',
  `green` int(10) unsigned NOT NULL COMMENT '绿值',
  `green_max` int(10) unsigned NOT NULL COMMENT '最大绿值',
  `share` int(10) unsigned NOT NULL COMMENT '享币',
  `trees` int(10) unsigned NOT NULL COMMENT '树苗',
  `contact` varchar(255) DEFAULT NULL COMMENT '联系方式',
  `contact_address` varchar(255) DEFAULT NULL COMMENT '联系地址',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `sign` varchar(100) DEFAULT NULL COMMENT '用户标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;