<?php
//数量
$amounts = [5, 10, 15, 20, 25];
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
<!--1、form 表单POST和GET方式提交的区别？-->
<!--2、form表单有哪些类型？各个类型是干什么用的-->
<form action="add_dish.php" method="post" enctype="multipart/form-data" class="fm">
    <div><label>名称：</label><input type="text" name="name"/></div>
    <div><label>价格：</label><input type="number" name="price"/></div>
    <div>
        <label>数量：</label>
        <select name="amount">
            <option value="">请选择菜品数量</option>
            <?php
            foreach ($amounts as $amount) {
                ?>
                <option value="<?php echo $amount ?>"><?php echo $amount ?>份</option>
                <?php
            }
            ?>
        </select>
    </div>
    <div>
        <label>描述：</label>
        <textarea rows="4" name="desc" placeholder="请填写菜品描述"></textarea>
    </div>
    <div><label>图片：</label><input type="file" name="image"/></div>
    <input type="submit" value="提交"/>
</form>
</body>
</html>


