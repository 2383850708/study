<?php
return array(

	'MODULE_ALLOW_LIST'=>array('Admin','Home'),//允许访问的文件
	//'DEFAULT_MODULE'=>'Admin',//设置默认加载模块                                                                                
		
	'SHOW_PAGE_TRACE'=>true,//调试模式（页面trace）

	'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => 'bdm114585572.my3w.com', // 服务器地址
    'DB_NAME'   => 'bdm114585572_db', // 数据库名
    'DB_USER'   => 'bdm114585572', // 用户名
    'DB_PWD'    => 'qwaszX3079416', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'think_', // 数据库表前缀 
    // 开启路由
	'URL_ROUTER_ON'   => false, 
	'URL_ROUTE_RULES'=>array(
		//静态地址
		// 'uu'=>'User/user',
		// 'ui'=>'User/index',
		//静态+动态
		//'uu/[:name\d|md5]'=>'User/user',//id是动态的  http://localhost:8080/thinkphp_3.2.3_new/uu/小三
		//'/^uu\/(\d{2})\/(\d{2})$/'=>'User/   ?id=:1&name=:2',
	),
	'LONG_JUMP_TIME'=>3,

	'AUTH_CONFIG'=>array(  
        'AUTH_ON' => true, //认证开关  
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。  
        'AUTH_GROUP' => 'think_auth_group', //用户组数据表名  
        'AUTH_GROUP_ACCESS' => 'think_auth_group_access', //用户组明细表  
        'AUTH_RULE' => 'think_auth_rule', //权限规则表  
        'AUTH_USER' => 'think_user'//用户信息表  
    ) 
	
/*	'LANG_SWITCH_ON' => true,   // 开启语言包功能
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
	'VAR_LANGUAGE'     => 'lang', // 默认语言切换变量*/
	
); 