<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/提问环节.css">
    <title>提问环节</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<div>
    <div id="div_btn_img">
    </div>
    <div class="btn_end_start_xx">
        <a href="index.php?id=<?php echo $_GET["id"]?>"><button>结束提问</button></a>
        <input type="button" id="btn_end_start" value="点击开始">
        <input type="button" id="btn_reset" value="重置">
    </div>
    <div id="current_classmate">

    </div>
</div>
</body>
<script src="js/兼容代码.js"></script>
<script src="js/提问环节.js"></script>
</html>