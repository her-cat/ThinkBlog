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

class UserModel extends Model{
    /**
     * 获取单个用户信息
     * @param $uid 用户ID
     * @return mixed
     */
    public function getOneUser($uid){
        return $this->where(array('id' => $uid))->find();
    }

    /**
     * 获取用户头像
     * @param $uid 用户ID
     * @return mixed
     */
    public function getUserHead($uid){
        return $this->where(array('id' => $uid))->getField('head');
    }


    public function updateUser($uid, $userData){
        return $this->where(array('id' => $uid))->setField($userData);
    }
}