<?php
/**
 * 登陆控制器
 */
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{
    /**
     * 后台登陆页面
     * 判断用户是否已经登陆，有就跳转到后台首页；否则显示登陆页面
     */
    public function index() {
        if (session('adminUser')) {
            $this->redirect('/admin/index');
        }
    	$this->display();
    }

    /**
     * 用户登录函数
     * 判断用户登录是否合法，合法就更新数据库里的相关信息，将用户信息写入session，并返回状态信息
     */
    public function check() {
        $username = I('username');
        $ret = D('Admin')->getAdminByUsername($username);
        $_POST['admin_id'] = $ret['admin_id'];

        if ($ret && $ret['status'] != -1) {
            $admin = D('Admin');
            if ($admin->create($_POST)) {
                if ($admin->login()) {
                    $data = array(
                        'lastlogintime' => time(),
                        'lastloginip' => $_SERVER['REMOTE_ADDR'],
                    );
                    D('Admin')->where('admin_id='.$ret['admin_id'])->setField($data);
                    session('adminUser', $ret);
                    return show(1, '登陆成功！');
                } else {
                    return show(0, '您的用户名或密码错误！');
                }
            } else {
                return show(0, $admin->getError());
            }
        } else {
            return show(0, '该用户不存在或已被锁定！');
        }
    }

    /**
     * 验证码生成函数
     * 可以在页面中通过url触发
     */
    public function verify() {
        $verify = new \Think\Verify();
        $verify->fontSize = 30;
        $verify->length = 4;    //4位验证码
        $verify->useNoise = true; //使用噪点
        $verify->entry();
    }

    /**
     * 用户登出函数
     * 清空session信息，并跳转
     */
    public function logout() {
        session('adminUser', null);
        $this->redirect('/admin/login');
    }

}