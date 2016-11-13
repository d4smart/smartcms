<?php
/**
 * 用户管理控制器
 */

namespace Admin\Controller;
use Think\Exception;

class AdminController extends CommonController
{
    /**
     * 后台用户管理首页
     * 显示没有被删除的所有用户数据
     */
    public function index() {
        $admin = D('Admin');
        $admins = $admin->getAdmins();
        $this->assign('admins', $admins);
        $this->display();
    }

    /**
     * 后台用户添加页面
     * 如果有提交的post数据，添加用户并根据结果做出响应；否则显示用户添加页面
     */
    public function add() {
        if(IS_POST) {
            // 保存数据
            $admin = D('Admin');

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

    /**
     * 用户状态设置方法
     * 设置用户的状态，并返回结果
     */
    public function setStatus() {
        $admin = D('Admin');

        $res = $admin->updateStatusById(I('id'), I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }

    /**
     * 用户个人中心页面
     * 获取数据并显示用户个人中心页面
     */
    public function personal() {
        $res = $this->getLoginUser();
        $user = D("Admin")->find($res['admin_id']);
        $this->assign('vo',$user);
        $this->display();
    }

    /**
     * 用户数据保存（更新）方法
     * 保存用户数据的修改并返回结果
     */
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