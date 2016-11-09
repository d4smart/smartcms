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
    private $_db = '';
    protected $_validate = array(
        array('username', 'require', '用户名称不得为空！', 1, 'regex', 3),
        array('password', 'require', '密码不得为空！', 1, 'regex', 1),
        array('email', 'email', '邮箱填写错误！', 1, 'regex', 3),
        array('username', '', '用户名称已存在！', 1, 'unique', 3),
        array('repassword', 'password', '密码不一致！', 1,'confirm', 1), // 验证确认密码是否和密码一致
        //array('verify', 'check_verify', '验证码不正确！', 1, 'callback', 4),
    );

    public function __construct() {
        parent::__construct();
        $this->_db = M('admin');
    }

    public function getAdminByUsername($username) {
        return $this->_db->where(array('username'=>$username))->find();
    }

    public function getAdminByAdminId($adminId=0) {
        return $this->_db->find($adminId);
    }

    public function updateByAdminId($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }

        $data['admin_id'] = $id;
        if ($this->_db->create($data)) {
            return $this->_db->save();
        } else {
            return 0;
        }
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    public function getAdmins() {
        $data = array(
            'status' => array('neq',-1),
        );
        return $this->_db->where($data)->order('admin_id')->select();
    }

    /**
     * 通过id更新用户状态
     * @param $id 用户id
     * @param $status 用户状态
     * @return bool 是否更新成功
     */
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }

        return $this->_db->where(array('admin_id'=>$id))->setField('status', $status);
    }

    public function getLastLoginUsers() {
        $time = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $data = array(
            'status' => 1,
            'lastlogintime' => array("gt",$time),
        );

        $res = $this->_db->where($data)->count();
        return $res['tp_count'];
    }
}