

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

    var elem =  document.getElementById('mblock');
    var video = document.getElementById('video');
    var f = false;
    if (video === undefined || video.style.display.localeCompare("none") === 0)
    {
        video = document.getElementById('downloaded');
        f = true;
        var w = video.width;
        var h = video.height;
    }

    if (elem){
        var x = parseInt(elem.offsetLeft) - parseInt(video.offsetLeft);
        var y = parseInt(elem.offsetTop) - parseInt(video.offsetTop);
    }


    var canva = document.getElementById('canvas');
    var context = canva.getContext('2d');
    var stick = new Image();


    canva.parentNode.style.display = 'block';
    canva.width = video.clientWidth;
    canva.height = video.clientHeight;
    if (f)
        context.drawImage(video, 0, 0, w, h);
    else
        context.drawImage(video, 0, 0);

    if (elem){
        var style = elem.currentStyle || window.getComputedStyle(elem, false);
        var newW, newH;
       // (style);
        stick.src = style.backgroundImage.slice(4, -1).replace(/"/g, "");
        ('s.w, s.h, stick.w, stick.h:', style.width, style.height, stick.width, stick.height);
        if ((parseInt(style.width) < parseInt(style.height)))
        {
            newW = parseInt(style.width);
            newH = newW * stick.height / stick.width;
        }
        else {
            newH = parseInt(style.height);
            newW = stick.width * newH / stick.height;
        }
        (stick.width, stick.height);
        (stick.style.width, stick.style.height);
        // stick.src = elem.style.backgroundImage.src;
        // ('posw, posh:', elem.offsetLeft, elem.offsetTop, elem.parentNode, video.offsetLeft, video.offsetTop);
        context.drawImage(stick, x, y, newW, newH);
    }

    var sbBtn = document.getElementById('savePhoto');
    sbBtn.style.display = 'block';
}




//---------------------------------TOOL CHOSE------------------//

function chooseTool(id) {

    var elem = document.getElementById(id);
    var par = document.getElementById('videoParent');
    var child = document.getElementById('mblock');
    (child);
    if (child !== undefined && child !== null) {
        child.parentNode.removeChild(child);
    }
        var newEl = document.createElement('div');
        // newEl.src = elem.src;
        //  newEl.style.width = '5vh';

        //  newEl.style.position = 'absolute';
        newEl.id = 'mblock';
        var way = elem.src.split('/');
        newEl.setAttribute('style', 'background-image: url(\"../resources/' + way[way.length - 1] + '\")');
        var resz = document.createElement('div');
        resz.id = 'mblock_resize';
        newEl.appendChild(resz);
        // newEl.removeEventListener('click', this);
        //newEl.removeEventListener('onclick', chooseTool(id));
        par.appendChild(newEl);
        ('cordTop, cordLeft', newEl.offsetTop, newEl.offsetLeft, par.offsetTop, par.offsetLeft);
        // newEl.addEventListener('click', resz(newEl));
        //resz(newEl);
        newEl.addEventListener('click', drugNdrop);
        setResize();
}


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
        //(obj_event);
        var point = getXY(obj_event);
        new_w = delta_w + point[0]; // Изменяем новое приращение по ширине
        new_h = delta_h + point[1]; // Изменяем новое приращение по высоте
        block.style.width = new_w + "px"; // Устанавливаем новую ширину блока
        block.style.height = new_h + "px"; // Устанавливаем новую высоту блока
        ("300 resezi, top left", block.offsetTop, block.offsetLeft);
        /* Если блок выходит за пределы экрана, то устанавливаем максимальные значения для ширины и высоты */
        if (block.offsetLeft + block.clientWidth > clientWidth()) block.style.width = (clientWidth() - block.offsetLeft) + "px";
        if (block.offsetTop + block.clientHeight > clientHeight()) block.style.height = (clientHeight() - block.offsetTop) + "px";
    }
}
//--------------------------------DRUG N DROP---------------------------------//
function drugNdrop() {

    var ball = document.getElementById('mblock');

    ball.onmousedown = function(e) {

        var coords = getCoords(ball);
        var shiftX = e.pageX - coords.left;
        var shiftY = e.pageY - coords.top;

       // ball.style.position = 'absolute';
        var vidDiv = document.getElementById('videoParent');
        vidDiv.appendChild(ball);
        moveAt(e);

        ball.style.zIndex = 1000; // над другими элементами

        function moveAt(e) {
            ball.style.left = e.pageX - shiftX + 'px';
            ball.style.top = e.pageY - shiftY + 'px';
            (ball.offsetLeft, ball.offsetTop);
        }

        document.onmousemove = function(e) {
            moveAt(e);
        };

        ball.onmouseup = function() {
            document.onmousemove = null;
            ball.onmouseup = null;
        };

    };

    ball.ondragstart = function() {
        return false;
    };

    function getCoords(elem) {   // кроме IE8-
        var box = elem.getBoundingClientRect();
        return {
            top: box.top + pageYOffset,
            left: box.left + pageXOffset
        };
    }

}

//--------------------------------SAVE PHOTO----------------------------------//

function savePhoto(id) {

    var canv = document.getElementById('canvas');
    ajaxPost('http://localhost:8101/photoStudio/savePhoto',function (data) {

        if (data.toString().localeCompare('OK') === 0)
        {
            ("saved");
        }
        else
        {
            ('data='+data+';');
        }
    }, {img : canv.toDataURL('image/png')});
    //(canv.toDataURL('image/png'));
}

//------------------------------UPLOAD FILE-----------------------------------//
function uploadFile() {

    var inpButton = document.getElementById('uploadFile');
    var file    = inpButton.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {

        var vidPar =  document.getElementById('videoParent');
        if (vidPar.getElementsByTagName('img')[0] === undefined) {
            var vid = document.getElementById('video');
            vid.style.display = "none";
            var img = document.createElement('img');
            img.src = reader.result;
            img.style.width = '100%';
            img.style.height = '100%';
            img.id = "downloaded";
            vidPar.appendChild(img);
            var btnMakePhoto = document.getElementById('makePhoto');

            btnMakePhoto.style.display = 'block';
        }
    };
    if (file){
        reader.readAsDataURL(file);
    }

}
function showCamera() {


    //alert(window.innerHeight + ', '+ window.innerWidth);
    var btnMakePhoto = document.getElementById('makePhoto');
    btnMakePhoto.style.display = 'block';
    (btnMakePhoto.style.display);
    var vidBlock  = document.getElementById('videoDiv');
    var img = document.getElementById('videoParent').querySelector('img');
    if (img !== null)
        img.parentNode.removeChild(img);
    //block.style.display = 'none';
    var vid = document.getElementById('video');
    vid.style.display = 'block';
    var w = parseInt(window.innerWidth / 2 );
    var h = parseInt(window.innerHeight / 2);
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
    (window.innerWidth);
    if (parseInt(window.innerWidth) > 500)
        vidBlock.style.width = vid.style.width;

}
//--------------------------------CHECK MIME------------//

function checkMime() {
    var video = document.querySelector('video');
    var t = video.srcObject;
    if (t !== null)
    {
        t = t.getTracks()[0];
        t.stop();
    }

    // video.width = '100%';
    var inpButton = document.getElementById('uploadFile');
    var file    = inpButton.files[0];
    var reader = new FileReader();

    reader.onloadend = function (e) {
        var arr = (new Uint8Array(e.target.result)).subarray(0,4);
        var header = "";
        for(var i = 0; i < arr.length; i++) {
            header += arr[i].toString(16);
        }

        if (mimeType(header).localeCompare('unknown') === 0)
        {
            alert('Allowed files: jpeg, png');
            return false;
        }
        else
        {
            ('true');
            uploadFile();
        }
    };
    // (file);
    if (file){
        reader.readAsArrayBuffer(file);
    }
}

function mimeType(headerString) {
    var type;
    switch (headerString) {
        case "89504e47":
            type = "image/png";
            break;
        case "ffd8ffe0":
        case "ffd8ffe1":
        case "ffd8ffe2":
            type = "image/jpeg";
            break;
        default:
            type = "unknown";
            break;
    }
    return type;
}