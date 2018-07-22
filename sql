####
test deploy

###############2018-07-22##############
drop table wechat_template_task;

CREATE TABLE `wechat_template_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechat_appid` varchar(50) NOT NULL DEFAULT '' COMMENT '微信appid',
  `template_id` varchar(50) NOT NULL DEFAULT '' COMMENT '模板消息ID',
  `template_name` varchar(50) NOT NULL DEFAULT '' COMMENT '模板消息名称',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '跳转URL',
  `topcolor` varchar(20) NOT NULL DEFAULT '' COMMENT '模版顶部颜色',
  `content` varchar(5000) NOT NULL DEFAULT '' COMMENT '内容json格式',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `openid` varchar(100) NOT NULL DEFAULT '' COMMENT '测试openid',
  `user_type` varchar(10) NOT NULL DEFAULT '' COMMENT '用户类型vip,free,all',
  `task_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '任务类型1一次性任务;2每天执行任务',
  `task_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '任务状态1待运行;2运行中;3已停止;4已完成',
  `task_run_time` varchar(20) NOT NULL DEFAULT '' COMMENT '年-月-日 时:分',
  `finish_time` datetime NOT NULL COMMENT '停止时间',
  `cnts` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `send_total_num` int(10) unsigned DEFAULT '0' COMMENT '发送总人数',
  `send_success_num` int(10) unsigned DEFAULT '0' COMMENT '发送成功数',
  `send_fail_num` int(10) unsigned DEFAULT '0' COMMENT '发送失败数',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='微信模板消息任务';


###############2018-07-18#################
alter table `user_partner_card` add column video_hash varchar(100) default '' comment '视频七牛hash' after video_url;

###############2018-07-15#################
CREATE TABLE `user_partner_card` (
  `user_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `tel` varchar(25) NOT NULL DEFAULT '' COMMENT '手机号',
  `wechat` varchar(25) NOT NULL COMMENT '微信',
  `email` varchar(50) NOT NULL COMMENT 'email',
  `address` varchar(100) NOT NULL COMMENT '地址',
  `website` varchar(100) NOT NULL COMMENT '网址',
  `remark` varchar(600) NOT NULL COMMENT '简介',
  `cover_url` varchar(250) NOT NULL COMMENT '封面地址',
  `video_url` varchar(600) NOT NULL COMMENT '视频地址',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='合伙人卡片表';

CREATE TABLE `user_partner_card_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `url` varchar(250) NOT NULL COMMENT '图片地址',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='合伙人卡片图片表';

###############2018-07-02#################
CREATE TABLE `tooler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型，类型唯一',
  `content` longtext NOT NULL COMMENT '内容，可以json',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='工具表 ';
###############2017-07-10#################
/*将会员卡激活但是没有会员天数的用户增加天数*/
update `user` set vip_left_day = '2018-07-12' where vip_flg = 2 and vip_left_day is null
###############2017-07-09#################
/*爱心大使指导师分成*/
update income_scale set `value` = 'a:3:{s:7:"p_scale";s:2:"60";s:7:"t_scale";s:2:"40";s:7:"a_scale";s:1:"0";}'
where `key` = 3;

/*爱心大使合伙人分成*/
insert into income_scale(`key`,`value`,`created_at`,`updated_at`)
values(4,'a:3:{s:7:"p_scale";s:2:"40";s:7:"t_scale";s:2:"60";s:7:"a_scale";s:1:"0";}','2017-07-08 15:36:00','2017-07-08 15:36:00');

###############2017-07-09#################
alter table `order` add column lover_id int default 0 comment '爱心大使用户ID';

###############2017-07-08#################
/*爱心大使指导师分成*/
insert into income_scale(`key`,`value`,`created_at`,`updated_at`)
values(3,'a:3:{s:7:"p_scale";s:1:"0";s:7:"t_scale";s:2:"40";s:7:"a_scale";s:2:"60";}','2017-07-08 15:36:00','2017-07-08 15:36:00');

###############2017-07-06#################
alter table `user` add column lover_id int default 0 comment '爱心大使用户ID';
alter table `user` add column lover_time datetime comment '爱心大使ID登记时间';

###############2017-06-17#################
/*增加建议留言表*/
create table leave_word(
	`id` int auto_increment primary key,
	`user_id` int not null comment '用户ID',
	`content` varchar(1000) not null comment '建议内容',
	`created_at` timestamp not null default '0000-00-00 00:00:00',
	`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`deleted_at` timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='建议留言表';

###############2017-06-13#################
update `user` set vip_left_day = '2018-06-13' where vip_flg = 2;


###############2017-06-10#################
/*增加和会员剩余天数*/
alter table `user` add column vip_left_day date;
/*修改已有和会员的天数为永久*/
update `user` set vip_left_day = '2099-12-31' where vip_flg = 2;

/*增加和会员天数记录表*/
create table user_point_vip(
	`id` int auto_increment primary key,
	`user_id` int not null comment '用户ID',
	`point_value` smallint not null comment '积分值',
	`source` tinyint not null comment '来源:1购买和会员、2使用会员卡、3推荐注册',
	`created_at` timestamp not null default '0000-00-00 00:00:00',
	`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`deleted_at` timestamp NULL DEFAULT NULL,
  `remark` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户和会员天数记录';


###############2017-09-23#################
/*增加和会员注册时间*/
alter table `user` add column `register_at` datetime default null comment '手机号注册时间';

###############2017-10-22#################
create table wechat_push
(
  id int unsigned auto_increment primary key,
  title varchar(255) default '' comment '客服消息名称',
  url varchar(255) default '' comment '文章链接',
  picurl varchar(255) default '' comment '图片链接',
  description varchar(1000) default '' comment '文章简介',
  push_time varchar(20) default '' comment '推送时间',  
  send_total bigint default 0 comment '推送总数',
  send_success bigint default 0 comment '推送成功数',
  `created_at` timestamp not null default '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='推送客服消息'

###############2017-11-04#################
alter table `vcourse_mark` add column parent_id int default 0 comment '父ID 0为一级ID';
