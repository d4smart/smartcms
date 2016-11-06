<?php
/**
 * Desp: 前台模块公共控制器，拥有一些公共方法
 * User: d4smart
 * Date: 2016/11/2
 * Time: 12:46
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller
{
    public function __construct() {
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();
    }

    public function getRank() {
        $conditions['status'] = 1;
        $news = D("News")->getRank($conditions, 10);
        return $news;
    }

    public function error($message='') {
        $message = $message ? $message : "系统发生错误";
        $this->assign('message', $message);
        $this->display("Index/error");
    }
}