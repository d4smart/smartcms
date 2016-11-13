<?php
/**
 * Desp: 前台模块公共控制器，定义了一些前台的公共方法
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

        // 前台所需要的一些公共数据(网站配置,菜单,侧边栏)
        $data['config'] = D("Basic")->select();     // 获取网站配置
        $data['navs'] = D("Menu")->getBarMenus();   // 获取菜单栏
        $data['rankNews'] = $this->getRank();       // 获取文章排行
        $data['advNews'] = D("PositionContent")->select(array('status'=>1, 'position_id'=>3), 3); // 广告位数据

        $this->assign($data);
    }

    /**
     * 获取文章排行数据的控制器
     * @return array 按阅读量排序的文章
     */
    public function getRank() {
        $conditions['status'] = 1;
        $news = D("News")->getRank($conditions, 10);
        return $news;
    }

    /**
     * 前台错误页面
     * @param string $message 错误信息
     */
    public function error($message='') {
        $message = $message ? $message : "系统发生错误QAQ";

        // 获取网站配置
        $data['config'] = D("Basic")->select();
        // 获取菜单栏
        $data['navs'] = D("Menu")->getBarMenus();
        $this->assign($data);
        $this->assign('message', $message);

        $this->display("Public/error"); // 渲染错误模板
    }
}