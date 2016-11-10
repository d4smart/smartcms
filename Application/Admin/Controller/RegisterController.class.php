<?php
/**
 * Desp:
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
     * 用户注册方法
     * 如果有post数据，判断用户输入合法性，添加用户并跳转；否则显示注册页面
     */
    public function index() {
        // 显示注册页面
        $this->display();
    }

    public function register() {
        if ($_POST) {
            $admin = D('Admin');
            // 注册模式数据验证
            if ($admin->create($_POST)) {
                // 对密码md5加密
                $_POST['password'] = getMd5Password(I('password'));

                if ($admin->add($_POST)) {
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

    public function check() {
        $admin = D('admin');
        // 注册模式数据验证
        if ($admin->create($_POST)) {
            // 对密码md5加密
            $admin->password = getMd5Password(I('password'));
            if ($admin->add()) {
                $this->success('注册成功，跳转中...', U('Login/index'));
            } else {
                $this->error('注册失败！');
            }
        } else {
            $this->error($admin->getError());
        }
        return;
    }

    /**
     * 验证码生成函数
     */
    public function verify() {
        $verify = new \Think\Verify();
        $verify->fontSize = 30;
        $verify->length = 4;
        $verify->useNoise = true;
        $verify->entry();
    }
}
