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
use Admin\Controller\CommonController;

/**
 * 分类模块
 * @package Admin\Controller
 */
class CategoryController extends CommonController{

    /**
     * 分类列表
     */
    public function categoryList(){
        $this->assign('categoryList', getCategoryList(0));
        $this->display();
    }

    /**
     * 添加分类
     */
    public function addCategory(){
        if (IS_POST) {
            $post = I('post.');
            $Category = D('Category');
            if (empty($post['name'])) { $this->error('分类名不能为空！'); }
            if (empty($post['alias'])) { $this->error('别名不能为空！'); }
            if($Category->isRepeatAlias($post['alias'])){ $this->error('别名已存在！'); }
            if (!(preg_match("|^[\w-]+$|", $post['alias'])) || (preg_match("|^[0-9]+$|", $post['alias'])) || (in_array($post['alias'], array('post','record','sort','tag','author','page')))) {
                $this->error('别名格式不正确！');
            }
            $Category->addCate($post);
            self::$Cache->updateCache(array('category', 'nav'));
            $this->success('添加成功！');
        }else{
            $this->redirect('Category/categoryList');
        }
    }

    /**
     * 删除分类
     */
    public function deleteCategory(){
        $cid = isset($_GET['cid']) ? I('get.cid') : '';
        if (!empty($cid)) {
            D('Category')->deleteCate($cid);
            self::$Cache->updateCache(array('category', 'articleCategory', 'nav'));
            $this->success('删除成功！', U('Category/categoryList'));
        }else{
            $this->redirect('Category/categoryList');
        }
    }

    /**
     * 修改分类
     */
    public function editCategory(){
        $Category = D('Category');
        if (IS_POST) {
            $post = I('post.');
            if (empty($post['name'])) { $this->error('分类名不能为空！'); }
            if (empty($post['alias'])) { $this->error('别名不能为空！'); }
            if($Category->isRepeatAlias($post['alias'], $post['cid'])){ $this->error('别名已存在！'); }
            if (!(preg_match("|^[\w-]+$|", $post['alias'])) || (preg_match("|^[0-9]+$|", $post['alias'])) || (in_array($post['alias'], array('post','record','sort','tag','author','page')))) {
                $this->error('别名格式不正确！');
            }
            $Category->updateCate($post['cid'], $post);
            self::$Cache->updateCache(array('category', 'articleCategory', 'nav'));
            $this->success('修改成功！', U('Category/categoryList'));
        }else{
            $cid = I('get.cid');
            if (isset($cid)) {
                $cate = $Category->getOneCate($cid);
                if ($cate) {
                    $parentCategory = $Category->where(array('parent_id' => 0))->select();
                    $this->assign('category', $cate);
                    $this->assign('parentCategory', $parentCategory);
                    $this->display();
                }else{
                    $this->redirect('Category/categoryList');
                }
            }else{
                $this->redirect('Category/categoryList');
            }
        }
    }

    /**
     * 更新排序
     */
    public function updateOrder(){
        if (IS_POST) {
            $sort = isset($_POST['sort']) ? I('post.sort') : '';
            if (!empty($sort)) {
                $Category = D('Category');
                foreach ($sort as $k => $v) {
                    $Category->updateCate($k, array('taxis' => $v));
                }
                self::$Cache->updateCache('category');
                $this->success('修改成功！', U('Category/categoryList'));
            }else{
                $this->redirect('Category/categoryList');
            }
        }else{
            $this->redirect('Category/categoryList');
        }
    }
}