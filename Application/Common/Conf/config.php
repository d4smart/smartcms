<?php
return array(
	//'配置项'=>'配置值'

    // URL地址不区分大小写
    'URL_CASE_INSENSITIVE' => true,

    // URL模式
    'URL_MODEL' => 2,

    // 允许访问的模块列表
    'MODULE_ALLOW_LIST' => array('Home','Admin'),

    'DEFAULT_MODULE' => 'Home', // 默认模块

    // 额外加载的配置文件
    'LOAD_EXT_CONFIG' => 'db_config',

    // MD5加密后缀
    'MD5_SUF' => '小舟从此逝，江海寄余生',

    // 是否显示页面Trace信息
    'SHOW_PAGE_TRACE' => true,

    // html静态文件后缀
    'HTML_FILE_SUFFIX' => '.html',
);