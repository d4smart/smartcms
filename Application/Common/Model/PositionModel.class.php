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
    // 数据库示例
    private $position = '';

    // 静态自动完成方法
    protected $_auto = array(
        array('create_time', 'time', 1, 'function'),
        array('update_time', 'time', 3, 'function'),
    );

    // 静态验证方法
    protected $_validate = array(
        array('name', 'require', '推荐位标题不得为空！', 1, 'regex', 3),
        array('description', 'require', '推荐位描述不得为空！', 1, 'regex', 3),
        array('status', 'require', '推荐位状态不得为空！', 1, 'regex', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->position = M("position");
    }

    /**
     * 根据推荐位id更新推荐位的状态
     * @param int $id 推荐位id
     * @param int $status 推荐位状态
     * @return bool 更新状态是否成功
     */
    public function updateStatusById($id, $status) {
        return $this->position->where(array('id' => $id))->setField('status', $status);
    }

    /**
     * 获取没有被删除的推荐位内容
     * @return array 推荐位内容
     */
    public function getNormalPositions() {
        $conditions = array('status'=>array('neq', -1));
        $list = $this->position->where($conditions)->order('id')->select();
        return $list;
    }

    /**
     * 获取满足查询条件的推荐位数
     * @param array $conditions 查询条件
     * @return array 推荐位信息
     */
    public function getCount($conditions=array()) {
        return $this->position->where($conditions)->count();
    }
}