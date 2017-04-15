<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql', //数据库类型
    'DB_HOST'=>'localhost', //服务器地址
    'DB_NAME'=>'wehavecars', //数据库名
    'DB_USER'=>'vc', //用户名
    'DB_PWD'=>'jhx2', //密码
    'DB_PORT'=>3306, //端口
    'DB_PREFIX'=>'', //数据库表前缀

    'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'Public/layout',

    //关闭页面Trace功能
    'SHOW_PAGE_TRACE' =>false, 

    //设置模块以及默认模块
    'MODULE_ALLOW_LIST' => array('Home','Admin'),
    'DEFAULT_MODULE' => 'Home', // 默认模块，可以省去模块名输入

    //设置多个伪静态后缀
    'URL_HTML_SUFFIX'=>'html|shtml|xml',
    //禁止访问的后缀
    'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg'
);