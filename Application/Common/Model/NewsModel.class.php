<?php
/**
 * Desp: 新闻模型
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
    private $news = '';

    protected $_validate = array(
        array('title', 'require', '标题不得为空！', 1, 'regex', 3),
        array('small_title', 'require', '短标题不得为空！', 1, 'regex', 3),
        array('title_font_color', 'require', '标题颜色不得为空！', 1, 'regex', 3),
        array('catid', 'require', '所属栏目不得为空！', 1, 'regex', 3),
        array('description', 'require', '文章描述不得为空！', 1, 'regex', 3),
        array('keywords', 'require', '文章关键词不得为空！', 1, 'regex', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->news = M('news');
    }

    public function insert($data=array()) {
        $data['username'] = getLoginUsername();
        $data['create_time'] = time();
        $data['update_time'] = time();
        return $this->news->add($data);
    }

    public function select($data = array(), $limit = 0) {
        if ($data['title']) {
            $data['title'] = array('like', '%'.$data['title'].'%');
        }
        $this->news->where($data)->order('listorder desc, news_id');
        if ($limit) {
            $this->news->limit($limit);
        }
        $list = $this->news->select();
        return $list;
    }

    public function getNews($conditions, $page, $pageSize=10) {
        if (isset($conditions['title']) && $conditions['title']) {
            $conditions['title'] = array('like', '%'.$conditions['title'].'%');
        }

        $offset = ($page - 1) * $pageSize;
        $list = $this->news->where($conditions)
                ->order('listorder desc, news_id')
                ->limit($offset, $pageSize)->select();
        return $list;
    }

    public function getNewsCount($conditions = array()) {
        if (isset($conditions['title']) && $conditions['title']) {
            $conditions['title'] = array('like', '%'.$conditions['title'].'%');
        }

        return $this->news->where($conditions)->count();
    }

    public function find($id) {
        return $this->news->find($id);
    }

    public function updateById($id, $data) {
        $data['update_time'] = time();
        return $this->news->where('news_id='.$id)->save($data);
    }

    public function updateStatusById($id, $status) {
        return $this->news->where('news_id='.$id)->setField('status', $status);
    }

    public function updateListOrderById($id, $listorder) {
        return $this->news->where('news_id='.$id)->setField('listorder', $listorder);
    }

    public function getNewsByNewsIdIn($newsIds = array()) {
        $data = array(
            'news_id' => array('in', implode(',', $newsIds)),
        );

        return $this->news->where($data)->select();
    }

    public function getRank($data = array(), $limit = 10) {
        $list = $this->news->where($data)->order('count desc, news_id')->limit($limit)->select();
        return $list;
    }

    public function updateCount($id, $count) {
        return $this->news->where('news_id='.$id)->setField('count', $count);
    }

    public function maxCount() {
        $data = array(
          'status' => 1,
        );
        return $this->news->where($data)->order('count desc')->find();
    }
}