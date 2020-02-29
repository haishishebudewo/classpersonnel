$(function () {
    // 参数1：点击的导航栏，参数2：显示的内容栏
    var delClass = function () {
        arguments[0].prevAll().removeClass("current").end().nextAll().removeClass("current");
        arguments[0].prevAll().find("i").removeClass("i_scale");
        arguments[0].nextAll().find("i").removeClass("i_scale");
        arguments[0].find("i").addClass("i_scale");
        arguments[0].addClass("current");
        $(".table_information").find("table").hide();
        if (arguments[1] === undefined) {
            return;
        }
        arguments[1].show();
    }
    // 学生信息管理头部
    var nav1 = $(".nav1");
    // 学生成绩管理头部
    var nav2 = $(".nav2");
    // 学生信息管理
    var run = $(".student_run");
    var runTable = $(".student_run_table");
    run.on("click", function () {
        delClass($(this), runTable);
        nav1.show();
        nav2.hide();
        $(".current_structure").find("span").text("学生信息管理");
        $(".information").show();
        $(".informations").show();
        $(".saySomething").hide();
        $(".releaseStatement").hide();
    });
    // 学生成绩查询
    var success = $(".student_success");
    var successTable = $(".student_success_table");
    success.on("click", function () {
        delClass($(this), successTable);
        nav1.hide();
        nav2.show();
        $(".current_structure").find("span").text("学生成绩管理");
        $(".information").show();
        $(".informations").show();
        $(".saySomething").hide();
        $(".releaseStatement").hide();
    });
    // 公告
    var notice = $(".notice");
    notice.on("click", function () {
        delClass(notice);
        nav1.hide();
        nav2.hide();
        $(".current_structure").find("span").text("公告");
        $(".information").hide();
        $(".informations").hide();
        $(".saySomething").show();
        $(".releaseStatement").hide();
    });
    // 发布公告
    var release_notice = $(".release_notice");
    release_notice.on("click", function () {
        delClass(release_notice);
        nav1.hide();
        $(".current_structure").find("span").text("发布公告");
        $(".information").hide();
        $(".informations").hide();
        $(".saySomething").hide();
        $(".releaseStatement").show();
    });
    // 显示上传的图片
    var photo = document.querySelector('.photo');
    var eleFile = document.querySelector('#file');
    eleFile.addEventListener('change', function () {
        var file = this.files[0];
        // 确认选择的文件是图片                
        if (file.type.indexOf("image") == 0) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                // 图片base64化
                var newUrl = this.result;
                photo.style.backgroundImage = 'url(' + newUrl + ')';
            };
        }
    });
});