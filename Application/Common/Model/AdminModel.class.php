<?php
/**
 * Desp: 用户模型
 * User: d4smart
 * Date: 2016/10/25
 * Time: 18:39
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class AdminModel extends Model
{
    private $admin = '';

    protected $_validate = array(
        array('username', 'require', '用户名称不得为空！', 1, 'regex', 1),
        array('password', 'require', '密码不得为空！', 1, 'regex', 1),
        array('email', 'email', '邮箱填写错误！', 0, 'regex', 3),
        array('username', '', '用户名称已存在！', 0, 'unique', 3),
        array('repassword', 'password', '密码不一致！', 1,'confirm', 1), // 验证确认密码是否和密码一致
        array('verify', 'check_verify', '验证码不正确！', 0, 'callback', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->admin = M('admin');
    }

    public function getAdminByUsername($username) {
        return $this->admin->where(array('username'=>$username))->find();
    }

    public function getAdmins() {
        $data = array(
            'status' => array('neq',-1),
        );
        return $this->admin->where($data)->order('admin_id')->select();
    }

    /**
     * 通过id更新用户状态
     * @param $id 用户id
     * @param $status 用户状态
     * @return bool 是否更新成功
     */
    public function updateStatusById($id, $status) {
        return $this->admin->where(array('admin_id'=>$id))->setField('status', $status);
    }

    public function getLastLoginUsers() {
        $time = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $data = array(
            'status' => 1,
            'lastlogintime' => array("gt",$time),
        );

        $res = $this->admin->where($data)->count();
        return $res;
    }

    /**
     * 用户登陆函数
     * 根据传递的username和password判断用户登录是否合法，并做出相应跳转
     * @return bool 登陆成功：true|登录失败：false
     */
    public function login() {
        $password = $this->password; //传递的密码
        $info = $this->admin->where(array('username'=>$this->username))->find(); //数据库中存储的密码（md5）

        // 是否存在用户并且密码输入是否正确
        if ($info && $info['password'] == getMd5Password($password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 验证码验证函数
     * @param $code, @param string $id
     * @return bool 验证码检查结果
     */
    public function check_verify($code, $id='') {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
}