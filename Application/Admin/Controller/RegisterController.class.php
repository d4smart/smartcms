<?php
/**
 * Desp: 用户注册控制器
 * User: d4smart
 * Date: 2016/11/9
 * Time: 9:55
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class RegisterController extends Controller
{
    /**
     * 用户注册页面
     */
    public function index() {
        // 显示注册页面
        $this->display();
    }

    /**
     * 用户注册方法
     * 对传入的post数据进行合法性检查，并添加合法的数据，发挥状态信息
     */
    public function register() {
        if ($_POST) {
            $admin = D('Admin');
            // 注册模式数据验证
            if ($admin->create($_POST)) {
                if ($admin->add()) {
                    return show(1, "注册成功！");
                } else {
                    return show(0, "注册失败！");
                }
            } else {
                return show(0, $admin->getError());
            }
        } else {
            return show(0, "没有提交数据！");
        }
    }

    /**
     * 验证码生成函数
     * 可以在页面中通过url触发
     */
    public function verify() {
        $verify = new \Think\Verify();
        $verify->fontSize = 30;
        $verify->length = 4;
        $verify->useNoise = true;
        $verify->entry();
    }
}
