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
use Org\Util\BlogCache;

/**
 * 友情链接模型
 * @package Admin\Model
 */
class LinkModel extends Model{

    /**
     * 添加友情链接
     * @param $linkData 友情链接数据
     * @return mixed 链接ID OR false
     */
    public function addLink($linkData) {
        if ($linkData['taxis'] > 30000 || $linkData['taxis'] < 0) {
            $linkData['taxis'] = 0;
        }
        return $this->add($linkData);
    }

    /**
     * 删除友情链接
     * @param $linkId
     * @return bool 是否成功
     */
    public function deleteLink($linkId) {
        return $this->where(array('id' => $linkId))->delete();
    }

    /**
     * 更新友情链接
     * @param $linkId 友情链接ID
     * @param $linkData 友情链接数据
     * @return bool 是否成功
     */
    public function updateLink($linkId, $linkData) {
        return $this->where(array('id' => $linkId))->setField($linkData);
    }

    /**
     * 获取友情链接
     * @return array 所有的链接
     */
    public function getLinks(){
        return $this->order('taxis ASC')->select();
    }

    /**
     * 获取一条友情链接
     * @param $linkId 友情链接ID
     * @return array 友情链接信息
     */
    public function getOneLink($linkId) {
        $linkData = $this->where(array('id' => $linkId))->find();
        return $linkData;
    }
}