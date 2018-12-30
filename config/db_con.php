<?php
require_once('database.php');

$localhost = $databases['test']['localhost'];
$user      = $databases['test']['user'];
$password  = $databases['test']['password'];
$db        = $databases['test']['db'];

$con = mysqli_connect($localhost, $user, $password, $db);
// 检查连接
if (!$con) {
    die("连接错误: " . mysqli_connect_error());
}