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

$query = "select * from dishes";
$res   = mysqli_query($con, $query);

?>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-size: 14px;
        }

        .fm {
            width: 660px;
            margin: 120px auto;
        }

        .fm div {
            padding: 10px 5px;
        }

        .fm input {
            padding: 6px;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td>ID</td>
        <td>名称</td>
        <td>价格</td>
        <td>数量</td>
        <td>描述</td>
        <td>图片</td>
    </tr>
    <?php
    if (!empty($res)) {
        while ($dishe = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $dishe['id']; ?></td>
                <td><?php echo $dishe['name']; ?></td>
                <td><?php echo $dishe['price']; ?></td>
                <td><?php echo $dishe['amount']; ?></td>
                <td><?php echo $dishe['desc']; ?></td>
                <td><img src="<?php echo SYSTEM_FILE_PATH . '/images/' . $dishe['image']; ?>" alt="<?php echo $dishe['name'] ?>" width="100;"/></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
</body>
</html>
