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
 * 配置模型
 * @package Admin\Model
 */
class ConfigModel extends Model{
    /**
     * 获取配置信息
     * @return mixed
     */
    public function getConfigs(){
        return $this->select();
    }

    /**
     * 更新配置
     * @param $name 配置名
     * @param $value 配置值
     */
    public function updateConfig($name, $value){
        $this->where(array('name' => $name))->setField('value', $value);
    }
}