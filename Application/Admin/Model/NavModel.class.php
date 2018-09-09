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
use Org\Util\BlogCache;
use Think\Model;

/**
 * 外观模块
 * @package Admin\Model
 */
class NavModel extends Model{

    /**
     * 添加导航
     * @param $navData 导航数据
     * @return mixed
     */
    public function addNav($navData){
        if($navData['taxis'] > 30000 || $navData['taxis'] < 0) {
            $navData['taxis'] = 0;
        }
        return $this->add($navData);
    }

    /**
     * 删除导航
     * @param $nid 导航ID
     */
    public function deleteNav($nid){
        $this->where(array('parent_id' => $nid))->setField('parent_id', '0');
        $this->where(array('id' => $nid))->delete();
    }

    /**
     * 更新导航
     * @param $nid 导航ID
     * @param $navData 导航数据
     * @return bool
     */
    public function updateNav($nid, $navData){
        return $this->where(array('id' => $nid))->setField($navData);
    }

    /**
     * 获取一条导航
     * @param $nid 导航ID
     * @return mixed
     */
    public function getOneNav($nid){
        return $this->where(array('id' => $nid))->find();
    }

    /**
     * 根据URL获取导航名
     * @param $url URL地址
     * @return string 导航名
     */
    public function getNavNameByUrl($url){
        $navs = BlogCache::getInstance()->readCache('nav');
        foreach ($navs as $v){
            if ($v['url'] == $url){
                return $v['name'];
            }
        }
        return '';
    }
}