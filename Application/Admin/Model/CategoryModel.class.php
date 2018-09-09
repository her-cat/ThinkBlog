<?php
// +----------------------------------------------------------------------
// | ThinkBlog [ Interest is the best teacher ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 https://github.com/her-cat/ThinkBlog All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: her-cat<hxhsoft@foxmail.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 分类模型
 * @package Admin\Model
 */
class CategoryModel extends Model{
    /**
     * 获取所有分类
     * @return mixed
     */
    public function getCates(){
        return $this->order('taxis ASC')->select();
    }

    /**
     *  获取一条分类
     * @param $cid 分类ID
     * @return array
     */
    public function getOneCate($cid){
        $cate = array();
        if ($cid > 0){
            $row = $this->where(array('id' => $cid))->find();
            $cate['id'] = intval($row['id']);
            $cate['name'] = htmlspecialchars(trim($row['name']));
            $cate['alias'] = $row['alias'];
            $cate['parent_id'] = intval($row['parent_id']);
        }else{
            $cate['name'] = '未分类';
            $cate['alias'] = 'post';
            $cate['parent_id'] = 0;
        }
        return $cate;
    }

    /**
     * 获取分类名称
     * @param $cid 分类ID
     * @return mixed|string
     */
    public function getCateName($cid){
        if ($cid > 0){
            return $this->where(array('id' => $cid))->getField('name');;
        }else{
            return '未分类';
        }
    }

    /**
     * 添加分类
     * @param $cateData 分类数据
     * @return mixed
     */
    public function addCate($cateData){
        return $this->add($cateData);
    }

    /**
     * 更新分类
     * @param $cid 分类ID
     * @param $cateData 分类数据
     * @return bool
     */
    public function updateCate($cid, $cateData) {
        return $this->where(array('id' => $cid))->setField($cateData);
    }

    /**
     * 删除分类
     * @param $cid 分类ID
     */
    public function deleteCate($cid){
        $this->where(array('parent_id' => $cid))->setField('parent_id', 0);
        $this->where(array('id' => $cid))->delete();
        $this->table('__ARTICLE__')->where(array('category' => $cid))->setField('category', '-1');
    }

    /**
     * 判断分类别名是否重复
     * @param $cateAlias 分类别名
     * @param string $cid 分类ID
     * @return bool
     */
    function isRepeatAlias($cateAlias, $cid = '') {
        $map['alias'] = $cateAlias;
        !empty($cid) && $map['id'] = array('neq', $cid);
        $alias = $this->where($map)->getField('alias');
        return empty($alias) ? false : true;
    }
}