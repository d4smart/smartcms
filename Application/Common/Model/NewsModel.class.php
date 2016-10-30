<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/28
 * Time: 13:50
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class NewsModel extends Model
{
    private $_db = '';

    public function __construct() {
        parent::__construct();
        $this->_db = M('news');
    }

    public function insert($data=array()) {
        if (!is_array($data) || !$data) {
            return 0;
        }

        $data['username'] = getLoginUsername();
        $data['create_time'] = time();
        return $this->_db->add($data);
    }

    public function getNews($data, $page, $pageSize=10) {
        $conditions = $data;

        if (isset($data['title']) && $data['title']) {
            $conditions['title'] = array('like', '%'.$data['title'].'%');
        }
        if (isset($data['catid']) && $data['catid']) {
            $conditions['catid'] = intval($data['catid']);
        }
        $conditions['status'] = array('neq', -1);

        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($conditions)
                ->order('listorder desc, news_id')
                ->limit($offset, $pageSize)->select();
        return $list;
    }

    public function getNewsCount($data = array()) {
        $conditions = $data;

        if (isset($data['title']) && $data['title']) {
            $conditions['title'] = array('like', '%'.$data['title'].'%');
        }
        if (isset($data['catid']) && $data['catid']) {
            $conditions['catid'] = intval($data['catid']);
        }

        return $this->_db->where($conditions)->count();
    }
}