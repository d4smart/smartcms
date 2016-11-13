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
    // 数据库实例
    private $news = '';

    // 静态自动完成规则
    protected $_auto = array(
        array('create_time', 'time', 1, 'function'),
        array('update_time', 'time', 3, 'function'),
        array('username', 'getLoginUsername', 1, 'function'),
        array('listorder', '0'),  // 新增的时候把listorder字段设置为1
        array('status', '1'),  // 新增的时候把status字段设置为1
    );

    // 静态验证规则
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

    /**
     * 根据查询条件，页码和页大小获取文章信息
     * @param array $conditions 查询条件（模糊查询）
     * @param int $page 页码
     * @param int $pageSize 页大小
     * @return array 文章信息
     */
    public function getNews($conditions=array(), $page, $pageSize=10) {
        // 文章标题使用like模糊查询
        if (isset($conditions['title']) && $conditions['title']) {
            $conditions['title'] = array('like', '%'.$conditions['title'].'%');
        }

        $offset = ($page - 1) * $pageSize;
        $list = $this->news->where($conditions)
                ->order('listorder desc, news_id')
                ->limit($offset, $pageSize)->select();
        return $list;
    }

    /**
     * 获取满足条件的文章数
     * @param array $conditions 查询条件
     * @return int 文章数
     */
    public function getNewsCount($conditions = array()) {
        // 文章标题使用like模糊查询
        if (isset($conditions['title']) && $conditions['title']) {
            $conditions['title'] = array('like', '%'.$conditions['title'].'%');
        }

        return $this->news->where($conditions)->count();
    }

    /**
     * 根据文章id更新文章状态
     * @param int $id 文章id
     * @param int $status 文章状态
     * @return bool 更新是否成功
     */
    public function updateStatusById($id, $status) {
        return $this->news->where(array('news_id' => $id))->setField('status', $status);
    }

    /**
     * 根据文章id更新文章排序
     * @param int $id 文章id
     * @param int $listorder 文章排序
     * @return bool 排序是否成功
     */
    public function updateListOrderById($id, $listorder) {
        return $this->news->where(array('news_id' => $id))->setField('listorder', $listorder);
    }

    /**
     * 获取id在传入数组中的文章数据
     * @param array $newsIds 要获取的文章id数组
     * @return array 文章数据
     */
    public function getNewsByNewsIdIn($newsIds = array()) {
        $data = array(
            'news_id' => array('in', implode(',', $newsIds)),
        );
        return $this->news->where($data)->select();
    }

    /**
     * 根据传入的条件和记录数获取按阅读数排序的文章数据
     * @param array $data 查询条件
     * @param int $limit 查询的文章条数
     * @return array 文章数据
     */
    public function getRank($data = array(), $limit = 10) {
        $list = $this->news->where($data)->order('count desc, news_id')->limit($limit)->select();
        return $list;
    }

    /**
     * 根据文章id更新文章的阅读数
     * @param int $id 文章id
     * @param int $count 文章阅读数
     * @return bool 更新文章阅读数是否成功
     */
    public function updateCount($id, $count) {
        return $this->news->where(array('news_id' => $id))->setField('count', $count);
    }

    /**
     * 获取阅读数最大的文章数据
     * @return array 文章数据
     */
    public function maxCount() {
        $data = array(
          'status' => 1,
        );
        return $this->news->where($data)->order('count desc')->find();
    }
}