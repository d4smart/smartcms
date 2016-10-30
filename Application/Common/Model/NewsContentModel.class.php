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
}
