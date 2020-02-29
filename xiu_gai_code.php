<?php
 // 获取传递的id参数
    $id = $_GET["id"];
    if(empty($id)){
        exit("<h1>你参数不正确</h1>");
    }
    function xiuGaiCode(){
        // 将变量作为全局使用
        global $id;
        // 连接数据库
        $conn = mysqli_connect("localhost","root","123","student");
        // 判断数据库连接
        if(!$conn){
            exit("<h1>数据库连接失败</h1>");
        }
        // 查询对象
        $query = mysqli_query($conn,"select id,xuehao,user_passwd from student_information where id =". $id.";");
        if(!$query){
            exit("<h1>查询失败</h1>");
        }
        $data = mysqli_fetch_assoc($query);
        $xueHao = $data["xuehao"];
        $passWd = $data["user_passwd"];
        // 判断学号是否输入
        if(empty($_POST["xueHao"])){
            $GLOBALS["error_message"] = "请输入您的学号";
            return;
        }
        // 判断学号是否正确
        if($_POST["xueHao"] != $xueHao){
            echo $_POST["xueHao"];
            echo $xueHao;
            $GLOBALS["error_message"] = "您的学号不正确";
            return;    
        }
        
        // 判断旧密码是否输入
        if(empty($_POST["userPass1"])){
            $GLOBALS["error_message"] = "请输入您的原密码";
            return;
        }
         // 判断旧密码是否正确
         if($_POST["userPass1"] != $passWd){
            $GLOBALS["error_message"] = "您的原密码不正确";
            return;
        }
        // 判断旧密码是否输入
        if(empty($_POST["userPass2"])){
          $GLOBALS["error_message"] = "请输入您的新密码";
          return;
        }
        // 判断新旧是否一致
        if($_POST["userPass2"] === $_POST["userPass1"]){
            $GLOBALS["error_message"] = "新密码和旧密码不能一致";
            return;
        }
        $uPs = $_POST["userPass2"];
        // 更新密码查询对象
        $queryUpdateQuery = mysqli_query($conn,"update student_information set user_passwd = " . $uPs . " where id =" . $id . ";");
        if(mysqli_affected_rows($conn)<=0){
            exit("更新失败");
        }
        header("Location:logo.php");
    }
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        echo "1";
        xiuGaiCode();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改密码</title>
    <link rel="stylesheet" href="css/normalize.css"><!-- 去除浏览器默认样式 -->
    <link rel="stylesheet" href="css/base.css"><!-- 公共样式 -->
    <link rel="stylesheet" href="css/jquery-ui.min.css"><!-- jQuery的UI样式 -->
    <link rel="stylesheet" href="css/bootstrap.min.css"><!--bootstrap样式-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="js/jquery-1.12.1.js"></script><!-- jquery引入 -->
    <script src="js/bootstrap.min.js"></script><!--bootstrapjs引入-->
    <script src="js/jquery-ui.min.js"></script><!-- jQueryUI的js引用 -->
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">学生管理系统之修改密码</a>
</nav>
<form action="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $id?>" method="post" enctype="multipart/form-data"> 
    <div class="container" style="margin-top:4%;">
        <?php if(isset($error_message)){
              echo $error_message;
            }
        ?>
        <div class="form-group">
            <label for="xueHao">学号</label>
            <input type="text" class="form-control" id="xueHao" name="xueHao">
        </div>
        <div class="form-group">
            <label for="userPass1">原密码：</label>
            <input type="password" class="form-control" id="userPass1" name="userPass1">
        </div>
        <div class="form-group">
            <label for="userPass2">新密码</label>
            <!-- pattern="/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/" -->
            <input type="password" class="form-control" id="use rPass2" name="userPass2"  placeholder="新密码只能输入5-20个以字母开头、可带数字、“_”、“.”的字串">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="确认修改">
        </button>
    </div>
</form>
</body>
</html>