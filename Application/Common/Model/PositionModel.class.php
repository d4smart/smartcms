<?php
/**
 * Desp: 推荐位模型
 * User: d4smart
 * Date: 2016/10/31
 * Time: 9:28
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class PositionModel extends Model
{
    private $position = '';

    protected $_auto = array(
        array('create_time', 'time', 1, 'function'),
        array('update_time', 'time', 3, 'function'),
    );

    protected $_validate = array(
        array('name', 'require', '推荐位标题不得为空！', 1, 'regex', 3),
        array('description', 'require', '推荐位描述不得为空！', 1, 'regex', 3),
        array('status', 'require', '推荐位状态不得为空！', 1, 'regex', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->position = M("position");
    }

    public function updateStatusById($id, $status) {
        return $this->position->where(array('id' => $id))->setField('status', $status);
    }

    /**
     * 获取正常的推荐为内容
     * @return mixed
     */
    public function getNormalPositions() {
        $conditions = array('status'=>array('neq', -1));
        $list = $this->position->where($conditions)->order('id')->select();
        return $list;
    }

    public function getCount($conditions=array()) {
        return $this->position->where($conditions)->count();
    }
}