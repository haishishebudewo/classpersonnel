<?php
    $id = @$_GET["id"];
    if(empty($id)){
        exit("<h1>你参数不正确</h1>");
    }
    // 数据连接
    $conn = mysqli_connect("localhost","root","123","student");
    // 判断连接
    if(!$conn){
        exit("<h1>数据库连接失败!</h1>");
    }
    //查询对象 
    $query = mysqli_query($conn,"select * from student_information");
    // 成绩查询
    $query1 = mysqli_query($conn,"select * from student_information");
    // 公告查询
    $query2 = mysqli_query($conn,"select * from student_information where gongGao != '';");
    // 查询用户头像
    $queryTou = mysqli_query($conn,"select touxiang from student_information where id = $id limit 1;");
    // 查询用户名称
    $queryName = mysqli_query($conn,"select name from student_information where id = $id limit 1;");
    // ID号 
    $queryAccountNumber = mysqli_query($conn,"select accountNumber from student_information where id = $id limit 1");
    // 查询所有男生
    $queryNan = mysqli_query($conn,"select * from student_information where gender = 0;");
    // 查询所有女生
    $queryNan = mysqli_query($conn,"select * from student_information where gender = 0;");
    // 判断是否查询成功
    if(!$query){
        exit("<h1>获取查询对象失败!</h1>");
    }
    function gongGao() {
        global $conn;
        global $id;
        // 保存图片
        $img = $_FILES["file"];
        $text = $_POST["address"];
        str_replace("\n","<br>",$text);
         // 判断公告是否为空
        if(empty($text)){
            $GLOBALS["error_message"] = "请输入公告内容";
            return;
        }
        // 用户id
        $accountNumber = uniqid();
        // 移动图片
        $photo = 'images/' . $accountNumber . strstr($img["name"],'.');
        if(!move_uploaded_file($img["tmp_name"],$photo)){
          $GLOBALS["error_message"] = "上传失败";
          return;
        }
        $query1 = mysqli_query($conn,"update student_information set gongGao = '".$text."',photo = '".$photo."' where id = $id;");
    }
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        gongGao();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/随机点名.css">
    <link rel="stylesheet" href="css/normalize.css"><!-- 去除浏览器默认样式 -->
    <link rel="stylesheet" href="css/base.css"><!-- 公共样式 -->
    <link rel="stylesheet" href="css/index.css"><!--首页样式-->
    <link rel="stylesheet" href="css/jquery-ui.min.css"><!-- jQuery的UI样式 -->
    <link rel="stylesheet" href="css/bootstrap.min.css"><!--bootstrap样式-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="js/jquery-1.12.1.js"></script><!-- jquery引入 -->
    <script src="js/bootstrap.min.js"></script><!--bootstrapjs引入-->
    <script src="js/jquery-ui.min.js"></script><!-- jQueryUI的js引用 -->
    <script src="js/index.js"></script><!-- 首页js -->
</head>
<body>
<!--顶部start-->
<header>
    <div class="heder_inner w clearfix">
        <!--logo-->
        <div class="logo w fl">
            <h1>
                <a href="javascript:void(0);">
                    学生管理系统
                </a>
            </h1>
        </div>
        <!--退出-->
        <div class="out fr" style="display:block;">
            <a href="javascript:void(0);">
                <img src="images/out.png" alt="">
                <a href="logo.php">
                    <span id="signInBtn">退出</span>
                </a>
                <a href="xiu_gai_code.php?id=<?php echo $_GET["id"]?>" style="color:blue;text-decoration:none;">修改密码</a>
            </a>
        </div>
    </div>
</header>
<!--顶部end-->
<!--主题 start-->
<main class="w main clearfix">
    <!--主题左边-->
    <div class="main_left fl">
        <!--主题左上-->
        <div class="main_left_top">
            <!--个人信息-->
            <div class="main_top_inner">
                <!--头像-->
                <div class="head" style="background:url(<?php $touBg =  mysqli_fetch_assoc($queryTou);  echo $touBg["touxiang"];?>) no-repeat center center;background-size:cover;"></div>
                <!--昵称-->
                <div class="nickname my_fz">
                    昵称:&nbsp;&nbsp;<i><?php $name =  mysqli_fetch_assoc($queryName);  echo $name["name"];?></i>
                </div>
                <!--ID-->
                <div class="ID my_fz">
                    ID:<i><?php $accountNumber = mysqli_fetch_assoc($queryAccountNumber); echo $accountNumber["accountNumber"];?></i>
                </div>
            </div>
        </div>
        <!--主题左下-->
        <div class="main_left_bottom my_fz">
            <!--学生管理-->
            <div class="student_run current student_base">
                <i></i>
                <span>学生信息管理</span>
                <i class="i2 i_scale"></i>
            </div>
            <!--学生成绩查询-->
            <div class="student_success student_base">
                <i></i>
                <span>学生成绩管理</span>
                <i class="i2"></i>
            </div>
            <!--点到-->
            <!-- <div class="student_arrive student_base">
                <i></i>
                <span>班级人员点到</span>
                <i class="i2"></i>
            </div> -->
            <!--抽答-->
            <!-- <div class="student_answer student_base">
                <i></i>
                <span>随机抽问环节</span>
                <i class="i2"></i>
            </div> -->
            <!--公告-->
            <div class="notice student_base">
                <i></i>
                <span>公告</span>
                <i class="i2"></i>
            </div>
            <!--发布公告-->
            <div class="release_notice student_base">
                <i></i>
                <span>发布公告</span>
                <i class="i2"></i>
            </div>
        </div>
    </div>
    <!--主题右边-->
    <div class="mian_right fl">
        <!--当前位置-->
        <div class="current_structure">
            当前位置：<span>学生信息管理</span>
        </div>
        <!--查询-->
        <div class="information clearfix">
            <!--查询类型-->
            <div class="query clearfix">
                <!--搜索框-->
                <div class="search_student fr">
                    <div class="search_input_query clearfix">
                        <input type="search" name="search" class="search fl" id="search">
                        <a class="fl" href="search.php?id=<?php echo $_GET["id"]?>">查询</a>
                    </div>
                </div>
               <div class="fr" style="margin-top: 5px;margin-right: 5px;">
                    <a class="btn btn-info" href="随机点名.php?id=<?php echo $_GET["id"]?>">班级人员点到</a>
                    <a class="btn btn-info" href="提问环节.php?id=<?php echo $_GET["id"]?>">提问环节</a>
               </div>
            </div>
        </div>
        <!--信息-->
        <div class="informations">
            <a href="add.php?id=<?php echo $_GET['id']?>" style="text-decoration:none;">新增信息</a>
        </div>
        <!--表格-->
        <!-- 学生管理信息 -->
        <div style="position: relative;">
            <img src="images/nav1.png" alt=""style="width: 98.3%;height: auto;position: absolute;left: 0%;top:0%;" class="nav1">
            <img src="images/nav2.png" alt=""style="width: 98.3%;height: auto;position: absolute;left: 0%;top:0%;display:none;" class="nav2">
            <div class="table_information">
                <table class="table table-hover student_run_table" style="text-align: center;overflow: auto;">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>姓名</th>
                            <th>学号</th>
                            <th>性别</th>
                            <th>电话</th>
                            <th>班级</th>
                            <th width="140">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($item = mysqli_fetch_assoc($query)):?>
                        <tr>
                            <th><?php echo $item['id']?></th>
                            <td><?php echo $item['name']?></td>
                            <td><?php echo $item['xuehao']?></td>
                            <td><?php echo $item['gender'] == 1 ? '♂' : '♀';?></td>
                            <td><?php echo $item['phone']?></td>
                            <td><?php echo $item['xibie']?></td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm"  href="edit.php?id=<?php echo $item["id"];?>&id1=<?php echo $_GET["id"];?>">编辑</a>
                                <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $item["id"];?>&id1=<?php echo $_GET["id"];?>">删除</a>
                            </td>
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                </table>
                <!-- 学生成绩查询 -->
                <table class="table table-hover student_success_table" style="text-align: center;display:none;">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>姓名</th>
                            <th>学号</th>
                            <th>性别</th>
                            <th>班级</th>
                            <th>成绩</th>
                            <th width="140">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($item = mysqli_fetch_assoc($query1)):?>
                        <tr>
                            <th><?php echo $item['id']?></th>
                            <td><?php echo $item['name']?></td>
                            <td><?php echo $item['xuehao']?></td>
                            <td><?php echo $item['gender'] == 1 ? '♂' : '♀';?></td>
                            <td><?php echo $item['xibie']?></td>
                            <td><?php echo $item['score']?></td>
                            <td class="text-center">
                            <a class="btn btn-info btn-sm"  href="edit2.php?id=<?php echo $item["id"];?>&id1=<?php echo $_GET["id"];?>">编辑</a>
                            <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $item["id"];?>&id1=<?php echo $_GET["id"];?>">删除</a>
                            </td>
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                </table>
                <!-- 公告 -->
                <?php while($item = mysqli_fetch_assoc($query2)):?>
                        <div class="saySomething">
                            <div class="gangGao">
                                <div class="gangGaoInner clearfix">
                                    <div class="gangGaoInnerInformation fl">
                                        <img src="<?php echo $item["touxiang"]?>" alt="">
                                        <p style="color:#000;"><?php echo $item["name"]?></p>
                                    </div>
                                    <div class="gangGaoInnerText fl">
                                        <div><?php echo $item["gongGao"]?></div>
                                        <div><img src="<?php echo $item["photo"]?>" alt="" style="width:100%;height:auto;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endwhile;?>
                <!-- 发布公告 -->
                <div class="releaseStatement">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo @$_GET["id"]?>" method="post" enctype="multipart/form-data">
                    <?php if(isset($error_message)){
                        echo $error_message;
                    }
                    ?>
                        <textarea placeholder="亲，千等万等，终于等到你……" autoHeight="true" name="address"></textarea>
                        <!-- 发布公告 -->
                        <div class="photo">
                            <input type="file" accept="image/*" id="file" value="" name="file" />
                        </div>
                        <button class="btn bg-warning">发布</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!--主题 end-->
<!-- 合作团队 -->
<div class="" style="padding:30px;background:#1E1E1E;color:#FFF9FF;margin-top:30px;text-align: center;">
<a href="tuanDui.php?id=<?php echo $_GET["id"]?>">制作团队</a>
</div>
</body>
<script src="js/兼容代码.js"></script>
<!-- <script src="js/随机点名.js"></script> -->
</html>
