<?php 
    function logo(){
        // 数据连接
        $conn = mysqli_connect("localhost","root","123","student");
        // 判断连接
        if(!$conn){
            exit("<h1>数据库连接失败!</h1>");
        }
        // 用户信息
        $break = 0;
        $query = mysqli_query($conn,"select id,xuehao,user_passwd from student_information");
        $userName = $_POST["username"];
        $userPasswd = $_POST["password"];
        // 验证输入账号
        if(empty($userName)){
            $GLOBALS["error_message"] = "请输入您的账号";
            return;
        }
        // 验证输入密码
        if(empty($userPasswd)){
            $GLOBALS["error_message"] = "请输入您的密码";
            return;
        }
        $success = 0;
        // 匹配密码和账号
        while($item = mysqli_fetch_assoc($query)){
            if(($item["xuehao"] == $userName) && ($item["user_passwd"] == $userPasswd)){
                $success += 1;
                $GLOBALS["error_message"] = "";
                $id = $item["id"];
                header("Location:index.php?id=$id");
            }
        }
        if($success <= 0){
            $GLOBALS["error_message"] = "你的账号或密码错误";
            return;
        }
    }
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        logo();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录层</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/normalize.css"><!-- 去除浏览器默认样式 -->
    <link rel="stylesheet" href="css/base.css"><!-- 公共样式 -->
    <link rel="stylesheet" href="css/logo.css"><!-- 登录样式 -->
    <script src="js/jquery-1.12.1.js"></script><!-- jquery引入 -->
    <script src="js/logo.js"></script><!-- 首页js -->
</head>
<body>
    <div class="login-header"><a id="link" href="javascript:void(0);">点击，登录</a></div>
    <div class="register-header" style="color:black;text-align: center;">未注册？<a href="zhu_che.php"  style="color:blue;">立即注册</a></div>
    <!-- 登录层 -->
    <div id="login" class="login">
        <div id="title" class="login-title">登录
            <span><a id="closeBtn" href="javascript:void(0);" class="close-login" style="text-decoration:none;">关闭</a></span></div>
        <div class="login-input-content">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" name="Login">
                <div class="login-input">
                    <label for="username">账号：</label>
                    <input type="text" placeholder="请输入用户名" name="username" id="username" class="list-input">
                </div>
                <div class="login-input">
                    <label for="password">密码：</label>
                    <input type="password" placeholder="请输入登录密码" name="password" id="password" class="list-input">
                </div>
            </div>
            <div id="loginBtn" class="login-button"><a href="index.php?id<?php echo$id?>" id="login-button-submit" style="text-decoration:none;"><input type="submit" value="登录" id="sLogin"></a></div>
        </form>
    </div><!--登录框-->
    <div id="bg" class="login-bg"></div><!--遮挡层-->
    <?php if(isset($error_message)){
        echo "<h1 id='error_message' style=''>".$error_message."</h1>";
        }
    ?>
</body>
</html>