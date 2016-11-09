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
        $admins = $admin->where(array('status'=>array('neq', -1)))
                    ->order('admin_id')->select();
        $this->assign('admins', $admins);
        $this->display();
    }

    public function add() {
        // 保存数据
        if(IS_POST) {
            $admin = D('Admin');
            if(!isset($_POST['password'])) {
                return show(0, '密码不能为空');
            }
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

        $res = $admin->where(array('admin_id' => I('id')))
                    ->setField('status', I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }

    public function personal() {
        $res = $this->getLoginUser();
        $user = D("Admin")->getAdminByAdminId($res['admin_id']);
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