<?php
/**
 * Desp: 网站配置信息控制器
 * User: d4smart
 * Date: 2016/11/1
 * Time: 19:19
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class BasicController extends CommonController
{
    /**
     * 后台基本配置页面
     * 显示网站的基本配置（可以修改并提交）
     */
    public function index() {
        $result = D("Basic")->select();
        $this->assign('vo', $result);
        $this->assign('type', 1);
        $this->display();
    }

    /**
     * 网站配置添加方法
     * 保存对网站配置的修改并返回结果
     */
    public function add() {
        if ($_POST) {
            if (!I('title')) {
                return show(0, "站点标题不能为空！");
            }
            if (!I('keywords')) {
                return show(0, "站点关键词不能为空！");
            }
            if (!I('description')) {
                return show(0, "站点描述不能为空！");
            }

            D("Basic")->save($_POST);
            return show(1, "配置成功！");
        } else {
            return show(0, "没有提交的数据！");
        }
    }

    /**
     * 后台缓存配置页面
     * 显示缓存配置页面（可以更新缓存）
     */
    public function cache() {
        $this->assign('type', 2);
        $this->display();
    }
}