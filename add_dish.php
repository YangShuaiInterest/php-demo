<?php
//初始化文件编码
header("Content-Type: text/html;charset=utf-8");

//debug模式
define('DEBUG', true);
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

//系统文件基础路径
define('SYSTEM_FILE_PATH', './uploads');


require_once('./config/db_con.php');

mysqli_query($con, 'set names utf8');

$_time = time();

include_once('helpers.php');
if (isPost()) {
//3、系统全局变量有哪些？各有什么功能？
    $datas = $_POST;
    $files = $_FILES;

    //   数组：索引数组、关联数组
//    1、索引数组和关联数组的区别？如何取值？
//    2、如何循环取出数组的值（3种实现方式）
    /**
     * 1、索引数组
     * $arr = array(
     * 'a',
     * 'a',
     * 'a',
     * 'a',
     * )
     *
     *2、关联数组
     * $people = array(
     * 'name'=>'yjj',
     * 'age'=>18,
     * 'sex'=>'女',
     *
     * )
     */

    $name   = isset($datas['name']) ? $datas['name'] : '';
    $price  = isset($datas['price']) ? $datas['price'] : '';
    $amount = isset($datas['amount']) ? $datas['amount'] : '';
    $desc   = isset($datas['desc']) ? $datas['desc'] : '';
    $image  = isset($files['image']) ? $files['image'] : '';

    //名称
    if (empty($name)) {
        exit('名称必填');
    }

    //价格
    if (empty($price)) {
        exit('价格必填');
    }

    //数量
    if (empty($amount)) {
        exit('数量必填');
    }

    //描述
    if (empty($desc)) {
        exit('描述必填');
    }

    //图片
    if (empty($image)) {
        exit('图片必填');
    }
    //图片上传OK 处理上传
    $base_name = '';
    if ($image['error'] === UPLOAD_ERR_OK) {

        $ext       = getFileExt($image['name']);
        $base_name = md5(uniqid() . $_time) . '.' . $ext;
        $base_path = SYSTEM_FILE_PATH . '/images/';

        //如果上传基础路径不存在，则创建
        if (!file_exists($base_path)) {
            mkdir($base_path, 0777, true);
        }

        //移动临时文件到指定路径
        move_uploaded_file($image['tmp_name'], $base_path . $base_name);

        //删除临时文件
        @unlink($image['tmp_name']);
    } else {
        exit('图片上传错误');
    }

    $query = "insert into dishes(name, price, amount, `desc`, image, updated, created) values ('{$name}',{$price},{$amount},'{$desc}','{$base_name}',{$_time},{$_time})";
    mysqli_query($con, $query);

    if (mysqli_affected_rows($con) > 0) {
        header("Location: list_dish.php");
    } else {
        mysqli_close($con);
        exit('添加失败');
    }

} else {
    exit('非法提交');
}
