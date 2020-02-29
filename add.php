<?php
    function add_data(){
      $id = $_GET["id"];
      // 头像文件获取
        $img = $_FILES["touXiang"];
        // 判断是否选则头像
        if(empty($img["name"])){
          $GLOBALS["error_message"] = "请选择您的头像";
          return;
        }
        // 判断类型是否错误
        if(strpos($img["type"],"image/") !== 0){
          $GLOBALS["error_message"] = "您的文件类型不正确";
          return;
        }
        // 判断是否存在报错
        if($img["error"] !== UPLOAD_ERR_OK){
            $GLOBALS["error_message"] = "您的文件存在问题";
            return;
        }
        // 用户id
        $accountNumber = uniqid();
        // 移动图片
        $touName = 'images/' . $accountNumber . strstr($img["name"],'.');
        if(!move_uploaded_file($img["tmp_name"],$touName)){
          $GLOBALS["error_message"] = "上传失败";
          return;
        }
        // 判断姓名是否为空
        if(empty($_POST["name"])){
          $GLOBALS["error_message"] = "请输入您的名字";
          return;
        }
        // 判断学号是否为空
        if(empty($_POST["xueHao"])){
          $GLOBALS["error_message"] = "请输入您的学号";
          return;
        }
        // 判断是否选中性别
        // 下拉框提交的value值
        if($_POST["gender"] === "-1"){
          $GLOBALS["error_message"] = "请选择您的性别";
          return;
        }
        // 判断是否输入电话
        if(empty($_POST["phone"])){          
          $GLOBALS["error_message"] = "请输入您的电话";
          return;
        } 
          // 判断是否输入成绩
          if(empty($_POST["score"])){          
            $GLOBALS["error_message"] = "请输入您的成绩";
            return;
          } 
        // 判断是否选则班级
        if($_POST["xiBie"] === ""){
          $GLOBALS["error_message"] = "请选择您的班级";
          return;
        }
        // 姓名
        $name = $_POST["name"];
        // 学号
        $xueHao = $_POST["xueHao"];
        // 性别
        $gender = $_POST["gender"];
        // 电话
        $phone = $_POST["phone"];
         // 成绩
        $score = $_POST["score"];
        // 班级
        $xiBie = $_POST["xiBie"];
        // 数据库连接
        $conn = mysqli_connect("localhost","root","123","student");
        // 判断连接
        if(!$conn){
          exit("<h1>数据库连接失败</h1>");
        }
        $query2 = mysqli_query($conn,"select xuehao from student_information where xuehao='{$xueHao}';");
        if(mysqli_fetch_assoc($query2)["xuehao"] == $xueHao){
          $GLOBALS["error_message"] = "该学号已注册";
          return; 
        }
        // 查询对象
        $query = mysqli_query($conn,"insert into student_information (id,name,xuehao,gender,phone,xibie,touxiang,accountNumber,score)  values (null,'{$name}','{$xueHao}','{$gender}','{$phone}','{$xiBie}','{$touName}','{$accountNumber}','{$score}');");
        // 判断查询
        if(!$query){
          exit("<h1>查询失败！</h1>");
        }
        // 判断受影响行数
        if($row = mysqli_affected_rows($conn) <= 0){
          exit("<h1>插入失败</h1>");
        }
        mysqli_close($conn);
        $id=$_GET['id'];
        header("Location:index.php?id=$id");
    }
    //限制请求方式
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      add_data();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加用户</title>
    <link rel="stylesheet" href="css/normalize.css"><!-- 去除浏览器默认样式 -->
    <link rel="stylesheet" href="css/base.css"><!-- 公共样式 -->
    <link rel="stylesheet" href="css/index.css"><!--首页样式-->
    <link rel="stylesheet" href="css/bootstrap.min.css"><!--bootstrap样式-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="js/jquery-1.12.1.js"></script><!-- jquery引入 -->
    <script src="js/bootstrap.min.js"></script><!--bootstrapjs引入-->
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">学生管理系统之添加学生信息</a>
</nav>
  <main class="container" style="margin-top:4%;">
    <!-- 解决乱码 multipart/form-data -->
    <form action="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $_GET["id"]?>" method="post" enctype="multipart/form-data">
    <?php if(isset($error_message)){
      echo $error_message;
    }
    ?>
      <div class="form-group">
        <label for="touXiang">头像</label>
        <input type="file" class="form-control" id="touXiang" name="touXiang" accept="image/*">
      </div>
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" id="name" name="name" pattern="^[\u4e00-\u9fa5]{2,6}$">
      </div>
      <div class="form-group">
        <label for="xueHao">学号</label>
        <input type="text" class="form-control" id="xueHao" name="xueHao" pattern="^\d{10}$">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" id="gender" name="gender">
          <option value="-1">请选择性别</option>
          <option value="1">男</option>
          <option value="0">女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="phone">电话</label>
        <input type="tel" class="form-control" id="phone" name="phone" pattern="^\d{11}$">
      </div>
      <div class="form-group">
        <label for="score">成绩</label>
        <input type="number" max="100" min="0" class="form-control" id="score" name="score" pattern="^(100|([1-9][0-9]{0,1}|[0-9])(?:\.5|))$">
      </div>
      <div class="form-group">
        <label for="xiBie">班级</label>
        <select class="form-control" id="xiBie" name="xiBie">
          <option value="">请选择班级</option>
          <option value="17移动应用开发二班">17移动应用开发二班</option>
        </select>
      </div>
      <button class="btn btn-primary">保存</button>
    </form>
  </main>
</body>
</html>