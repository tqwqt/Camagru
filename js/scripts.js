function showFullImg(id) {
    var photo_div = document.getElementById(id);
    var par = photo_div.parentNode;
    var c = par.clientHeight;

    if (c === 500) {
        var pho = photo_div.firstElementChild;
        if (pho.clientHeight > 500) {
            par.style.height = "100%";
        }
    }
    else if (c !== 500) {
        par.style.height = "500px";
    }

}

function checkImgStatus(id) {
    var photoshow = getCookie("photoshow" + id);
    alert("check");
    // var photo_div = document.getElementById(id);
    if (photoshow !== "") {
        setCookie("photoshow" + id, "", 1);
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function setMyCookie(cname, cvalue) {

    document.cookie = cname + "=" + cvalue + ";";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


//--------------------------------CAMERA PAGE JS----------------------------//

function makePhoto(id) {

    var video = document.getElementById('video');
    var canva = document.getElementById('canvas');
    var context = canva.getContext('2d');

    canva.parentNode.style.display = 'block';
    canva.width = video.clientWidth;
    canva.height = video.clientHeight;
    context.drawImage(video, 0, 0);

    var stick = new Image();
    var elem =  document.getElementById('mblock');
    //elem.style.overflow = 'hidden';
    //console.log(elem);
    if (elem){
        var style = elem.currentStyle || window.getComputedStyle(elem, false);
        var newW, newH;
       // console.log(style);
        stick.src = style.backgroundImage.slice(4, -1).replace(/"/g, "");
        console.log('s.w, s.h, stick.w, stick.h:', style.width, style.height, stick.width, stick.height);
        if ((parseInt(style.width) < parseInt(style.height)))
        {
            newW = parseInt(style.width);
            newH = newW * stick.height / stick.width;
        }
        else {
            newH = parseInt(style.height);
            newW = stick.width * newH / stick.height;
        }
      //  console.log("curent w:", stick.width);
       // console.log("current h:", stick.height);
       // var res = parseInt(stick.height) / parseInt(stick.width);

       // console.log(res);
        // stick.width = 10;
        // stick.height = 10;
        console.log(stick.width, stick.height);
        console.log(stick.style.width, stick.style.height);
        // stick.src = elem.style.backgroundImage.src;
        console.log('w, h:', newW, newH);
        context.drawImage(stick, 0, 0, newW, newH);

    }

    var sbBtn = document.getElementById('savePhoto');
    sbBtn.style.display = 'block';
}

function showCamera() {

    //alert(window.innerHeight + ', '+ window.innerWidth);
    console.log('showCamera');
    var btnMakePhoto = document.getElementById('makePhoto');

    btnMakePhoto.style.display = 'block';
    console.log(btnMakePhoto.style.display);
    var vidBlock  = document.getElementById('videoDiv');
    //block.style.display = 'none';
    var vid = document.getElementById('video');
    var w = parseInt(window.innerWidth / 2 );
    var h = parseInt(window.innerHeight / 2);
    console.log(h+', '+w);
    vid.style.width = 'auto';
    /// 320x320 || w h
    navigator.getUserMedia(
        // Настройки
        {
            video: {width: w, height: h}
        },
        // Колбэк для успешной операции
        function(stream){

            // Создаём объект для видео потока и
            // запускаем его в HTLM элементе video.
            try {
                video.srcObject = stream;
            }catch(error)
            {
                video.src = URL.createObjectURL(stream);
            }

            // Воспроизводим видео.
            video.play();

        },
        // Колбэк для не успешной операции
        function(err){

            // Наиболее частые ошибки — PermissionDenied и DevicesNotFound.
            console.error(err);

        }
    );
    console.log(window.innerWidth);
    if (parseInt(window.innerWidth) > 500)
        vidBlock.style.width = vid.style.width;

}


//---------------------------------TOOL CHOSE------------------//

function chooseTool(id) {

    var elem = document.getElementById(id);
    var par = document.getElementById('videoDiv');
    var newEl = document.createElement('div');
   // newEl.src = elem.src;
  //  newEl.style.width = '5vh';

  //  newEl.style.position = 'absolute';
    newEl.id = 'mblock';
    newEl.setAttribute('style', 'background-image: url(\"../resources/tool-pony.png\")');
    var resz = document.createElement('div');
    resz.id = 'mblock_resize';
    newEl.appendChild(resz);
    // newEl.removeEventListener('click', this);
    //newEl.removeEventListener('onclick', chooseTool(id));
    par.appendChild(newEl);
   // newEl.addEventListener('click', resz(newEl));
    //resz(newEl);
    setResize();
}

// function resz(el) {
//
//     var p = el; // element to make resizable
//     p.addEventListener('click', function init() {
//         p.removeEventListener('click', init, false);
//         p.className = p.className + ' resizable';
//         var resizer = document.createElement('div');
//         resizer.className = 'resizer';
//         p.appendChild(resizer);
//         resizer.addEventListener('mousedown', initDrag, false);
//     }, false);
//
//     var startX, startY, startWidth, startHeight;
//
//     function initDrag(e) {
//         startX = e.clientX;
//         startY = e.clientY;
//         startWidth = parseInt(document.defaultView.getComputedStyle(p).width, 10);
//         startHeight = parseInt(document.defaultView.getComputedStyle(p).height, 10);
//         document.documentElement.addEventListener('mousemove', doDrag, false);
//         document.documentElement.addEventListener('mouseup', stopDrag, false);
//     }
//
//     function doDrag(e) {
//         p.style.width = (startWidth + e.clientX - startX) + 'px';
//         p.style.height = (startHeight + e.clientY - startY) + 'px';
//     }
//
//     function stopDrag(e) {
//         document.documentElement.removeEventListener('mousemove', doDrag, false);
//         document.documentElement.removeEventListener('mouseup', stopDrag, false);
//     }
//}


//------------------------------------------RESIZE---------------------------------------//
function setResize() {
    var ie = 0;
    var op = 0;
    var ff = 0;
    var block; // Основной блок
    var block_r; // Блок для изменения размеров
    var delta_w = 0; // Изменение по ширине
    var delta_h = 0; // Изменение по высоте
    /* После загрузки страницы */
  //  onload = function () {
        /* Определяем браузер */
        var browser = navigator.userAgent;
        if (browser.indexOf("Opera") != -1) op = 1;
        else {
            if (browser.indexOf("MSIE") != -1) ie = 1;
            else {
                if (browser.indexOf("Firefox") != -1) ff = 1;
            }
        }
        block = document.getElementById("mblock"); // Получаем основной блок
        block_r = document.getElementById("mblock_resize"); // Получаем блок для изменения размеров
        document.onmouseup = clearXY; // Ставим обработку на отпускание кнопки мыши
        block_r.onmousedown = saveWH; // Ставим обработку на нажатие кнопки мыши
  //  };

    /* Функция для получения текущих координат курсора мыши */

    function getXY(obj_event) {
        if (obj_event) {
            x = obj_event.pageX;
            y = obj_event.pageY;
        }
        else {
            x = window.event.clientX;
            y = window.event.clientY;
            if (ie) {
                y -= 2;
                x -= 2;
            }
        }
        return new Array(x, y);
    }

    function saveWH(obj_event) {
        var point = getXY(obj_event);
        w_block = block.clientWidth; // Текущая ширина блока
        h_block = block.clientHeight; // Текущая высота блока
        delta_w = w_block - point[0]; // Измеряем текущую разницу между шириной и x-координатой мыши
        delta_h = h_block - point[1]; // Измеряем текущую разницу между высотой и y-координатой мыши
        /* Ставим обработку движения мыши для разных браузеров */
        document.onmousemove = resizeBlock;
        if (op || ff) document.addEventListener("onmousemove", resizeBlock, false);
        return false; // Отключаем стандартную обработку нажатия мыши
    }

    /* Функция для измерения ширины окна */
    function clientWidth() {
        return document.documentElement.clientWidth == 0 ? document.body.clientWidth : document.documentElement.clientWidth;
    }

    /* Функция для измерения высоты окна */
    function clientHeight() {
        return document.documentElement.clientHeight == 0 ? document.body.clientHeight : document.documentElement.clientHeight;
    }

    /* При отпускании кнопки мыши отключаем обработку движения курсора мыши */
    function clearXY() {
        document.onmousemove = null;
    }

    function resizeBlock(obj_event) {
        //console.log(obj_event);
        var point = getXY(obj_event);
        new_w = delta_w + point[0]; // Изменяем новое приращение по ширине
        new_h = delta_h + point[1]; // Изменяем новое приращение по высоте
        block.style.width = new_w + "px"; // Устанавливаем новую ширину блока
        block.style.height = new_h + "px"; // Устанавливаем новую высоту блока
        /* Если блок выходит за пределы экрана, то устанавливаем максимальные значения для ширины и высоты */
        if (block.offsetLeft + block.clientWidth > clientWidth()) block.style.width = (clientWidth() - block.offsetLeft) + "px";
        if (block.offsetTop + block.clientHeight > clientHeight()) block.style.height = (clientHeight() - block.offsetTop) + "px";
    }
}

//--------------------------------SAVE PHOTO----------------------------------//

function savePhoto(id) {

    var canv = document.getElementById('canvas');
    ajaxPost('http://localhost:8101/photoStudio/savePhoto',function (data) {

        if (data.toString().localeCompare('OK') === 0)
        {

            var par = target.parentNode;
            par.remove(target);
            console.log("saved");
        }
        else
        {
            console.log('data='+data+';');
        }
    }, {img : canv.toDataURL('image/png')});
    //console.log(canv.toDataURL('image/png'));
}