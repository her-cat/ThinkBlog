<?php
namespace Home\Controller;
use Think\Controller;
use Think\Core_Lib_Page;

class EmptyController extends  CommonController{
    /**
     * 空控制器时调用此函数
     */
    public function index(){
        $this->_empty();
    }
}