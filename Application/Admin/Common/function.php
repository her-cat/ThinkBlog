<?php
// function insertTag($aid, $tagStr){
//     $tagArr = explode(',', $tagStr);
//     $Tag = M('Tag');
//     $allTag = $Tag->getField('name',true);
//     foreach ($tagArr as $v){
//         if (in_array($v, $allTag)){
//             $aidStr = $Tag->where(array('name' => $v))->getField('aid');
//             $aidArr = explode(',', $aidStr);
//             if (!(in_array($aid, $aidArr))){
//                 $Tag->where(array('name' => $v))->setField('aid', $aidStr . $aid . ',');
//             }
//         }else{
//             $Tag->add(array('name' => $v, 'aid' =>  $aid . ','));
//         }
//     }
// }

/**
 * 获取所有分类
 * @return mixed
 */
function getAllCategory(){
    $category = M('Category')->select();
    return  $category;
}

/**
 * 获取所有标签
 * @return mixed
 */
function getAllTag(){
    $allTag = M('Tag')->field('id,name')->select();
    return $allTag;
}

/**
 * 删除文章附件
 * @param $aid 文章ID
 */
function deleteFile($aid){
    $File = M('File');
    $filePath = $File->where(array('article_id' => $aid))->getField('save_path',true);
    $File->where(array('article_id' => $aid))->delete();
    foreach ($filePath as $v) {
        @unlink($v);
    }
}

/**
 * 验证码检查
 */
function check_verify($code, $id = ""){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}