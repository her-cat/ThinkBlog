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
namespace Home\Controller;
use Think\Controller;
use \Org\Util\BlogCache;

/**
 * ThinkBlog 前台公共类
 */
class CommonController extends Controller {
    /**
     * 初始化配置信息
     */
    public function _initialize() {
        $blogName = C('blog_name');
        if(empty($blogName)){
            $configCache = BlogCache::getInstance()->readCache('config');
            foreach ($configCache as $k => $v){
                $config[$k] = $v;
            }
            C($config);
        }
    }

    public function _empty(){
        header("HTTP/1.0  404  Not Found");
        $this->display('Public/404');
    }
}