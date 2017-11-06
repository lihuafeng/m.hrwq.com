<?php

return [
    'admin_url' => 'http://mcc.hrwq.com/', //测试环境图片上传地址
    'front_url' => 'http://m.hrwq.com/',
    //线下支付汇款信息
    'card_no' => '6215 5902 0000 5572 466',
    'opening_bank' => '工商银行',
    'card_holder' => '雷竹琴',
    'partner_apply_tel' => '4006363555',
    'opo_tel' => '4006363555',
    'admin_mobile' => '18611115291',
    'opo_manager_mobile' => '18611115291',
		
    //是否有硬件
    'hardware_list' => [
        '1'      => '无硬件',
        '2'      => '有硬件',
    ],

    //收费类型
    'type_list' => [
        '1'      => '免费',
        '2'      => '收费',
    ],

    //课程状态
    'status_list' => [
        '1'      => '未发布',
        '2'      => '已发布',
        '3'      => '已下架',
    ],

    //课程类别
    'recommend_list' => [
        '1'      => '未推荐',
        '2'      => '推荐',
    ],

    //是否点赞
    'likes_list' => [
        '1'      => '未点赞',
        '2'      => '点赞',
    ],

    //回答状态
    'answer_state' => [
        1=>'未回答',
        2=>'已回答'
    ],

    //轮播图片类型
    'carousel_type' => [
        1 => '好课',
        2 => '好看',
        3 => '登录页',
    	4 => '家长圈'
    ],

    //轮播图片跳转类型
    'carousel_redirect_type' => [
        1 => '不跳转',
        2 => '外部链接',
        3 => '本地静态页'
    ],

    //todo 文案类型  前后台，数据库配置保持统一
    'article_type' => [
        1 => '服务协议',
        2 => '关于我们',
        3 => '积分规则',
        4 => '成长值介绍',
        6 => '和会员介绍',
        7 => '帮助中心',
        8 => '收益介绍',
        9 => '成为合伙人'
    ],

    //热门搜索类型
    'hot_search_type' => [
        1 => '好看',
        2 => '好课',
        3 => '好问'
    ],

    //优惠券类型
    'coupon_type' => [
        1 => '代金券',
        2 => '折扣券'
    ],

    //优惠券使用范围
    'coupon_use_scope' => [
        1=>'全场',
        2=>'好课全场',
        3=>'好看全场',
        4=>'壹家壹',
        5=>'好问',
        6=>'好课中某类',
        7=>'好课中的某课',
        8=>'好看中的某类',
        9=>'好看中的某课'
    ],
    //优惠券有效期类型
    'coupon_period_type' => [
        1=>'天数',
        2=>'起止时间'
    ],

    //获取规则
    'coupon_get_rule' => [
        1=>'邀请注册',
        2=>'自主注册',
        3=>'好课，壹家壹支付完成分享红包',
    ],
    //优惠券来源
    'coupon_get_from' => [
        1=>'邀请注册',
        2=>'自主注册',
        3=>'好课，壹家壹支付完成分享红包',
        4=>'后台发放'
    ],


    //好看笔记是否公开
    'visible_list' => [
        1=>'公开',
        2=>'私密',
    ],

    //注册性别
    'user_sex' => [
        1=>'保密',
        2=>'男',
        3=>'女'
    ],

    //用户角色
    'user_role' => [
        1=>'普通用户',
        2=>'指导师',
        3=>'合伙人'
    ],   

    //用户称呼
    'user_label' => [
        1=>'暂无',
        2=>'爸爸',
        3=>'妈妈'
    ],     

    //是否为和会员
    'user_vip_flg' => [
        1=>'否',
        2=>'是'
    ],

    //优惠券状态
    'coupon_use_status' => [
        1=>'已使用',
        2=>'未使用',
        3=>'已过期'
    ],

    // 指导师申请进度
    'tutor_apply_progress' => [
        1=>'资料审核中',
        2=>'资料审核通过',
        3=>'资料审核不通过',
        4=>'名片审核中',
        5=>'名片审核通过',
        6=>'名片审核不通过',
        7=>'冻结中'
    ],

    // 合伙人申请进度
    'partner_apply_progress' => [
        1=>'资料审核中',
        2=>'资料审核通过',
        3=>'资料审核不通过',
        4=>'冻结中'
    ],

    //订单所属大类
    'order_belong_category' => [
        1 => '好课',
        2 => '好看',
        3 => '壹家壹',
        4 => '好问提问',
        5 => '好问偷听',
        6 => '和会员'
    ],

    //收益比例类型
    'income_scale_keys' => [
        1 => '好问提问',
        2 => '旁听',
    	3 => '爱心大使指导师',
    	4 => '爱心大使合伙人',
    ],

    'income_point_source' => [
        1=>'注册',
        2=>'分享',
        3=>'抵现',
        4=>'发帖',
        5=>'评论',
        6=>'作业',
        7=>'笔记',
        8=>'推荐好友注册',
        9=>'后台操作',
        10=>'退还',
        11=>'年度清零',
        12=>'观看视频',
        13=>'消费',
        14=>'线下核销'
    ],

	/**
	 * 会员有效期
	 */
	'vip_point_source' => [
		1=>'购买和会员',
		2=>'会员卡',
		3=>'被分享奖励',
		4=>'邀请奖励',
		5=>'注册奖励'
	],
		
    //收益类型
    'income_in_type' => [
        1 => '好课',
        2 => '好看',
        3 => '壹家壹',
        4 => '好问',
        5 => '和会员',
        6 => '提现',
        7 => '系统其它',
        8 => '返款'
    ],

    //收益支付方式
    'income_pay_type' => [
        1 => '微信支付',
        2 => '银行转账',
        3 => '微信红包',
    ],

    //收益记录方式
    'income_log_type' => [
        1 => '收入',
        2 => '支出'
    ],


    //提现申请状态
    'income_cash_state' => [
        1 => '待处理',
        2 => '驳回',
        3 => '已完成'
    ],

    //支付方式
    'pay_type' => [
        1 => '微信',
        2 => '线下转账'
    ],

    //单人or套餐
    'package_type' => [
        1 => '单人',
        2 => '套餐'
    ],

    //付款状态
    'order_type' => [
        1 => '未付款',
        2 => '已完成',//已付款
        3 => '已取消',
        4 => '已完成'
    ],

    //付款状态 好看专用
    'order_type_vcourse' => [
        1 => '未付款',
        2 => '已付款',
        3 => '已取消'
    ],

    //付款状态 和会员专用
    'order_type_vip' => [
        1 => '未付款',
        2 => '已付款',
        3 => '已取消'
    ],

    //壹家壹流程
    'opo_process' => [
        1 => '初步沟通',
        2 => '筛选测试',
        3 => '个性分析',
        4 => '成长规划',
        5 => '报告生成',
    ],

    //订单属性
    'order_type_question' => [
        4 => '提问',
        5 => '旁听'
    ],

    //报道状态
    'report_flg' => [
        1 => '未报到',
        2 => '已报到'
    ],

    //卡片账 来源
    'user_balance_source' => [
        1 => '邀请注册',
        2 => '分享红包',
        3 => '回答问题',
        4 => '被收听',
        5 => '抵现',
        6 => '提现',
        7 => '系统',
        8 => '退款',
    	9 => '推荐奖励'
    ],

    //卡片账 类型
    'user_balance_type' => [
        1 => '增加',
        2 => '减少'
    ],

    //智慧榜 固定显示个数
    'teacher_list_top'=> 2,
];
