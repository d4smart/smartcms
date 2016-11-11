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
    private $position_content = '';

    protected $_validate = array(
        array('title', 'require', '推荐位标题不得为空！', 1, 'regex', 3),
        array('position_id', 'require', '推荐位位置不得为空！', 1, 'regex', 3),
        array('thumb', 'require', '缩略图不得为空！', 1, 'regex', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->position_content = M('position_content');
    }

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

    public function insert($data=array()) {
        return $this->position_content->add($data);
    }

    public function updateById($id, $data) {
        return $this->position_content->where('id='.$id)->save($data);
    }

    public function updateStatusById($id, $status) {
        return $this->position_content->where('id='.$id)->setField('status', $status);
    }

    public function updateListorderById($id, $listorder) {
        return $this->position_content->where('id='.$id)->setField('listorder', $listorder);
    }
}