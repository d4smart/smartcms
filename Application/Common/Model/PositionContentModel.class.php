<?php
/**
 * Desp: 推荐位内容模型
 * User: d4smart
 * Date: 2016/10/31
 * Time: 11:12
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class PositionContentModel extends Model
{
    // 数据库实例
    private $position_content = '';

    // 静态自动完成方法
    protected $_auto = array(
        array('create_time', 'time', 1, 'function'),
        array('update_time', 'time', 3, 'function'),
        array('listorder', '0'),  // 新增的时候把listorder字段设置为1
    );

    // 静态验证方法
    protected $_validate = array(
        array('title', 'require', '推荐位标题不得为空！', 1, 'regex', 3),
        array('position_id', 'require', '推荐位位置不得为空！', 1, 'regex', 3),
        array('thumb', 'require', '缩略图不得为空！', 1, 'regex', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->position_content = M('position_content');
    }

    /**
     * 对原有select方法的拓展，根据查询条件和限制数获取推荐位内容数据
     * @param array $data 查询条件
     * @param int $limit 限制数
     * @return array 推荐位内容数据
     */
    public function select($data = array(), $limit = 0) {
        if ($data['title']) {
            $data['title'] = array('like', '%'.$data['title'].'%');
        }
        $this->position_content->where($data)->order('listorder desc, id desc');
        if ($limit) {
            $this->position_content->limit($limit);
        }
        $list = $this->position_content->select();
        return $list;
    }

    /**
     * 根据推荐位内容id更新推荐位内容状态
     * @param int $id 推荐位内容id
     * @param int $status 推荐位内容状态
     * @return bool 更新是否成功
     */
    public function updateStatusById($id, $status) {
        return $this->position_content->where(array('id' => $id))->setField('status', $status);
    }

    /**
     * 根据推荐位内容id更新推荐位内容排序
     * @param int $id 推荐位内容id
     * @param int $listorder 推荐位内容排序
     * @return bool 排序是否成功
     */
    public function updateListorderById($id, $listorder) {
        return $this->position_content->where(array('id' => $id))->setField('listorder', $listorder);
    }
}