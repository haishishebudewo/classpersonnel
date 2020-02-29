<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/随机点名.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>随机点名</title>
</head>
<body>
<div id="div_input_number" style="display:block;margin: 0 auto;width:11%;">
    <p style="font-size: 13px;cursor: pointer" title="01-10范围内">请输入点到人数：(1-47)</p><input type="text" id="input_btn_number" placeholder="请输入点到的人数:">
</div>
<div id="input_btn">
    <a href="index.php?id=<?php echo $_GET["id"]?>"><input type="button" id="img_btn" value="结束点到"></a>
    <input type="button" id="start" value="点击开始">
    <input type="button" id="end" value="点击结束">
    <input type="button" id="btns_reset" value="重置">
</div>
<ul id="ul1">
    <li><h3>学生姓名：</h3></li>
    <li><h3>学生性别：</h3></li>
    <li><h3>学生学号：</h3></li>
</ul>
<div id="left_right">
    <div id="left">
        <div id="classmate_name"></div>
    </div>
    <div id="right">
        <table border="1" cellpadding="0" cellspacing="0" id="table_number">
            <caption>17移动应开发二班点名记录表</caption>
            <thead>
            <tr>
                <th>时间</th>
                <th>姓名</th>
                <th>性别</th>
                <th>学号</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</body>
<script src="js/兼容代码.js"></script>
<script src="js/随机点名.js"></script>
</html>