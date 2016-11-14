<?php
return array(
	//'配置项'=>'配置值'

    // 前台模块URL规则
    'URL_ROUTE_RULES' => array(
        'news/:id\d'     =>  'Detail/index',
        'cate/:id\d'        =>  'Cat/index',
    ),
);