<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>团队详情</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ul,
        ol {
            list-style: none;
        }

        #box {
            width: 1200px;
            position: relative;
            height: 600px;
            margin: 10px auto;
        }

        #box #div1 li {
            position: absolute;
            left: 0;
            top: 0;
        }

        #box #div1 li img {
            width: 100%;
            height: auto;
        }

        #box #btn1 {
            background-image: url("images/prev.png");
            width: 76px;
            height: 112px;
            display: block;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 11;
            opacity: 0;
        }

        #box #btn2 {
            background-image: url("images/next.png");
            width: 76px;
            height: 112px;
            display: block;
            position: absolute;
            z-index: 11;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
        }

        @keyframes colorMove {
            0% {
                color: yellow;
                top: 0%;
            }

            100% {
                color: green;
                top: 10%;
            }
        }
    </style>
</head>

<body>
    <div>
        <a href="index.php?id=<?php echo $_GET['id'];?>">返回</a>
    </div>

    <div id="box">
        <div id="div1">
            <ul>
                <li>
                    <a href="#"><img src="images/slidepic1.png" alt=""></a>
                    <span
                        style="background:indigo; display: block;padding: 10px 0;position: absolute;top: 0%;left: 50%;transform: translateX(-50%);animation: colorMove 0.4s infinite alternate">扎西华旦：角色：组员，项目职务：概要设计、UI设计</span>
                </li>
                <li>
                    <a href="#"><img src="images/slidepic2.png" alt=""></a>
                    <span
                        style="background:indigo; display: block;padding: 10px 0;position: absolute;top: 0%;left: 50%;transform: translateX(-50%);animation: colorMove 0.4s infinite alternate">宦宇：角色：组员，项目职务：文档需求设计</span>
                </li>
                <li>
                    <a href="#"><img src="images/slidepic3.png" alt=""></a>
                    <span
                        style="background:indigo; display: block;padding: 10px 0;position: absolute;top: 0%;left: 50%;transform: translateX(-50%);animation: colorMove 0.4s infinite alternate">玉珠拉毛：角色：组员，项目职务：系统测试</span>
                </li>
                <li>
                    <a href="#"><img src="images/slidepic4.png" alt=""></a>
                    <span
                        style="background:indigo; display: block;padding: 10px 0;position: absolute;top: 0%;left: 50%;transform: translateX(-50%);animation: colorMove 0.4s infinite alternate">吕俊松：角色：组长，项目职务：开发</span>
                </li>
                <li>
                    <a href="#"><img src="images/slidepic5.jpg" alt=""></a>
                    <spanjpg
                        style="background:indigo; display: block;padding: 10px 0;position: absolute;top: 0%;left: 50%;transform: translateX(-50%);animation: colorMove 0.4s infinite alternate">邓胁升：角色：组员，项目职务：系统测试</span>
                </li>
                <li>
                    <a href="#"><img src="images/slidepic6.jpg" alt=""></a>
                    <span
                        style="background:indigo; display: block;padding: 10px 0;position: absolute;top: 0%;left: 50%;transform: translateX(-50%);animation: colorMove 0.4s infinite alternate">赤列曲桑：角色：组员，项目职务：概要设计、UI设计</span>
                </li>
                <li>
                    <a href="#"><img src="images/slidepic7.jpg" alt=""></a>
                    <span
                        style="background:indigo; display: block;padding: 10px 0;position: absolute;top: 0%;left: 50%;transform: translateX(-50%);animation: colorMove 0.4s infinite alternate">江白旺久：角色：组员，项目职务：概要设计、UI设计</span>
                </li>
            </ul>
        </div>
        <div>
            <a href="javascript:void(0)" id="btn1"></a>
            <a href="javascript:void(0)" id="btn2"></a>
        </div>
    </div>
    <script>
        function my$(a) {
            return document.getElementById(a);
        }

        //得到计算后的任意一个属性
        function getStyle(Element, styles) {
            return window.getComputedStyle ? window.getComputedStyle(Element, null)[styles] : Element.currentStyle[styles];
        }

        let flag = true;
        function anmition(Element, json, fn) {
            clearInterval(Element.timing);
            Element.timing = setInterval(function () {
                let flag = true;
                for (let key in json) {
                    if (key === "zIndex") {
                        Element.style[key] = json[key];
                        console.log(json[key]);
                    } else if (key === "opacity") {
                        var styles = getStyle(Element, key) * 100;
                        var targent = json[key] * 100;
                        let current = (targent - styles) / 10;
                        current = current > 0 ? Math.ceil(current) : Math.floor(current);
                        styles += current;
                        Element.style[key] = styles / 100;
                    } else {
                        var styles = parseInt(getStyle(Element, key));
                        var targent = json[key];
                        let current = (targent - styles) / 10;
                        current = current > 0 ? Math.ceil(current) : Math.floor(current);
                        styles += current;
                        Element.style[key] = styles + "px";
                    }
                    if (targent !== styles) {
                        flag = false;
                    }
                }
                if (flag) {
                    clearInterval(Element.timing, function () {
                    });
                    if (fn) {
                        fn();
                    }
                }
            }, 10)
        }

        let style = [{ "width": 200, "opacity": 0.3, "left": 120, "top": 20, "zIndex": 1 },
        { "width": 400, "opacity": 0.6, "left": 0, "top": 40, "zIndex": 2 },
        { "width": 600, "opacity": 0.8, "left": 80, "top": 60, "zIndex": 3 },
        { "width": 800, "opacity": 1, "left": 200, "top": 100, "zIndex": 4 },
        { "width": 600, "opacity": 0.8, "left": 680, "top": 60, "zIndex": 3 },
        { "width": 400, "opacity": 0.6, "left": 760, "top": 40, "zIndex": 2 },
        { "width": 200, "opacity": 0.3, "left": 840, "top": 20, "zIndex": 1 },
        ]

    </script>
    <script>
        function f(a) {
            return document.getElementById(a);
        }

        function assign() {
            let liObj = my$("div1").getElementsByTagName("li");
            for (let i = 0; i < liObj.length; i++) {
                anmition(liObj[i], style[i], function () {
                    flag = true;
                });
            }
        }

        window.onload = function () {
            assign();
        };
        //设置按钮监听
        my$("btn1").onclick = function () {
            if (flag) {
                style.unshift(style.pop());
                assign();
                flag = false;
            }
        };
        my$("btn2").onclick = function () {
            if (flag) {
                style.push(style.shift());
                assign();
                flag = false;
            }
        };
        my$("box").onmouseover = function () {
            anmition(my$("btn1"), { "opacity": 1 });
            anmition(my$("btn2"), { "opacity": 1 });
        };
        my$("box").onmouseout = function () {
            anmition(my$("btn1"), { "opacity": 0 });
            anmition(my$("btn2"), { "opacity": 0 });
        };
    </script>
</body>

</html>