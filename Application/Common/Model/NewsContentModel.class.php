<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/28
 * Time: 14:03
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class NewsContentModel extends Model
{
    private $_db = '';

    public function __construct() {
        parent::__construct();
        $this->_db = M('news_content');
    }

    public function insert($data=array()) {
        if (!$data || !is_array($data)) {
            return 0;
        }

        $data['create_time'] = time();
        if (isset($data['content']) && $data['content']) {
            $data['content'] = htmlspecialchars($data['content']);
        }
        return $this->_db->add($data);
    }

    public function find($id) {
        if (!$id || !is_int($id)) {
            return 0;
        }
        return $this->_db->where('news_id='.$id)->find();
    }

    public function updateNewsById($id, $data) {
        if (!$id || !is_numeric($id)) {
            throw_exception("ID不合法！");
        }
        if (!$data || !is_array($data)) {
            throw_exception("更新数据不合法！");
        }

        $data['update_time'] = time();
        if (isset($data['content']) && $data['content']) {
            $data['content'] = htmlspecialchars($data['content']);
        }

        return $this->_db->where('news_id='.$id)->save($data);
    }
}
