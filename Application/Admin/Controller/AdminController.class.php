<?php
/**
 * 用户管理控制器
 */

namespace Admin\Controller;
use Think\Exception;

class AdminController extends CommonController
{
    public function index() {
        $admin = D('Admin');
        $admins = $admin->getAdmins();
        $this->assign('admins', $admins);
        $this->display();
    }

    public function add() {
        if(IS_POST) {
            // 保存数据
            $admin = D('Admin');
            $_POST['password'] = getMd5Password($_POST['password']);

            if ($admin->create($_POST)) {
                if ($admin->add()) {
                    return show(1, '新增成功');
                } else {
                    return show(0, '新增失败');
                }
            } else {
                return show(0, $admin->getError());
            }
        }
        $this->display();
    }

    public function setStatus() {
        $admin = D('Admin');

        $res = $admin->updateStatusById(I('id'), I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }

    public function personal() {
        $res = $this->getLoginUser();
        $user = D("Admin")->find($res['admin_id']);
        $this->assign('vo',$user);
        $this->display();
    }

    public function save() {
        $admin = D('Admin');
        $user = $this->getLoginUser();
        if(!$user) {
            return show(0,'用户不存在');
        }

        $_POST['admin_id'] = $user['admin_id'];

        if ($admin->create($_POST)) {
            if ($admin->save()) {
                return show(1, '配置成功');
            } else {
                return show(0, '配置失败（可能是数据未作修改）');
            }
        } else {
            return show(0, $admin->getError());
        }
    }

}