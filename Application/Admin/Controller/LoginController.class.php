<?php
/**
 * 登陆控制器
 */
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{

    public function index() {
        if (session('adminUser')) {
            $this->redirect('/admin.php?c=index');
        }
    	$this->display();
    }

    public function check() {
        $username = I('username');
        $password = I('password');
        if (!trim($username)) {
            return show(0, '用户名不能为空！');
        }
        if (!trim($password)) {
            return show(0, '密码不能为空！');
        }

        $ret = D('Admin')->getAdminByUsername($username);
        if ($ret && $ret['status'] != -1) {
            if ($ret['password'] == getMd5Password($password)) {
                D("Admin")->updateByAdminId($ret['admin_id'], array(
                    'lastlogintime' => time(),
                    //'lastloginip' => getenv('HTTP_CLIENT_IP'),
                ));
                session('adminUser', $ret);
                return show(1, '登陆成功！');
            } else {
                return show(0, '密码错误！');
            }
        } else {
            return show(0, '该用户不存在或已被锁定！');
        }
    }

    public function logout() {
        session('adminUser', null);
        $this->redirect('/admin.php?c=login');
    }

}