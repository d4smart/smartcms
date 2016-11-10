<?php
/**
 * Desp: 新闻内容模型
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

    protected $_validate = array(
        array('content', 'require', '文章内容不得为空！', 1, 'regex', 1),
    );

    public function __construct() {
        parent::__construct();
        $this->_db = M('news_content');
    }

    public function insert($data=array()) {
        $data['create_time'] = time();
        $data['update_time'] = time();
        if (isset($data['content']) && $data['content']) {
            $data['content'] = htmlspecialchars($data['content']);
        }
        return $this->_db->add($data);
    }

    public function find($id) {
        return $this->_db->find($id);
    }

    public function updateNewsById($id, $data) {
        $data['update_time'] = time();
        if (isset($data['content']) && $data['content']) {
            $data['content'] = htmlspecialchars($data['content']);
        }

        return $this->_db->where('news_id='.$id)->save($data);
    }

}
