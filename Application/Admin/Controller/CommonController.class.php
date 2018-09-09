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

namespace Admin\Controller;
use Org\Util\BlogCache;
use Think\Controller;
use Org\Util\Tools;

/**
 * 后台公共模块
 * @package Admin\Controller
 */
class CommonController extends Controller {
    protected static $Cache = null;
    /**
     * 初始化配置信息
     */
    public function __construct() {
        parent::__construct();
        if (!Tools::isLogin()) {
            Tools::loginOut();
            $this->error('请先登录！', U('Login/index'));
        }
        if (self::$Cache == null){
            self::$Cache = BlogCache::getInstance();
        }
        $blogName = C('blog_name');
        if(empty($blogName)){
            $configCache = self::$Cache->readCache('config');
            foreach ($configCache as $k => $v){
                $config[$k] = $v;
            }
            C($config);
        }
    }

    /**
     * 退出登录
     */
    public function exitLogin(){
        Tools::loginOut();
        $this->success('注销成功！', U('Login/index'));
    }

    /**
     * 更新缓存
     */
    public function updateCache(){
        self::$Cache->updateCache();
        $this->redirect('Index/index');
    }
}