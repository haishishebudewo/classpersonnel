window.onload = function () {
    // 登录js
    function my$(a) {
        return document.getElementById(a);
    }
    // 登录点击
    my$("link").onclick = function () {
        my$("login").style.display = "block";
        my$("bg").style.display = "block";
        console.log("哈哈");
    };
    // 关闭按钮点击
    my$("closeBtn").onclick = function () {
        my$("login").style.display = "none";
        my$("bg").style.display = "none";
    };
    // 拖拽
    my$("title").onmousedown = function (e) {
        let spageX = e.clientX - my$("login").offsetLeft;
        let spageY = e.clientY - my$("login").offsetTop;
        document.onmousemove = function (e) {
            let x = e.clientX - spageX;
            let y = e.clientY - spageY;
            my$("login").style.left = x + "px";
            my$("login").style.top = y + "px";
        }
    };
    // 松开事件
    my$("title").onmouseup = function () {
        document.onmousemove = null;
    }
};