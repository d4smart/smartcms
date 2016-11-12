<?php
// 应用入口文件，供命令行调用

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 执行方法检测
define('APP_CRONTAB', 1);

// 参数检测
if (!$argv || count($argv) < 4) {
    die("parmas is error.");
}
$dir = dirname(__FILE__);

// 根据传入的命令行参数设置模块，控制器，方法
$_GET['m'] = !isset($_GET['m']) ? $argv[1] : 'admin';
$_GET['c'] = !isset($_GET['c']) ? $argv[2] : 'index';
$_GET['a'] = !isset($_GET['a']) ? $argv[3] : 'index';

// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单