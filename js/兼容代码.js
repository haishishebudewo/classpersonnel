//innerText、textContent、innerHTML所有浏览器都支持，包括ie8
// 获取对于id的函数
function my$(a) {
    return document.getElementById(a);
}

function getElement(a) {
    return document.getElementsByTagName(a);
}

// 获取任意一个父级元素的第一个子级元素
function getFirstElementChild(element) {
    if (element.firstElementChild) {
        return element.firstElementChild;
    } else {
        var a = element.firstChild;
        while (a && a.nodeType != 1) {
            a = a.previousSibling;
        }
        return a;
    }
}

// 获取任意一个标签的最后一个子元素
function getLastElementChild(element) {
    if (element.lastElementChild) {
        return element.lastElementChild;
    } else {
        var a = element.lastChild;
        while (a && a.nodeType != 1) {
            a = a.nextSibling;
        }
        return a;
    }
}

//获取某元素的前一个兄弟元素
function getPreviousElementSibling(element) {
    if (element.previousElementSibling) {
        return element.previousElementSibling;
    } else {
        var a = element.previousSibling;
        while (a && a.nodeType != 1) {
            a = a.previousSibling;
        }
        return a;
    }
}

//获取元素的后一个兄弟元素
function getNextElementSibling(element) {
    if (element.nextElementSibling) {
        return element.nextElementSibling;
    } else {
        var a = element.nextSibling;
        while (a && a.nodeType != 1) {
            a = a.nextSibling;
        }
        return a;
    }
}


//绑定事件兼容代码
function getAddEventListener(element, event, functions) {
    if (element.addEventListener) {
        return element.addEventListener(event, functions, false);
    } else if (element.attachEvent) {
        return element.attachEvent("on" + event, functions);
    } else {
        return element["on"+event] = functions;
    }
}

//解除绑定事件
function getRemoveEventListener(element, event, functions) {
    if (element.removeEventListener) {
        return element.removeEventListener(event,functions);
    }else if(element.detachEvent){
        return element.detachEvent("on"+event,functions);
    }else {
        return element["on"+event] = null;
    }
}
