/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50622
 Source Host           : localhost
 Source Database       : dolphin

 Target Server Type    : MySQL
 Target Server Version : 50622
 File Encoding         : utf-8

 Date: 08/14/2017 10:24:10 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `game_admin_access`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_access`;
CREATE TABLE `game_admin_access` (
  `module` varchar(16) NOT NULL DEFAULT '' COMMENT '模型名称',
  `group` varchar(16) NOT NULL DEFAULT '' COMMENT '权限分组标识',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `nid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '授权节点id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='统一授权表';

-- ----------------------------
--  Table structure for `game_admin_action`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_action`;
CREATE TABLE `game_admin_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(16) NOT NULL DEFAULT '' COMMENT '所属模块名',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '行为标题',
  `remark` varchar(128) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='系统行为表';

-- ----------------------------
--  Records of `game_admin_action`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_action` VALUES ('1', 'user', 'user_add', '添加用户', '添加用户', '', '[user|get_nickname] 添加了用户：[record|get_nickname]', '1', '1480156399', '1480163853'), ('2', 'user', 'user_edit', '编辑用户', '编辑用户', '', '[user|get_nickname] 编辑了用户：[details]', '1', '1480164578', '1480297748'), ('3', 'user', 'user_delete', '删除用户', '删除用户', '', '[user|get_nickname] 删除了用户：[details]', '1', '1480168582', '1480168616'), ('4', 'user', 'user_enable', '启用用户', '启用用户', '', '[user|get_nickname] 启用了用户：[details]', '1', '1480169185', '1480169185'), ('5', 'user', 'user_disable', '禁用用户', '禁用用户', '', '[user|get_nickname] 禁用了用户：[details]', '1', '1480169214', '1480170581'), ('6', 'user', 'user_access', '用户授权', '用户授权', '', '[user|get_nickname] 对用户：[record|get_nickname] 进行了授权操作。详情：[details]', '1', '1480221441', '1480221563'), ('7', 'user', 'role_add', '添加角色', '添加角色', '', '[user|get_nickname] 添加了角色：[details]', '1', '1480251473', '1480251473'), ('8', 'user', 'role_edit', '编辑角色', '编辑角色', '', '[user|get_nickname] 编辑了角色：[details]', '1', '1480252369', '1480252369'), ('9', 'user', 'role_delete', '删除角色', '删除角色', '', '[user|get_nickname] 删除了角色：[details]', '1', '1480252580', '1480252580'), ('10', 'user', 'role_enable', '启用角色', '启用角色', '', '[user|get_nickname] 启用了角色：[details]', '1', '1480252620', '1480252620'), ('11', 'user', 'role_disable', '禁用角色', '禁用角色', '', '[user|get_nickname] 禁用了角色：[details]', '1', '1480252651', '1480252651'), ('12', 'user', 'attachment_enable', '启用附件', '启用附件', '', '[user|get_nickname] 启用了附件：附件ID([details])', '1', '1480253226', '1480253332'), ('13', 'user', 'attachment_disable', '禁用附件', '禁用附件', '', '[user|get_nickname] 禁用了附件：附件ID([details])', '1', '1480253267', '1480253340'), ('14', 'user', 'attachment_delete', '删除附件', '删除附件', '', '[user|get_nickname] 删除了附件：附件ID([details])', '1', '1480253323', '1480253323'), ('15', 'admin', 'config_add', '添加配置', '添加配置', '', '[user|get_nickname] 添加了配置，[details]', '1', '1480296196', '1480296196'), ('16', 'admin', 'config_edit', '编辑配置', '编辑配置', '', '[user|get_nickname] 编辑了配置：[details]', '1', '1480296960', '1480296960'), ('17', 'admin', 'config_enable', '启用配置', '启用配置', '', '[user|get_nickname] 启用了配置：[details]', '1', '1480298479', '1480298479'), ('18', 'admin', 'config_disable', '禁用配置', '禁用配置', '', '[user|get_nickname] 禁用了配置：[details]', '1', '1480298506', '1480298506'), ('19', 'admin', 'config_delete', '删除配置', '删除配置', '', '[user|get_nickname] 删除了配置：[details]', '1', '1480298532', '1480298532'), ('20', 'admin', 'database_export', '备份数据库', '备份数据库', '', '[user|get_nickname] 备份了数据库：[details]', '1', '1480298946', '1480298946'), ('21', 'admin', 'database_import', '还原数据库', '还原数据库', '', '[user|get_nickname] 还原了数据库：[details]', '1', '1480301990', '1480302022'), ('22', 'admin', 'database_optimize', '优化数据表', '优化数据表', '', '[user|get_nickname] 优化了数据表：[details]', '1', '1480302616', '1480302616'), ('23', 'admin', 'database_repair', '修复数据表', '修复数据表', '', '[user|get_nickname] 修复了数据表：[details]', '1', '1480302798', '1480302798'), ('24', 'admin', 'database_backup_delete', '删除数据库备份', '删除数据库备份', '', '[user|get_nickname] 删除了数据库备份：[details]', '1', '1480302870', '1480302870'), ('25', 'admin', 'hook_add', '添加钩子', '添加钩子', '', '[user|get_nickname] 添加了钩子：[details]', '1', '1480303198', '1480303198'), ('26', 'admin', 'hook_edit', '编辑钩子', '编辑钩子', '', '[user|get_nickname] 编辑了钩子：[details]', '1', '1480303229', '1480303229'), ('27', 'admin', 'hook_delete', '删除钩子', '删除钩子', '', '[user|get_nickname] 删除了钩子：[details]', '1', '1480303264', '1480303264'), ('28', 'admin', 'hook_enable', '启用钩子', '启用钩子', '', '[user|get_nickname] 启用了钩子：[details]', '1', '1480303294', '1480303294'), ('29', 'admin', 'hook_disable', '禁用钩子', '禁用钩子', '', '[user|get_nickname] 禁用了钩子：[details]', '1', '1480303409', '1480303409'), ('30', 'admin', 'menu_add', '添加节点', '添加节点', '', '[user|get_nickname] 添加了节点：[details]', '1', '1480305468', '1480305468'), ('31', 'admin', 'menu_edit', '编辑节点', '编辑节点', '', '[user|get_nickname] 编辑了节点：[details]', '1', '1480305513', '1480305513'), ('32', 'admin', 'menu_delete', '删除节点', '删除节点', '', '[user|get_nickname] 删除了节点：[details]', '1', '1480305562', '1480305562'), ('33', 'admin', 'menu_enable', '启用节点', '启用节点', '', '[user|get_nickname] 启用了节点：[details]', '1', '1480305630', '1480305630'), ('34', 'admin', 'menu_disable', '禁用节点', '禁用节点', '', '[user|get_nickname] 禁用了节点：[details]', '1', '1480305659', '1480305659'), ('35', 'admin', 'module_install', '安装模块', '安装模块', '', '[user|get_nickname] 安装了模块：[details]', '1', '1480307558', '1480307558'), ('36', 'admin', 'module_uninstall', '卸载模块', '卸载模块', '', '[user|get_nickname] 卸载了模块：[details]', '1', '1480307588', '1480307588'), ('37', 'admin', 'module_enable', '启用模块', '启用模块', '', '[user|get_nickname] 启用了模块：[details]', '1', '1480307618', '1480307618'), ('38', 'admin', 'module_disable', '禁用模块', '禁用模块', '', '[user|get_nickname] 禁用了模块：[details]', '1', '1480307653', '1480307653'), ('39', 'admin', 'module_export', '导出模块', '导出模块', '', '[user|get_nickname] 导出了模块：[details]', '1', '1480307682', '1480307682'), ('40', 'admin', 'packet_install', '安装数据包', '安装数据包', '', '[user|get_nickname] 安装了数据包：[details]', '1', '1480308342', '1480308342'), ('41', 'admin', 'packet_uninstall', '卸载数据包', '卸载数据包', '', '[user|get_nickname] 卸载了数据包：[details]', '1', '1480308372', '1480308372'), ('42', 'admin', 'system_config_update', '更新系统设置', '更新系统设置', '', '[user|get_nickname] 更新了系统设置：[details]', '1', '1480309555', '1480309642');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_attachment`;
CREATE TABLE `game_admin_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `module` varchar(32) NOT NULL DEFAULT '' COMMENT '模块名，由哪个模块上传的',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '文件链接',
  `mime` varchar(64) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `ext` char(4) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT 'sha1 散列值',
  `driver` varchar(16) NOT NULL DEFAULT 'local' COMMENT '上传驱动',
  `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
--  Table structure for `game_admin_config`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_config`;
CREATE TABLE `game_admin_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '名称',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '标题',
  `group` varchar(32) NOT NULL DEFAULT '' COMMENT '配置分组',
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '类型',
  `value` text NOT NULL COMMENT '配置值',
  `options` text NOT NULL COMMENT '配置项',
  `tips` varchar(256) NOT NULL DEFAULT '' COMMENT '配置提示',
  `ajax_url` varchar(256) NOT NULL DEFAULT '' COMMENT '联动下拉框ajax地址',
  `next_items` varchar(256) NOT NULL DEFAULT '' COMMENT '联动下拉框的下级下拉框名，多个以逗号隔开',
  `param` varchar(32) NOT NULL DEFAULT '' COMMENT '联动下拉框请求参数名',
  `format` varchar(32) NOT NULL DEFAULT '' COMMENT '格式，用于格式文本',
  `table` varchar(32) NOT NULL DEFAULT '' COMMENT '表名，只用于快速联动类型',
  `level` tinyint(2) unsigned NOT NULL DEFAULT '2' COMMENT '联动级别，只用于快速联动类型',
  `key` varchar(32) NOT NULL DEFAULT '' COMMENT '键字段，只用于快速联动类型',
  `option` varchar(32) NOT NULL DEFAULT '' COMMENT '值字段，只用于快速联动类型',
  `pid` varchar(32) NOT NULL DEFAULT '' COMMENT '父级id字段，只用于快速联动类型',
  `ak` varchar(32) NOT NULL DEFAULT '' COMMENT '百度地图appkey',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态：0禁用，1启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
--  Records of `game_admin_config`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_config` VALUES ('1', 'web_site_status', '站点开关', 'base', 'switch', '1', '', '站点关闭后将不能访问，后台可正常登录', '', '', '', '', '', '2', '', '', '', '', '1475240395', '1477403914', '1', '1'), ('2', 'web_site_title', '站点标题', 'base', 'text', '上汽集团总工会', '', '调用方式：<code>config(\'web_site_title\')</code>', '', '', '', '', '', '2', '', '', '', '', '1475240646', '1477710341', '2', '1'), ('3', 'web_site_slogan', '站点标语', 'base', 'text', '上汽集团总工会', '', '站点口号，调用方式：<code>config(\'web_site_slogan\')</code>', '', '', '', '', '', '2', '', '', '', '', '1475240994', '1477710357', '3', '1'), ('4', 'web_site_logo', '站点LOGO', 'base', 'image', '', '', '', '', '', '', '', '', '2', '', '', '', '', '1475241067', '1475241067', '4', '1'), ('5', 'web_site_description', '站点描述', 'base', 'textarea', '上汽集团总工会', '', '网站描述，有利于搜索引擎抓取相关信息', '', '', '', '', '', '2', '', '', '', '', '1475241186', '1475241186', '6', '1'), ('6', 'web_site_keywords', '站点关键词', 'base', 'text', '', '', '网站搜索引擎关键字', '', '', '', '', '', '2', '', '', '', '', '1475241328', '1475241328', '7', '1'), ('7', 'web_site_copyright', '版权信息', 'base', 'text', 'Copyright © 2015-2017 上汽集团 All rights reserved.', '', '调用方式：<code>config(\'web_site_copyright\')</code>', '', '', '', '', '', '2', '', '', '', '', '1475241416', '1477710383', '8', '1'), ('8', 'web_site_icp', '备案信息', 'base', 'text', '上汽集团总工会', '', '调用方式：<code>config(\'web_site_icp\')</code>', '', '', '', '', '', '2', '', '', '', '', '1475241441', '1477710441', '9', '1'), ('9', 'web_site_statistics', '站点统计', 'base', 'textarea', '', '', '网站统计代码，支持百度、Google、cnzz等，调用方式：<code>config(\'web_site_statistics\')</code>', '', '', '', '', '', '2', '', '', '', '', '1475241498', '1477710455', '10', '1'), ('10', 'config_group', '配置分组', 'system', 'array', 'base:基本\r\nsystem:系统\r\nupload:上传\r\ndevelop:开发\r\ndatabase:数据库', '', '', '', '', '', '', '', '2', '', '', '', '', '1475241716', '1477649446', '100', '1'), ('11', 'form_item_type', '配置类型', 'system', 'array', 'text:单行文本\r\ntextarea:多行文本\r\nstatic:静态文本\r\npassword:密码\r\ncheckbox:复选框\r\nradio:单选按钮\r\ndate:日期\r\ndatetime:日期+时间\r\nhidden:隐藏\r\nswitch:开关\r\narray:数组\r\nselect:下拉框\r\nlinkage:普通联动下拉框\r\nlinkages:快速联动下拉框\r\nimage:单张图片\r\nimages:多张图片\r\nfile:单个文件\r\nfiles:多个文件\r\nueditor:UEditor 编辑器\r\nwangeditor:wangEditor 编辑器\r\neditormd:markdown 编辑器\r\nckeditor:ckeditor 编辑器\r\nicon:字体图标\r\ntags:标签\r\nnumber:数字\r\nbmap:百度地图\r\ncolorpicker:取色器\r\njcrop:图片裁剪\r\nmasked:格式文本\r\nrange:范围\r\ntime:时间', '', '', '', '', '', '', '', '2', '', '', '', '', '1475241835', '1495853193', '100', '1'), ('12', 'upload_file_size', '文件上传大小限制', 'upload', 'text', '0', '', '0为不限制大小，单位：kb', '', '', '', '', '', '2', '', '', '', '', '1475241897', '1477663520', '100', '1'), ('13', 'upload_file_ext', '允许上传的文件后缀', 'upload', 'tags', 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,rar,zip,gz,bz2,7z', '', '多个后缀用逗号隔开，不填写则不限制类型', '', '', '', '', '', '2', '', '', '', '', '1475241975', '1477649489', '100', '1'), ('14', 'upload_image_size', '图片上传大小限制', 'upload', 'text', '0', '', '0为不限制大小，单位：kb', '', '', '', '', '', '2', '', '', '', '', '1475242015', '1477663529', '100', '1'), ('15', 'upload_image_ext', '允许上传的图片后缀', 'upload', 'tags', 'gif,jpg,jpeg,bmp,png', '', '多个后缀用逗号隔开，不填写则不限制类型', '', '', '', '', '', '2', '', '', '', '', '1475242056', '1477649506', '100', '1'), ('16', 'list_rows', '分页数量', 'system', 'number', '20', '', '每页的记录数', '', '', '', '', '', '2', '', '', '', '', '1475242066', '1476074507', '101', '1'), ('17', 'system_color', '后台配色方案', 'system', 'radio', 'modern', 'default:Default\r\namethyst:Amethyst\r\ncity:City\r\nflat:Flat\r\nmodern:Modern\r\nsmooth:Smooth', '', '', '', '', '', '', '2', '', '', '', '', '1475250066', '1477316689', '102', '1'), ('18', 'develop_mode', '开发模式', 'develop', 'radio', '1', '0:关闭\r\n1:开启', '', '', '', '', '', '', '2', '', '', '', '', '1476864205', '1476864231', '100', '1'), ('19', 'app_trace', '显示页面Trace', 'develop', 'radio', '0', '0:否\r\n1:是', '', '', '', '', '', '', '2', '', '', '', '', '1476866355', '1476866355', '100', '1'), ('21', 'data_backup_path', '数据库备份根路径', 'database', 'text', './data/', '', '路径必须以 / 结尾', '', '', '', '', '', '2', '', '', '', '', '1477017745', '1477018467', '100', '1'), ('22', 'data_backup_part_size', '数据库备份卷大小', 'database', 'text', '20971520', '', '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '', '', '', '', '', '2', '', '', '', '', '1477017886', '1477017886', '100', '1'), ('23', 'data_backup_compress', '数据库备份文件是否启用压缩', 'database', 'radio', '1', '0:否\r\n1:是', '压缩备份文件需要PHP环境支持 <code>gzopen</code>, <code>gzwrite</code>函数', '', '', '', '', '', '2', '', '', '', '', '1477017978', '1477018172', '100', '1'), ('24', 'data_backup_compress_level', '数据库备份文件压缩级别', 'database', 'radio', '9', '1:最低\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '', '', '', '', '', '2', '', '', '', '', '1477018083', '1477018083', '100', '1'), ('25', 'top_menu_max', '顶部导航模块数量', 'system', 'text', '10', '', '设置顶部导航默认显示的模块数量', '', '', '', '', '', '2', '', '', '', '', '1477579289', '1477579289', '103', '1'), ('26', 'web_site_logo_text', '站点LOGO文字', 'base', 'image', '', '', '', '', '', '', '', '', '2', '', '', '', '', '1477620643', '1477620643', '5', '1'), ('27', 'upload_image_thumb', '缩略图尺寸', 'upload', 'text', '', '', '不填写则不生成缩略图，如需生成 <code>300x300</code> 的缩略图，则填写 <code>300,300</code> ，请注意，逗号必须是英文逗号', '', '', '', '', '', '2', '', '', '', '', '1477644150', '1477649513', '100', '1'), ('28', 'upload_image_thumb_type', '缩略图裁剪类型', 'upload', 'radio', '1', '1:等比例缩放\r\n2:缩放后填充\r\n3:居中裁剪\r\n4:左上角裁剪\r\n5:右下角裁剪\r\n6:固定尺寸缩放', '该项配置只有在启用生成缩略图时才生效', '', '', '', '', '', '2', '', '', '', '', '1477646271', '1477649521', '100', '1'), ('29', 'upload_thumb_water', '添加水印', 'upload', 'switch', '0', '', '', '', '', '', '', '', '2', '', '', '', '', '1477649648', '1477649648', '100', '1'), ('30', 'upload_thumb_water_pic', '水印图片', 'upload', 'image', '', '', '只有开启水印功能才生效', '', '', '', '', '', '2', '', '', '', '', '1477656390', '1477656390', '100', '1'), ('31', 'upload_thumb_water_position', '水印位置', 'upload', 'radio', '9', '1:左上角\r\n2:上居中\r\n3:右上角\r\n4:左居中\r\n5:居中\r\n6:右居中\r\n7:左下角\r\n8:下居中\r\n9:右下角', '只有开启水印功能才生效', '', '', '', '', '', '2', '', '', '', '', '1477656528', '1477656528', '100', '1'), ('32', 'upload_thumb_water_alpha', '水印透明度', 'upload', 'text', '50', '', '请输入0~100之间的数字，数字越小，透明度越高', '', '', '', '', '', '2', '', '', '', '', '1477656714', '1477661309', '100', '1'), ('33', 'wipe_cache_type', '清除缓存类型', 'system', 'checkbox', 'TEMP_PATH', 'TEMP_PATH:应用缓存\r\nLOG_PATH:应用日志\r\nCACHE_PATH:项目模板缓存', '清除缓存时，要删除的缓存类型', '', '', '', '', '', '2', '', '', '', '', '1477727305', '1477727305', '100', '1'), ('34', 'captcha_signin', '后台验证码开关', 'system', 'switch', '0', '', '后台登录时是否需要验证码', '', '', '', '', '', '2', '', '', '', '', '1478771958', '1478771958', '99', '1'), ('35', 'home_default_module', '前台默认模块', 'system', 'select', 'index', '', '前台默认访问的模块，该模块必须有Index控制器和index方法', '', '', '', '', '', '0', '', '', '', '', '1486714723', '1486715620', '104', '1'), ('36', 'minify_status', '开启minify', 'system', 'switch', '0', '', '开启minify会压缩合并js、css文件，可以减少资源请求次数，如果不支持minify，可关闭', '', '', '', '', '', '0', '', '', '', '', '1487035843', '1487035843', '99', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_hook`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_hook`;
CREATE TABLE `game_admin_hook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `plugin` varchar(32) NOT NULL DEFAULT '' COMMENT '钩子来自哪个插件',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子描述',
  `system` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统钩子',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='钩子表';

-- ----------------------------
--  Records of `game_admin_hook`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_hook` VALUES ('1', 'admin_index', '', '后台首页', '1', '1468174214', '1477757518', '1'), ('2', 'plugin_index_tab_list', '', '插件扩展tab钩子', '1', '1468174214', '1468174214', '1'), ('3', 'module_index_tab_list', '', '模块扩展tab钩子', '1', '1468174214', '1468174214', '1'), ('4', 'page_tips', '', '每个页面的提示', '1', '1468174214', '1468174214', '1'), ('5', 'signin_footer', '', '登录页面底部钩子', '1', '1479269315', '1479269315', '1'), ('6', 'signin_captcha', '', '登录页面验证码钩子', '1', '1479269315', '1479269315', '1'), ('7', 'signin', '', '登录控制器钩子', '1', '1479386875', '1479386875', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_hook_plugin`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_hook_plugin`;
CREATE TABLE `game_admin_hook_plugin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(32) NOT NULL DEFAULT '' COMMENT '钩子id',
  `plugin` varchar(32) NOT NULL DEFAULT '' COMMENT '插件标识',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='钩子-插件对应表';

-- ----------------------------
--  Records of `game_admin_hook_plugin`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_hook_plugin` VALUES ('1', 'admin_index', 'SystemInfo', '1477757503', '1477757503', '1', '1'), ('2', 'admin_index', 'DevTeam', '1477755780', '1477755780', '2', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_log`;
CREATE TABLE `game_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` longtext NOT NULL COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

-- ----------------------------
--  Records of `game_admin_log`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_log` VALUES ('1', '32', '1', '167772674', 'admin_menu', '70', '超级管理员 删除了节点：节点ID(70),节点标题(后台首页),节点链接(admin/index/index)', '1', '1501930655'), ('2', '34', '1', '167772674', 'admin_menu', '3', '超级管理员 禁用了节点：节点ID(3),节点标题(清空缓存),节点链接(admin/index/wipecache)', '1', '1501930690'), ('3', '34', '1', '167772674', 'admin_menu', '7', '超级管理员 禁用了节点：节点ID(7),节点标题(配置管理),节点链接(admin/config/index)', '1', '1501931030'), ('4', '31', '1', '167772674', 'admin_menu', '7', '超级管理员 编辑了节点：节点ID(7)', '1', '1501931048'), ('5', '34', '1', '167772674', 'admin_menu', '13', '超级管理员 禁用了节点：节点ID(13),节点标题(节点管理),节点链接(admin/menu/index)', '1', '1501931064'), ('6', '33', '1', '167772674', 'admin_menu', '13', '超级管理员 启用了节点：节点ID(13),节点标题(节点管理),节点链接(admin/menu/index)', '1', '1501931081'), ('7', '34', '1', '167772674', 'admin_menu', '50', '超级管理员 禁用了节点：节点ID(50),节点标题(附件管理),节点链接(admin/attachment/index)', '1', '1501931086'), ('8', '31', '1', '167772674', 'admin_menu', '50', '超级管理员 编辑了节点：节点ID(50)', '1', '1501931095'), ('9', '34', '1', '167772674', 'admin_menu', '64', '超级管理员 禁用了节点：节点ID(64),节点标题(系统日志),节点链接(admin/log/index)', '1', '1501931103'), ('10', '34', '1', '167772674', 'admin_menu', '185', '超级管理员 禁用了节点：节点ID(185),节点标题(行为管理),节点链接(admin/action/index)', '1', '1501931106'), ('11', '31', '1', '167772674', 'admin_menu', '64', '超级管理员 编辑了节点：节点ID(64)', '1', '1501931113'), ('12', '34', '1', '167772674', 'admin_menu', '65', '超级管理员 禁用了节点：节点ID(65),节点标题(数据库管理),节点链接(admin/database/index)', '1', '1501931125'), ('13', '31', '1', '167772674', 'admin_menu', '65', '超级管理员 编辑了节点：节点ID(65)', '1', '1501931131'), ('14', '34', '1', '167772674', 'admin_menu', '32', '超级管理员 禁用了节点：节点ID(32),节点标题(扩展中心),节点链接()', '1', '1501931142'), ('15', '31', '1', '167772674', 'admin_menu', '32', '超级管理员 编辑了节点：节点ID(32)', '1', '1501931150'), ('16', '42', '1', '167772674', 'admin_config', '0', '超级管理员 更新了系统设置：分组(develop)', '1', '1501931170'), ('17', '42', '1', '167772674', 'admin_config', '0', '超级管理员 更新了系统设置：分组(develop)', '1', '1501931193'), ('18', '31', '1', '167772674', 'admin_menu', '2', '超级管理员 编辑了节点：节点ID(2)', '1', '1501931342'), ('19', '42', '1', '167772674', 'admin_config', '0', '超级管理员 更新了系统设置：分组(develop)', '1', '1501931443'), ('20', '33', '1', '167772674', 'admin_menu', '32', '超级管理员 启用了节点：节点ID(32),节点标题(扩展中心),节点链接()', '1', '1501931511'), ('21', '35', '1', '167772674', 'admin_module', '0', '超级管理员 安装了模块：会员管理', '1', '1501950218'), ('22', '31', '1', '167772674', 'admin_menu', '68', '超级管理员 编辑了节点：节点ID(68)', '1', '1501986914'), ('23', '31', '1', '167772674', 'admin_menu', '68', '超级管理员 编辑了节点：节点ID(68)', '1', '1501986985'), ('24', '30', '1', '167772674', 'admin_menu', '214', '超级管理员 添加了节点：所属模块(user),所属节点ID(68),节点标题(会员管理),节点链接(admin/member/index)', '1', '1501987637'), ('25', '30', '1', '167772674', 'admin_menu', '215', '超级管理员 添加了节点：所属模块(user),所属节点ID(68),节点标题(公告管理),节点链接(admin/adv/index)', '1', '1501987960'), ('26', '30', '1', '167772674', 'admin_menu', '216', '超级管理员 添加了节点：所属模块(user),所属节点ID(68),节点标题(道具管理),节点链接(admin/prop/index)', '1', '1501988117'), ('27', '30', '1', '167772674', 'admin_menu', '217', '超级管理员 添加了节点：所属模块(user),所属节点ID(68),节点标题(任务管理),节点链接(admin/task/index)', '1', '1502002513'), ('28', '30', '1', '167772674', 'admin_menu', '218', '超级管理员 添加了节点：所属模块(user),所属节点ID(68),节点标题(养成管理),节点链接(admin/disaster/index)', '1', '1502002569'), ('29', '31', '1', '167772674', 'admin_menu', '217', '超级管理员 编辑了节点：节点ID(217)', '1', '1502002639'), ('30', '31', '1', '167772674', 'admin_menu', '218', '超级管理员 编辑了节点：节点ID(218)', '1', '1502002726'), ('31', '31', '1', '167772674', 'admin_menu', '215', '超级管理员 编辑了节点：节点ID(215)', '1', '1502002745'), ('32', '31', '1', '167772674', 'admin_menu', '214', '超级管理员 编辑了节点：节点ID(214)', '1', '1502004669'), ('33', '31', '1', '167772674', 'admin_menu', '215', '超级管理员 编辑了节点：节点ID(215)', '1', '1502004921'), ('34', '31', '1', '167772674', 'admin_menu', '216', '超级管理员 编辑了节点：节点ID(216)', '1', '1502004936'), ('35', '31', '1', '167772674', 'admin_menu', '217', '超级管理员 编辑了节点：节点ID(217)', '1', '1502004946'), ('36', '31', '1', '167772674', 'admin_menu', '217', '超级管理员 编辑了节点：节点ID(217)', '1', '1502004954'), ('37', '31', '1', '167772674', 'admin_menu', '218', '超级管理员 编辑了节点：节点ID(218)', '1', '1502004965'), ('38', '33', '1', '167772674', 'admin_menu', '50', '超级管理员 启用了节点：节点ID(50),节点标题(附件管理),节点链接(admin/attachment/index)', '1', '1502009750'), ('39', '31', '1', '167772674', 'admin_menu', '19', '超级管理员 编辑了节点：节点ID(19)', '1', '1502027116'), ('40', '31', '1', '167772674', 'admin_menu', '216', '超级管理员 编辑了节点：节点ID(216)', '1', '1502027250'), ('41', '30', '1', '167772674', 'admin_menu', '219', '超级管理员 添加了节点：所属模块(user),所属节点ID(216),节点标题(道具管理),节点链接(user/prop/index)', '1', '1502027287'), ('42', '30', '1', '167772674', 'admin_menu', '220', '超级管理员 添加了节点：所属模块(user),所属节点ID(216),节点标题(灾害设置),节点链接(user/disaster/index)', '1', '1502027342'), ('43', '30', '1', '167772674', 'admin_menu', '221', '超级管理员 添加了节点：所属模块(user),所属节点ID(216),节点标题(养成设置),节点链接(user/develop/index)', '1', '1502027490'), ('44', '30', '1', '167772674', 'admin_menu', '222', '超级管理员 添加了节点：所属模块(user),所属节点ID(216),节点标题(奖品设置),节点链接(user/reward/index)', '1', '1502027528'), ('45', '31', '1', '167772674', 'admin_menu', '218', '超级管理员 编辑了节点：节点ID(218)', '1', '1502027586'), ('46', '30', '1', '167772674', 'admin_menu', '223', '超级管理员 添加了节点：所属模块(user),所属节点ID(218),节点标题(奖品列表),节点链接(user/prize/index)', '1', '1502027670'), ('47', '30', '1', '167772674', 'admin_menu', '224', '超级管理员 添加了节点：所属模块(user),所属节点ID(218),节点标题(优惠券列表),节点链接(user/conpon/index)', '1', '1502027703'), ('48', '30', '1', '167772674', 'admin_menu', '225', '超级管理员 添加了节点：所属模块(user),所属节点ID(218),节点标题(优惠券类型列表),节点链接(user/conponTepy/index)', '1', '1502027740'), ('49', '31', '1', '167772674', 'admin_menu', '214', '超级管理员 编辑了节点：节点ID(214)', '1', '1502027934'), ('50', '30', '1', '167772674', 'admin_menu', '226', '超级管理员 添加了节点：所属模块(user),所属节点ID(214),节点标题(会员列表),节点链接(user/member/index)', '1', '1502027949'), ('51', '31', '1', '167772674', 'admin_menu', '218', '超级管理员 编辑了节点：节点ID(218)', '1', '1502027979'), ('52', '31', '1', '167772674', 'admin_menu', '216', '超级管理员 编辑了节点：节点ID(216)', '1', '1502028012'), ('53', '31', '1', '167772674', 'admin_menu', '215', '超级管理员 编辑了节点：节点ID(215)', '1', '1502028028'), ('54', '30', '1', '167772674', 'admin_menu', '227', '超级管理员 添加了节点：所属模块(user),所属节点ID(215),节点标题(公告列表),节点链接(user/adv/index)', '1', '1502028045'), ('55', '30', '1', '167772674', 'admin_menu', '228', '超级管理员 添加了节点：所属模块(user),所属节点ID(217),节点标题(任务列表),节点链接(user/task/index)', '1', '1502125522'), ('56', '31', '1', '167772674', 'admin_menu', '217', '超级管理员 编辑了节点：节点ID(217)', '1', '1502125541'), ('57', '31', '1', '167772674', 'admin_menu', '218', '超级管理员 编辑了节点：节点ID(218)', '1', '1502157848'), ('58', '3', '1', '167772674', 'admin_user', '2', '超级管理员 删除了用户：', '1', '1502157884'), ('59', '30', '1', '167772674', 'admin_menu', '229', '超级管理员 添加了节点：所属模块(user),所属节点ID(215),节点标题(添加),节点链接(user/adv/add)', '1', '1502182354'), ('60', '31', '1', '167772674', 'admin_menu', '229', '超级管理员 编辑了节点：节点ID(229)', '1', '1502182515'), ('61', '30', '1', '167772674', 'admin_menu', '230', '超级管理员 添加了节点：所属模块(user),所属节点ID(227),节点标题(编辑),节点链接(user/adv/edit)', '1', '1502182880'), ('62', '30', '1', '167772674', 'admin_menu', '231', '超级管理员 添加了节点：所属模块(user),所属节点ID(219),节点标题(user/prop/edit),节点链接()', '1', '1502190674'), ('63', '31', '1', '167772674', 'admin_menu', '231', '超级管理员 编辑了节点：节点ID(231)', '1', '1502190701'), ('64', '31', '1', '167772674', 'admin_menu', '231', '超级管理员 编辑了节点：节点ID(231)', '1', '1502201365'), ('65', '30', '1', '167772674', 'admin_menu', '232', '超级管理员 添加了节点：所属模块(user),所属节点ID(220),节点标题(user/disaster/add),节点链接()', '1', '1502205089'), ('66', '31', '1', '167772674', 'admin_menu', '232', '超级管理员 编辑了节点：节点ID(232)', '1', '1502205130'), ('67', '30', '1', '167772674', 'admin_menu', '233', '超级管理员 添加了节点：所属模块(user),所属节点ID(220),节点标题(编辑),节点链接(user/disaster/edit)', '1', '1502206272'), ('68', '34', '1', '167772674', 'admin_menu', '32', '超级管理员 禁用了节点：节点ID(32),节点标题(扩展中心),节点链接()', '1', '1502206492'), ('69', '34', '1', '167772674', 'admin_menu', '50', '超级管理员 禁用了节点：节点ID(50),节点标题(附件管理),节点链接(admin/attachment/index)', '1', '1502206502'), ('70', '30', '1', '167772674', 'admin_menu', '234', '超级管理员 添加了节点：所属模块(user),所属节点ID(228),节点标题(添加),节点链接(user/task/add)', '1', '1502206718'), ('71', '30', '1', '167772674', 'admin_menu', '235', '超级管理员 添加了节点：所属模块(user),所属节点ID(228),节点标题(编辑),节点链接(user/task/edit)', '1', '1502206740'), ('72', '30', '1', '167772674', 'admin_menu', '236', '超级管理员 添加了节点：所属模块(user),所属节点ID(224),节点标题(导入),节点链接(user/conpon/import)', '1', '1502208029'), ('73', '30', '1', '167772674', 'admin_menu', '237', '超级管理员 添加了节点：所属模块(user),所属节点ID(225),节点标题(添加),节点链接(user/conpontepy/add)', '1', '1502208563'), ('74', '30', '1', '167772674', 'admin_menu', '238', '超级管理员 添加了节点：所属模块(user),所属节点ID(225),节点标题(编辑),节点链接(user/conpontepy/edit)', '1', '1502208584');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_menu`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_menu`;
CREATE TABLE `game_admin_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级菜单id',
  `module` varchar(16) NOT NULL DEFAULT '' COMMENT '模块名称',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '菜单标题',
  `icon` varchar(64) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `url_type` varchar(16) NOT NULL DEFAULT '' COMMENT '链接类型（link：外链，module：模块）',
  `url_value` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `url_target` varchar(16) NOT NULL DEFAULT '_self' COMMENT '链接打开方式：_blank,_self',
  `online_hide` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '网站上线后是否隐藏',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `system_menu` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统菜单，系统菜单不可删除',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=239 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
--  Records of `game_admin_menu`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_menu` VALUES ('1', '0', 'admin', '首页', 'fa fa-fw fa-home', 'module_admin', 'admin/index/index', '_self', '0', '1467617722', '1477710540', '1', '1', '1'), ('2', '1', 'admin', '设置', 'fa fa-fw fa-folder-open-o', 'module_admin', '', '_self', '0', '1467618170', '1501931342', '1', '1', '1'), ('3', '2', 'admin', '清空缓存', 'fa fa-fw fa-trash-o', 'module_admin', 'admin/index/wipecache', '_self', '0', '1467618273', '1489049773', '3', '1', '0'), ('4', '0', 'admin', '系统', 'fa fa-fw fa-gear', 'module_admin', 'admin/system/index', '_self', '0', '1467618361', '1477710540', '2', '1', '1'), ('5', '4', 'admin', '系统功能', 'si si-wrench', 'module_admin', '', '_self', '0', '1467618441', '1477710695', '1', '1', '1'), ('6', '5', 'admin', '系统设置', 'fa fa-fw fa-wrench', 'module_admin', 'admin/system/index', '_self', '0', '1467618490', '1477710695', '1', '1', '1'), ('7', '5', 'admin', '配置管理', 'fa fa-fw fa-gears', 'module_admin', 'admin/config/index', '_self', '1', '1467618618', '1501931048', '2', '1', '0'), ('8', '7', 'admin', '新增', '', 'module_admin', 'admin/config/add', '_self', '0', '1467618648', '1477710695', '1', '1', '1'), ('9', '7', 'admin', '编辑', '', 'module_admin', 'admin/config/edit', '_self', '0', '1467619566', '1477710695', '2', '1', '1'), ('10', '7', 'admin', '删除', '', 'module_admin', 'admin/config/delete', '_self', '0', '1467619583', '1477710695', '3', '1', '1'), ('11', '7', 'admin', '启用', '', 'module_admin', 'admin/config/enable', '_self', '0', '1467619609', '1477710695', '4', '1', '1'), ('12', '7', 'admin', '禁用', '', 'module_admin', 'admin/config/disable', '_self', '0', '1467619637', '1477710695', '5', '1', '1'), ('13', '5', 'admin', '节点管理', 'fa fa-fw fa-bars', 'module_admin', 'admin/menu/index', '_self', '0', '1467619882', '1477710695', '3', '1', '1'), ('14', '13', 'admin', '新增', '', 'module_admin', 'admin/menu/add', '_self', '0', '1467619902', '1477710695', '1', '1', '1'), ('15', '13', 'admin', '编辑', '', 'module_admin', 'admin/menu/edit', '_self', '0', '1467620331', '1477710695', '2', '1', '1'), ('16', '13', 'admin', '删除', '', 'module_admin', 'admin/menu/delete', '_self', '0', '1467620363', '1477710695', '3', '1', '1'), ('17', '13', 'admin', '启用', '', 'module_admin', 'admin/menu/enable', '_self', '0', '1467620386', '1477710695', '4', '1', '1'), ('18', '13', 'admin', '禁用', '', 'module_admin', 'admin/menu/disable', '_self', '0', '1467620404', '1477710695', '5', '1', '1'), ('19', '68', 'user', '系统管理', 'fa fa-fw fa-key', 'module_admin', '', '_self', '0', '1467688065', '1502027117', '1', '1', '1'), ('20', '19', 'user', '用户管理', 'fa fa-fw fa-user', 'module_admin', 'user/index/index', '_self', '0', '1467688137', '1477710702', '1', '1', '1'), ('21', '20', 'user', '新增', '', 'module_admin', 'user/index/add', '_self', '0', '1467688177', '1477710702', '1', '1', '1'), ('22', '20', 'user', '编辑', '', 'module_admin', 'user/index/edit', '_self', '0', '1467688202', '1477710702', '2', '1', '1'), ('23', '20', 'user', '删除', '', 'module_admin', 'user/index/delete', '_self', '0', '1467688219', '1477710702', '3', '1', '1'), ('24', '20', 'user', '启用', '', 'module_admin', 'user/index/enable', '_self', '0', '1467688238', '1477710702', '4', '1', '1'), ('25', '20', 'user', '禁用', '', 'module_admin', 'user/index/disable', '_self', '0', '1467688256', '1477710702', '5', '1', '1'), ('211', '64', 'admin', '日志详情', '', 'module_admin', 'admin/log/details', '_self', '0', '1480299320', '1480299320', '100', '0', '1'), ('32', '4', 'admin', '扩展中心', 'si si-social-dropbox', 'module_admin', '', '_self', '1', '1467688853', '1501931150', '2', '1', '0'), ('33', '32', 'admin', '模块管理', 'fa fa-fw fa-th-large', 'module_admin', 'admin/module/index', '_self', '0', '1467689008', '1477710695', '1', '1', '1'), ('34', '33', 'admin', '导入', '', 'module_admin', 'admin/module/import', '_self', '0', '1467689153', '1477710695', '1', '1', '1'), ('35', '33', 'admin', '导出', '', 'module_admin', 'admin/module/export', '_self', '0', '1467689173', '1477710695', '2', '1', '1'), ('36', '33', 'admin', '安装', '', 'module_admin', 'admin/module/install', '_self', '0', '1467689192', '1477710695', '3', '1', '1'), ('37', '33', 'admin', '卸载', '', 'module_admin', 'admin/module/uninstall', '_self', '0', '1467689241', '1477710695', '4', '1', '1'), ('38', '33', 'admin', '启用', '', 'module_admin', 'admin/module/enable', '_self', '0', '1467689294', '1477710695', '5', '1', '1'), ('39', '33', 'admin', '禁用', '', 'module_admin', 'admin/module/disable', '_self', '0', '1467689312', '1477710695', '6', '1', '1'), ('40', '33', 'admin', '更新', '', 'module_admin', 'admin/module/update', '_self', '0', '1467689341', '1477710695', '7', '1', '1'), ('41', '32', 'admin', '插件管理', 'fa fa-fw fa-puzzle-piece', 'module_admin', 'admin/plugin/index', '_self', '0', '1467689527', '1477710695', '2', '1', '1'), ('42', '41', 'admin', '导入', '', 'module_admin', 'admin/plugin/import', '_self', '0', '1467689650', '1477710695', '1', '1', '1'), ('43', '41', 'admin', '导出', '', 'module_admin', 'admin/plugin/export', '_self', '0', '1467689665', '1477710695', '2', '1', '1'), ('44', '41', 'admin', '安装', '', 'module_admin', 'admin/plugin/install', '_self', '0', '1467689680', '1477710695', '3', '1', '1'), ('45', '41', 'admin', '卸载', '', 'module_admin', 'admin/plugin/uninstall', '_self', '0', '1467689700', '1477710695', '4', '1', '1'), ('46', '41', 'admin', '启用', '', 'module_admin', 'admin/plugin/enable', '_self', '0', '1467689730', '1477710695', '5', '1', '1'), ('47', '41', 'admin', '禁用', '', 'module_admin', 'admin/plugin/disable', '_self', '0', '1467689747', '1477710695', '6', '1', '1'), ('48', '41', 'admin', '设置', '', 'module_admin', 'admin/plugin/config', '_self', '0', '1467689789', '1477710695', '7', '1', '1'), ('49', '41', 'admin', '管理', '', 'module_admin', 'admin/plugin/manage', '_self', '0', '1467689846', '1477710695', '8', '1', '1'), ('50', '5', 'admin', '附件管理', 'fa fa-fw fa-cloud-upload', 'module_admin', 'admin/attachment/index', '_self', '1', '1467690161', '1501931095', '4', '1', '0'), ('52', '50', 'admin', '下载', '', 'module_admin', 'admin/attachment/download', '_self', '0', '1467690334', '1477710695', '2', '1', '1'), ('53', '50', 'admin', '启用', '', 'module_admin', 'admin/attachment/enable', '_self', '0', '1467690352', '1477710695', '3', '1', '1'), ('54', '50', 'admin', '禁用', '', 'module_admin', 'admin/attachment/disable', '_self', '0', '1467690369', '1477710695', '4', '1', '1'), ('55', '50', 'admin', '删除', '', 'module_admin', 'admin/attachment/delete', '_self', '0', '1467690396', '1477710695', '5', '1', '1'), ('56', '41', 'admin', '删除', '', 'module_admin', 'admin/plugin/delete', '_self', '0', '1467858065', '1477710695', '11', '1', '1'), ('57', '41', 'admin', '编辑', '', 'module_admin', 'admin/plugin/edit', '_self', '0', '1467858092', '1477710695', '10', '1', '1'), ('60', '41', 'admin', '新增', '', 'module_admin', 'admin/plugin/add', '_self', '0', '1467858421', '1477710695', '9', '1', '1'), ('61', '41', 'admin', '执行', '', 'module_admin', 'admin/plugin/execute', '_self', '0', '1467879016', '1477710695', '14', '1', '1'), ('62', '13', 'admin', '保存', '', 'module_admin', 'admin/menu/save', '_self', '0', '1468073039', '1477710695', '6', '1', '1'), ('64', '5', 'admin', '系统日志', 'fa fa-fw fa-book', 'module_admin', 'admin/log/index', '_self', '1', '1476111944', '1501931113', '6', '0', '0'), ('65', '5', 'admin', '数据库管理', 'fa fa-fw fa-database', 'module_admin', 'admin/database/index', '_self', '1', '1476111992', '1501931132', '8', '0', '0'), ('66', '32', 'admin', '数据包管理', 'fa fa-fw fa-database', 'module_admin', 'admin/packet/index', '_self', '0', '1476112326', '1477710695', '4', '0', '1'), ('67', '19', 'user', '角色管理', 'fa fa-fw fa-users', 'module_admin', 'user/role/index', '_self', '0', '1476113025', '1477710702', '3', '0', '1'), ('68', '0', 'user', '运营管理', 'fa fa-fw fa-sitemap', 'module_admin', 'user/index/index', '_self', '0', '1476193348', '1501986986', '3', '0', '1'), ('69', '32', 'admin', '钩子管理', 'fa fa-fw fa-anchor', 'module_admin', 'admin/hook/index', '_self', '0', '1476236193', '1477710695', '3', '0', '1'), ('215', '68', 'user', '公告管理', 'fa fa-fw fa-bullhorn', 'module_admin', '', '_self', '0', '1501987960', '1502028029', '100', '0', '1'), ('71', '67', 'user', '新增', '', 'module_admin', 'user/role/add', '_self', '0', '1476256935', '1477710702', '1', '0', '1'), ('72', '67', 'user', '编辑', '', 'module_admin', 'user/role/edit', '_self', '0', '1476256968', '1477710702', '2', '0', '1'), ('73', '67', 'user', '删除', '', 'module_admin', 'user/role/delete', '_self', '0', '1476256993', '1477710702', '3', '0', '1'), ('74', '67', 'user', '启用', '', 'module_admin', 'user/role/enable', '_self', '0', '1476257023', '1477710702', '4', '0', '1'), ('75', '67', 'user', '禁用', '', 'module_admin', 'user/role/disable', '_self', '0', '1476257046', '1477710702', '5', '0', '1'), ('76', '20', 'user', '授权', '', 'module_admin', 'user/index/access', '_self', '0', '1476375187', '1477710702', '6', '0', '1'), ('77', '69', 'admin', '新增', '', 'module_admin', 'admin/hook/add', '_self', '0', '1476668971', '1477710695', '1', '0', '1'), ('78', '69', 'admin', '编辑', '', 'module_admin', 'admin/hook/edit', '_self', '0', '1476669006', '1477710695', '2', '0', '1'), ('79', '69', 'admin', '删除', '', 'module_admin', 'admin/hook/delete', '_self', '0', '1476669375', '1477710695', '3', '0', '1'), ('80', '69', 'admin', '启用', '', 'module_admin', 'admin/hook/enable', '_self', '0', '1476669427', '1477710695', '4', '0', '1'), ('81', '69', 'admin', '禁用', '', 'module_admin', 'admin/hook/disable', '_self', '0', '1476669564', '1477710695', '5', '0', '1'), ('183', '66', 'admin', '安装', '', 'module_admin', 'admin/packet/install', '_self', '0', '1476851362', '1477710695', '1', '0', '1'), ('184', '66', 'admin', '卸载', '', 'module_admin', 'admin/packet/uninstall', '_self', '0', '1476851382', '1477710695', '2', '0', '1'), ('185', '5', 'admin', '行为管理', 'fa fa-fw fa-bug', 'module_admin', 'admin/action/index', '_self', '0', '1476882441', '1477710695', '7', '0', '0'), ('186', '185', 'admin', '新增', '', 'module_admin', 'admin/action/add', '_self', '0', '1476884439', '1477710695', '1', '0', '1'), ('187', '185', 'admin', '编辑', '', 'module_admin', 'admin/action/edit', '_self', '0', '1476884464', '1477710695', '2', '0', '1'), ('188', '185', 'admin', '启用', '', 'module_admin', 'admin/action/enable', '_self', '0', '1476884493', '1477710695', '3', '0', '1'), ('189', '185', 'admin', '禁用', '', 'module_admin', 'admin/action/disable', '_self', '0', '1476884534', '1477710695', '4', '0', '1'), ('190', '185', 'admin', '删除', '', 'module_admin', 'admin/action/delete', '_self', '0', '1476884551', '1477710695', '5', '0', '1'), ('191', '65', 'admin', '备份数据库', '', 'module_admin', 'admin/database/export', '_self', '0', '1476972746', '1477710695', '1', '0', '1'), ('192', '65', 'admin', '还原数据库', '', 'module_admin', 'admin/database/import', '_self', '0', '1476972772', '1477710695', '2', '0', '1'), ('193', '65', 'admin', '优化表', '', 'module_admin', 'admin/database/optimize', '_self', '0', '1476972800', '1477710695', '3', '0', '1'), ('194', '65', 'admin', '修复表', '', 'module_admin', 'admin/database/repair', '_self', '0', '1476972825', '1477710695', '4', '0', '1'), ('195', '65', 'admin', '删除备份', '', 'module_admin', 'admin/database/delete', '_self', '0', '1476973457', '1477710695', '5', '0', '1'), ('210', '41', 'admin', '快速编辑', '', 'module_admin', 'admin/plugin/quickedit', '_self', '0', '1477713981', '1477713981', '100', '0', '1'), ('209', '185', 'admin', '快速编辑', '', 'module_admin', 'admin/action/quickedit', '_self', '0', '1477713939', '1477713939', '100', '0', '1'), ('208', '7', 'admin', '快速编辑', '', 'module_admin', 'admin/config/quickedit', '_self', '0', '1477713808', '1477713808', '100', '0', '1'), ('207', '69', 'admin', '快速编辑', '', 'module_admin', 'admin/hook/quickedit', '_self', '0', '1477713770', '1477713770', '100', '0', '1'), ('212', '2', 'admin', '个人设置', 'fa fa-fw fa-user', 'module_admin', 'admin/index/profile', '_self', '0', '1489049767', '1489049773', '2', '0', '1'), ('214', '68', 'user', '会员管理', 'fa fa-fw fa-drivers-license', 'module_admin', '', '_self', '0', '1501987638', '1502027934', '100', '0', '1'), ('216', '68', 'user', '游戏管理', 'fa fa-fw fa-leaf', 'module_admin', '', '_self', '0', '1501988118', '1502028012', '100', '0', '1'), ('217', '68', 'user', '任务管理', 'fa fa-fw fa-file-text-o', 'module_admin', '', '_self', '0', '1502002513', '1502125542', '100', '0', '1'), ('218', '68', 'user', '奖品管理', 'fa fa-fw fa-shopping-bag', 'module_admin', '', '_self', '0', '1502002569', '1502157848', '100', '0', '1'), ('227', '215', 'user', '公告列表', '', 'module_admin', 'user/adv/index', '_self', '0', '1502028045', '1502028045', '100', '0', '1'), ('234', '228', 'user', '添加', '', 'module_admin', 'user/task/add', '_self', '0', '1502206718', '1502206718', '100', '0', '1'), ('219', '216', 'user', '道具管理', '', 'module_admin', 'user/prop/index', '_self', '0', '1502027287', '1502027287', '100', '0', '1'), ('220', '216', 'user', '灾害设置', '', 'module_admin', 'user/disaster/index', '_self', '0', '1502027343', '1502027343', '100', '0', '1'), ('221', '216', 'user', '养成设置', '', 'module_admin', 'user/develop/index', '_self', '0', '1502027491', '1502027491', '100', '0', '1'), ('222', '216', 'user', '奖品设置', '', 'module_admin', 'user/reward/index', '_self', '0', '1502027528', '1502027528', '100', '0', '1'), ('223', '218', 'user', '奖品列表', '', 'module_admin', 'user/prize/index', '_self', '0', '1502027671', '1502027671', '100', '0', '1'), ('224', '218', 'user', '优惠券列表', '', 'module_admin', 'user/conpon/index', '_self', '0', '1502027703', '1502027703', '100', '0', '1'), ('225', '218', 'user', '优惠券类型列表', '', 'module_admin', 'user/conpontepy/index', '_self', '0', '1502027740', '1502027740', '100', '0', '1'), ('226', '214', 'user', '会员列表', '', 'module_admin', 'user/member/index', '_self', '0', '1502027950', '1502027950', '100', '0', '1'), ('228', '217', 'user', '任务列表', '', 'module_admin', 'user/task/index', '_self', '0', '1502125522', '1502125522', '100', '0', '1'), ('229', '227', 'user', '添加', '', 'module_admin', 'user/adv/add', '_self', '0', '1502182355', '1502182516', '100', '0', '1'), ('230', '227', 'user', '编辑', '', 'module_admin', 'user/adv/edit', '_self', '0', '1502182881', '1502182881', '100', '0', '1'), ('231', '219', 'user', '道具设置', '', 'module_admin', 'user/prop/setting', '_self', '0', '1502190674', '1502201366', '100', '0', '1'), ('232', '220', 'user', '添加', '', 'module_admin', 'user/disaster/add', '_self', '0', '1502205089', '1502205131', '100', '0', '1'), ('233', '220', 'user', '编辑', '', 'module_admin', 'user/disaster/edit', '_self', '0', '1502206272', '1502206272', '100', '0', '1'), ('235', '228', 'user', '编辑', '', 'module_admin', 'user/task/edit', '_self', '0', '1502206741', '1502206741', '100', '0', '1'), ('236', '224', 'user', '导入', '', 'module_admin', 'user/conpon/import', '_self', '0', '1502208029', '1502208029', '100', '0', '1'), ('237', '225', 'user', '添加', '', 'module_admin', 'user/conpontepy/add', '_self', '0', '1502208563', '1502208563', '100', '0', '1'), ('238', '225', 'user', '编辑', '', 'module_admin', 'user/conpontepy/edit', '_self', '0', '1502208584', '1502208584', '100', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_module`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_module`;
CREATE TABLE `game_admin_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '模块名称（标识）',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '模块标题',
  `icon` varchar(64) NOT NULL DEFAULT '' COMMENT '图标',
  `description` text NOT NULL COMMENT '描述',
  `author` varchar(32) NOT NULL DEFAULT '' COMMENT '作者',
  `author_url` varchar(255) NOT NULL DEFAULT '' COMMENT '作者主页',
  `config` text COMMENT '配置信息',
  `access` text COMMENT '授权配置',
  `version` varchar(16) NOT NULL DEFAULT '' COMMENT '版本号',
  `identifier` varchar(64) NOT NULL DEFAULT '' COMMENT '模块唯一标识符',
  `system_module` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统模块',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='模块表';

-- ----------------------------
--  Records of `game_admin_module`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_module` VALUES ('1', 'admin', '系统', 'fa fa-fw fa-gear', '系统模块，DolphinPHP的核心模块', 'DolphinPHP', 'http://www.dolphinphp.com', '', '', '1.0.0', 'admin.dolphinphp.module', '1', '1468204902', '1468204902', '100', '1'), ('2', 'user', '用户', 'fa fa-fw fa-user', '用户模块，DolphinPHP自带模块', 'DolphinPHP', 'http://www.dolphinphp.com', '', '', '1.0.0', 'user.dolphinphp.module', '1', '1468204902', '1468204902', '100', '1'), ('3', 'member', '会员管理', 'fa fa-fw fa-newspaper-o', '会员模块', 'zxgbuynow', 'http://www..com', '', '', '1.0.0', 'cms.ming.module', '0', '0', '1501952468', '100', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_packet`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_packet`;
CREATE TABLE `game_admin_packet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '数据包名',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '数据包标题',
  `author` varchar(32) NOT NULL DEFAULT '' COMMENT '作者',
  `author_url` varchar(255) NOT NULL DEFAULT '' COMMENT '作者url',
  `version` varchar(16) NOT NULL,
  `tables` text NOT NULL COMMENT '数据表名',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='数据包表';

-- ----------------------------
--  Table structure for `game_admin_plugin`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_plugin`;
CREATE TABLE `game_admin_plugin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '插件名称',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '插件标题',
  `icon` varchar(64) NOT NULL DEFAULT '' COMMENT '图标',
  `description` text NOT NULL COMMENT '插件描述',
  `author` varchar(32) NOT NULL DEFAULT '' COMMENT '作者',
  `author_url` varchar(255) NOT NULL DEFAULT '' COMMENT '作者主页',
  `config` text NOT NULL COMMENT '配置信息',
  `version` varchar(16) NOT NULL DEFAULT '' COMMENT '版本号',
  `identifier` varchar(64) NOT NULL DEFAULT '' COMMENT '插件唯一标识符',
  `admin` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台管理',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
--  Records of `game_admin_plugin`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_plugin` VALUES ('1', 'SystemInfo', '系统环境信息', 'fa fa-fw fa-info-circle', '在后台首页显示服务器信息', '蔡伟明', 'http://www.caiweiming.com', '{\"display\":\"1\",\"width\":\"6\"}', '1.0.0', 'system_info.ming.plugin', '0', '1477757503', '1477757503', '100', '1'), ('2', 'DevTeam', '开发团队成员信息', 'fa fa-fw fa-users', '开发团队成员信息', '蔡伟明', 'http://www.caiweiming.com', '{\"display\":\"1\",\"width\":\"6\"}', '1.0.0', 'dev_team.ming.plugin', '0', '1477755780', '1477755780', '100', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_role`;
CREATE TABLE `game_admin_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级角色',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '角色描述',
  `menu_auth` text NOT NULL COMMENT '菜单权限',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `access` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否可登录后台',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
--  Records of `game_admin_role`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_role` VALUES ('1', '0', '超级管理员', '系统默认创建的角色，拥有最高权限', '', '0', '1476270000', '1468117612', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `game_admin_user`;
CREATE TABLE `game_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(96) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `email_bind` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否绑定邮箱地址',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `mobile_bind` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否绑定手机号码',
  `avatar` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '头像',
  `money` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '余额',
  `score` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `role` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `group` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '部门id',
  `signup_ip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册ip',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
  `last_login_ip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登录ip',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态：0禁用，1启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
--  Records of `game_admin_user`
-- ----------------------------
BEGIN;
INSERT INTO `game_admin_user` VALUES ('1', 'admin', '超级管理员', '$2y$10$Brw6wmuSLIIx3Yabid8/Wu5l8VQ9M/H/CG3C9RqN9dUCwZW3ljGOK', '', '0', '', '0', '0', '0.00', '0', '1', '0', '0', '1476065410', '1502258464', '1502258464', '167772674', '100', '1');
COMMIT;

-- ----------------------------
--  Table structure for `game_adv_type`
-- ----------------------------
DROP TABLE IF EXISTS `game_adv_type`;
CREATE TABLE `game_adv_type` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL COMMENT '名称',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `game_announcement`
-- ----------------------------
DROP TABLE IF EXISTS `game_announcement`;
CREATE TABLE `game_announcement` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `adv_type` tinyint(1) DEFAULT NULL COMMENT '公告类型',
  `adv_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `adv_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '内容',
  `adv_status` tinyint(1) DEFAULT '1' COMMENT '公告状态  1启用 0为停用',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_announcement`
-- ----------------------------
BEGIN;
INSERT INTO `game_announcement` VALUES ('3', '0', 'test', 'testts', '1', '1502007279'), ('4', '1', '收衣服啦', '<p>下雨啦！收衣服啦</p>', '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `game_conpon`
-- ----------------------------
DROP TABLE IF EXISTS `game_conpon`;
CREATE TABLE `game_conpon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conpon_type` int(11) DEFAULT NULL COMMENT '优惠券类型',
  `conpon_no` varchar(25) DEFAULT NULL COMMENT '密码',
  `conpon_password` varchar(25) DEFAULT NULL COMMENT '代号',
  `conpon_status` tinyint(1) DEFAULT '0' COMMENT '0没分配 1已分配',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `cash_date` varchar(200) DEFAULT NULL COMMENT '兑奖日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_conpon`
-- ----------------------------
BEGIN;
INSERT INTO `game_conpon` VALUES ('1', '1', '00124534223', '123456', '0', '1502165873', '2017.07.19至2017.07.26');
COMMIT;

-- ----------------------------
--  Table structure for `game_conpon_type`
-- ----------------------------
DROP TABLE IF EXISTS `game_conpon_type`;
CREATE TABLE `game_conpon_type` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `conpon_name` varchar(25) DEFAULT NULL COMMENT '优惠券名',
  `conpon_parnter` varchar(25) DEFAULT NULL COMMENT '合伙伙伴',
  `conpon_code` varchar(25) DEFAULT NULL COMMENT '代号',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `conpon_introduce` text COMMENT '使用说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_conpon_type`
-- ----------------------------
BEGIN;
INSERT INTO `game_conpon_type` VALUES ('1', '优惠1', 'CCTV', 'WEKWE', '1502208698', '<p>兑奖日期：2017.07.19 至 2017.07.26</p><p>可用时段：任何时间</p><p>兑奖方式：网页兑换</p><p>联系电话：021-1234567899</p><p>(周一至周五 9:00-18:00)</p><p><br/></p>');
COMMIT;

-- ----------------------------
--  Table structure for `game_develop`
-- ----------------------------
DROP TABLE IF EXISTS `game_develop`;
CREATE TABLE `game_develop` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cash_trees` int(10) unsigned NOT NULL COMMENT '树苗兑换',
  `lives_tree` int(10) unsigned NOT NULL COMMENT '成长值',
  `develop_day` int(10) unsigned NOT NULL COMMENT '自然生长增加',
  `lives_drought` int(10) unsigned NOT NULL COMMENT '干旱减掉生命值',
  `lives_flood` int(10) unsigned NOT NULL COMMENT '洪水减掉生命值',
  `lives_typhoon` int(10) unsigned NOT NULL COMMENT '台风减掉生命值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_develop`
-- ----------------------------
BEGIN;
INSERT INTO `game_develop` VALUES ('1', '80', '120', '24', '10', '15', '10');
COMMIT;

-- ----------------------------
--  Table structure for `game_disaster`
-- ----------------------------
DROP TABLE IF EXISTS `game_disaster`;
CREATE TABLE `game_disaster` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `disaster_type` tinyint(1) DEFAULT '0' COMMENT '灾害类型 0 台风 1 洪水 2 干旱',
  `start_time` int(11) unsigned NOT NULL COMMENT '触发开始时间',
  `end_time` int(11) unsigned NOT NULL COMMENT '触发结束时间',
  `push_begin_time` int(11) unsigned NOT NULL COMMENT '公告发布开始时间',
  `push_flish_time` int(11) unsigned NOT NULL COMMENT '公告发布时间',
  `push_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '公告内容',
  `status` tinyint(1) DEFAULT '0' COMMENT '即将到来 0 正在进行 1 已结束 2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_disaster`
-- ----------------------------
BEGIN;
INSERT INTO `game_disaster` VALUES ('2', '0', '1502294400', '1504195200', '0', '1502208000', '<p>台风要来啦！</p>', '0');
COMMIT;

-- ----------------------------
--  Table structure for `game_green_record`
-- ----------------------------
DROP TABLE IF EXISTS `game_green_record`;
CREATE TABLE `game_green_record` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `green` int(11) unsigned NOT NULL COMMENT '绿值',
  `create_time` int(11) unsigned NOT NULL COMMENT '获奖时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `game_member`
-- ----------------------------
DROP TABLE IF EXISTS `game_member`;
CREATE TABLE `game_member` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '会员名称',
  `area` varchar(255) DEFAULT NULL COMMENT '所在区域',
  `company` varchar(255) DEFAULT NULL COMMENT '所在企业',
  `class` varchar(255) DEFAULT NULL COMMENT '所在班组',
  `mileage` int(10) unsigned NOT NULL COMMENT '里程数',
  `green_nocash` int(10) DEFAULT NULL COMMENT '不可兑换',
  `green` int(10) unsigned NOT NULL COMMENT '可兑换绿值',
  `green_max` int(10) unsigned NOT NULL COMMENT '最大绿值',
  `share` int(10) unsigned NOT NULL COMMENT '享币',
  `trees` int(10) unsigned NOT NULL COMMENT '树苗',
  `contact` varchar(255) DEFAULT NULL COMMENT '联系方式',
  `contact_address` varchar(255) DEFAULT NULL COMMENT '联系地址',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `sign` varchar(100) DEFAULT NULL COMMENT '用户标识',
  `class_no` int(10) DEFAULT NULL COMMENT '班级编号',
  `company_no` int(10) DEFAULT NULL COMMENT '公司id',
  `type` tinyint(1) DEFAULT '0' COMMENT '0为乘客 1为司机',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_member`
-- ----------------------------
BEGIN;
INSERT INTO `game_member` VALUES ('1', 'xxxxxxx', '上海市区', '企业名称', '班组名称', '110', null, '110', '11110', '110', '10', '13500000000', null, '1502165873', '00001', '1', '1', '0'), ('2', '1111', '嘉定', '企业名称', '班组名称', '110', null, '120', '12120', '110', '10', '18321730541', null, '1502165873', '00002', '1', '2', '0');
COMMIT;

-- ----------------------------
--  Table structure for `game_prop`
-- ----------------------------
DROP TABLE IF EXISTS `game_prop`;
CREATE TABLE `game_prop` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `prop_name` varchar(255) DEFAULT NULL COMMENT '道具名称',
  `prop_affect` varchar(255) DEFAULT NULL COMMENT '道具作用',
  `cash` int(10) unsigned NOT NULL COMMENT '购买',
  `use_limit` int(10) unsigned NOT NULL COMMENT '使用限制',
  `lives` int(10) unsigned NOT NULL COMMENT '成长值',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `position` tinyint(4) DEFAULT '1' COMMENT '道具1 道具2 道具3 道具4',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_prop`
-- ----------------------------
BEGIN;
INSERT INTO `game_prop` VALUES ('2', '浇水壶', '用于给树苗浇水', '10', '1', '10', '0', '1'), ('3', '小铲子', '用于给树苗除草', '12', '1', '12', '0', '2');
COMMIT;

-- ----------------------------
--  Table structure for `game_recode`
-- ----------------------------
DROP TABLE IF EXISTS `game_recode`;
CREATE TABLE `game_recode` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '会员id',
  `conpon_id` int(11) unsigned NOT NULL COMMENT '优惠券名',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态 0 未使用 1使用',
  `create_time` int(11) unsigned NOT NULL COMMENT '获奖时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_recode`
-- ----------------------------
BEGIN;
INSERT INTO `game_recode` VALUES ('1', '1', '1', '0', '1502165873');
COMMIT;

-- ----------------------------
--  Table structure for `game_reward_setting`
-- ----------------------------
DROP TABLE IF EXISTS `game_reward_setting`;
CREATE TABLE `game_reward_setting` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `green_limit` int(10) unsigned NOT NULL COMMENT '绿值最小值',
  `green_max` int(10) unsigned NOT NULL COMMENT '绿值最大值',
  `share_limit` int(10) unsigned NOT NULL COMMENT '成长币最小值',
  `share_max` int(10) unsigned NOT NULL COMMENT '成长币最大值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_reward_setting`
-- ----------------------------
BEGIN;
INSERT INTO `game_reward_setting` VALUES ('1', '1', '10', '1', '15');
COMMIT;

-- ----------------------------
--  Table structure for `game_task`
-- ----------------------------
DROP TABLE IF EXISTS `game_task`;
CREATE TABLE `game_task` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(200) DEFAULT '' COMMENT '任务名',
  `task_describe` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '任务描述',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `task_introduce` varchar(200) DEFAULT NULL COMMENT '奖品说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_task`
-- ----------------------------
BEGIN;
INSERT INTO `game_task` VALUES ('1', '任务1', '<p>啥任务</p>', '0', '10-100绿值');
COMMIT;

-- ----------------------------
--  Table structure for `game_task_process`
-- ----------------------------
DROP TABLE IF EXISTS `game_task_process`;
CREATE TABLE `game_task_process` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `task_id` int(10) DEFAULT NULL COMMENT '任务id',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否已领取  1是  0为否',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `game_task_recode`
-- ----------------------------
DROP TABLE IF EXISTS `game_task_recode`;
CREATE TABLE `game_task_recode` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) NOT NULL COMMENT '用户手机号',
  `task_id` int(10) DEFAULT NULL COMMENT '任务id',
  `green` int(10) unsigned NOT NULL COMMENT '奖励的绿植数量',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_task_recode`
-- ----------------------------
BEGIN;
INSERT INTO `game_task_recode` VALUES ('1', '13500000000', '1', '10', '1502165873'), ('2', '13500000000', '1', '15', '1502167873');
COMMIT;

-- ----------------------------
--  Table structure for `game_trees`
-- ----------------------------
DROP TABLE IF EXISTS `game_trees`;
CREATE TABLE `game_trees` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `level` int(10) DEFAULT '1' COMMENT '当前阶段',
  `lifes` int(10) DEFAULT '0' COMMENT '当前成长值 总120点',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态  0末成年树 1成年末结果实  2有果实 3果实已领取',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `game_trees`
-- ----------------------------
BEGIN;
INSERT INTO `game_trees` VALUES ('1', '1', '1', '0', '0', '1502511300');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
