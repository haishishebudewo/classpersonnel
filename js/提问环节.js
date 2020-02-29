//获取点击按钮对象
var btnObj = my$("btn_end_start");
//获取div背景图盒子的对象
var divImgObj = my$("div_btn_img");
//定时器变量
var timing;
//改变当前backgroundPosition值
var position_x_y = 0;
//设置班级人数
var number = 47;
//当前图片传递
var current_classmate = my$("current_classmate");
//数组
var arr = [];
//存储每次创建的变量
var current_classmate_css;
// 获取对应id对象的函数
function my$(a) {
    return document.getElementById(a);
}

// 获取对应id对象的函数
function my$(a) {
    return document.getElementById(a);
}

//添加定时器，改变图片,点击开始
function setImgUrl() {
    current_classmate.style.display = "none";
    timing = setInterval(function () {
        ++position_x_y;
        if (position_x_y < number) {
            divImgObj.style.backgroundPosition = 3 + "vw" + "\ " + (-14 * position_x_y) + "vw";
        }
        else {
            position_x_y = 0;
        }
    }, 1);
    return btnObj.value = "点击结束";
}

//点击结束
function getEndBtn() {
    current_classmate.style.display = "block";
    arr.forEach(function (e) {
        if (e == position_x_y) {
            alert("数字相同，请重新抽取：");
            btnObj.value = "点击结束";
            var pop = arr.pop();
            //删除相等的值，并且删除添加的盒子
            if(pop == position_x_y){
                my$("current_classmate").removeChild(getLastElementChild(my$("current_classmate")));
            }else {
                my$("current_classmate").removeChild(getLastElementChild(my$("current_classmate")));
            }
        } else {
            btnObj.value = "点击开始";
        }
    });
}

//设置按钮值
function clickBtnText() {
    if (btnObj.value == "点击开始") {
        setImgUrl();
        current_classmate.style.display = "block";
    } else {
        current_classmate.style.display = "block";
        current_classmate_css = document.createElement("div");
        current_classmate.appendChild(current_classmate_css);
        current_classmate_css.className = "current_classmate_css";
        current_classmate_css.style.backgroundPosition = 0 + "vw" + "\ " + (-8 * position_x_y) + "vw";
        getEndBtn();
        current_classmate_css.id = "current_classmate_css_id" + position_x_y;
        arr.push(position_x_y);
        clearInterval(timing);
        btnObj.value = "点击开始";
    }
}

//设置状态值
getAddEventListener(my$("btn_end_start"), "click", clickBtnText);

//添加重置事件
function setBtnReset() {
    window.location.reload();
}

//添加重置按钮事件
getAddEventListener(my$("btn_reset"), "click", setBtnReset);
//随机按钮点击事件
// function getRandomRollCall(){
//     window.history.forward();
// }
//添加随机按钮事件
// getAddEventListener(my$("random_roll_call"),"click",getRandomRollCall());