<?php
    $id = $_GET["id"];
    if(empty($id)){
        exit("<h1>你参数不正确</h1>");
    }
    // 数据库连接
    $conn = mysqli_connect("localhost","root","123","student");
    // 判断连接
    if(!$conn){
        exit("<h1>数据库连接失败</h1>");
    }
    // 查询对象
    $deleQuery = mysqli_query($conn,'delete from student_information where id = ' . $id . ';');
    // 判断查询
    if(!$deleQuery){
        exit("<h1>查询失败！</h1>");
    }
    // 判断受影响行数
    if($row = mysqli_affected_rows($conn) <= 0){
        exit("<h1>插入失败</h1>");
    }
    mysqli_close($conn);
    $id = $_GET['id1'];
    header("Location:index.php?id=$id");
?>