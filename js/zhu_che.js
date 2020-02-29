var zhuCheErr = function () {
    var xHZZ = /^\d{10}$/;//学号正则
    var pWZZ = /^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/;//密码正则
    // 判断是否输入学号
    if ($("#xueHaos").val() === "") {
        alert("请输入您的学号");
        return;
    }
    // 判断学号格式
    if(!xHZZ.test($("#xueHaos").val())){
        alert("您的学号格式不正确");
        return;
    }
    // 判断是否输入密码
    if($("#userPass1").val() === ""){
        alert("请输入您的密码");
        return;
    }
    // 判断密码格式
    // if(!pWZZ.test($("#userPass1").val())){
    //     alert("密码只能输入5-20个以字母开头、可带数字、“_”、“.”的字串");
    //     return;
    // }
    if($("#userPass2").val() === ""){
        alert("请确认您的密码");
        return;
    }
    if($("#userPass1").val() != $("#userPass2").val()){
        alert("两次密码不一致");
        return;
    }
    $("main").show();
    //获取已输入的学号
    $("#xueHao").val($("#xueHaos").val());
}