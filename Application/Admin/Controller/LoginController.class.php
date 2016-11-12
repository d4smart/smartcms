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
        $ret = D('Admin')->getAdminByUsername($username);
        $_POST['admin_id'] = $ret['admin_id'];

        if ($ret && $ret['status'] != -1) {
            $admin = D('Admin');
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
            return show(0, '该用户不存在或已被锁定！');
        }
    }

    /**
     * 验证码生成函数
     */
    public function verify() {
        $verify = new \Think\Verify();
        $verify->fontSize = 30;
        $verify->length = 4;    //4位验证码
        $verify->useNoise = true; //使用噪点
        $verify->entry();
    }

    public function logout() {
        session('adminUser', null);
        $this->redirect('/admin.php?c=login');
    }

}