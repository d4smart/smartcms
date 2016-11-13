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
    // 数据库实例
    private $admin = '';

    // 静态自动完成规则
    protected $_auto = array(
        array('password', 'getMd5Password', 3, 'function'), // password字段在新增和编辑的时候s使用md5加密处理
        array('join_time', 'time', 1, 'function'), // join_time字段在新增的时候写入当前时间戳
        array('status', '1'),  // 新增的时候把status字段设置为1
    );

    // 静态验证规则
    protected $_validate = array(
        array('username', 'require', '用户名称不得为空！', 1, 'regex', 1),
        array('password', 'require', '密码不得为空！', 1, 'regex', 1),
        array('email', 'email', '邮箱填写错误！', 0, 'regex', 3),
        array('username', '', '用户名称已存在！', 0, 'unique', 3),
        array('repassword', 'password', '密码不一致！', 0,'confirm', 1), // 验证确认密码是否和密码一致
        array('verify', 'check_verify', '验证码不正确！', 0, 'callback', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->admin = M('admin');
    }

    /**
     * 根据用户名获取用户的信息（用户名为唯一键）
     * @param string $username 用户名
     * @return array 用户的信息数组
     */
    public function getAdminByUsername($username) {
        return $this->admin->where(array('username'=>$username))->find();
    }

    /**
     * 获取状态不为删除（-1）的用户信息
     * @return array 用户信息二维数组
     */
    public function getAdmins() {
        $data = array(
            'status' => array('neq',-1),
        );
        return $this->admin->where($data)->order('admin_id')->select();
    }

    /**
     * 通过id更新用户状态
     * @param int $id 用户id
     * @param int $status 用户状态
     * @return bool 是否更新成功
     */
    public function updateStatusById($id, $status) {
        return $this->admin->where(array('admin_id'=>$id))->setField('status', $status);
    }

    /**
     * 获取今日登陆的用户数
     * @return int 用户数
     */
    public function getLastLoginUsers() {
        $time = mktime(0,0,0,date("m"),date("d"),date("Y")); // 今天的开始时间戳
        $data = array(
            'status' => 1,
            'lastlogintime' => array("gt",$time),
        );

        $res = $this->admin->where($data)->count();
        return $res;
    }

    /**
     * 用户登陆合法性检查函数
     * 根据传递的username和password判断用户登录是否合法
     * @return bool 登陆成功：true|登录失败：false
     */
    public function login() {
        $password = I('password'); //传递的密码
        $info = $this->admin->where(array('username'=>I('username')))->find(); //数据库中存储的密码（md5）

        // 判断是否存在用户并且密码输入是否正确
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