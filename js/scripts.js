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

    canva.width = video.clientWidth;
    canva.height = video.clientHeight;
    context.drawImage(video, 0, 0);

        //
        // var hidden_canvas = document.querySelector('canvas'),
        //     video = document.querySelector('video.camera_stream'),
        //     image = document.querySelector('img.photo'),
        //
        //     // Получаем размер видео элемента.
        //     width = video.videoWidth,
        //     height = video.videoHeight,
        //
        //     // Объект для работы с canvas.
        //     context = hidden_canvas.getContext('2d');
        //
        //
        // // Установка размеров canvas идентичных с video.
        // hidden_canvas.width = width;
        // hidden_canvas.height = height;
        //
        // // Отрисовка текущего кадра с video в canvas.
        // context.drawImage(video, 0, 0, width, height);
        //
        // // Преобразование кадра в изображение dataURL.
        // var imageDataURL = hidden_canvas.toDataURL('image/png');
        //
        // // Помещение изображения в элемент img.
        // image.setAttribute('src', imageDataURL);
}

function showCamera() {

    //alert(window.innerHeight + ', '+ window.innerWidth);
    console.log('showCamera');
   // var block  = document.getElementById('videoBlock');
    //block.style.display = 'none';
    var vid = document.getElementById('video');
    var w = parseInt(window.innerWidth / 2);
    var h = parseInt(window.innerHeight / 2);
    console.log(h+', '+w);
    vid.style.width = 'auto';
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
}


//---------------------------------TOOL CHOSE------------------//

function chooseTool(id) {

    var elem = document.getElementById(id);
    var par = document.getElementById('mainPsBlock');
    var newEl = document.createElement('img');
    newEl.src = elem.src;
    newEl.style.width = '5vh';

    newEl.style.position = 'absolute';
    newEl.id = 'reszPony-tool';
    // newEl.removeEventListener('click', this);
    //newEl.removeEventListener('onclick', chooseTool(id));
    par.appendChild(newEl);
    newEl.addEventListener('click', resz(newEl));
    resz(newEl);
}

function resz(el) {

    var p = el; // element to make resizable
    p.addEventListener('click', function init() {
        p.removeEventListener('click', init, false);
        p.className = p.className + ' resizable';
        var resizer = document.createElement('div');
        resizer.className = 'resizer';
        p.appendChild(resizer);
        resizer.addEventListener('mousedown', initDrag, false);
    }, false);

    var startX, startY, startWidth, startHeight;

    function initDrag(e) {
        startX = e.clientX;
        startY = e.clientY;
        startWidth = parseInt(document.defaultView.getComputedStyle(p).width, 10);
        startHeight = parseInt(document.defaultView.getComputedStyle(p).height, 10);
        document.documentElement.addEventListener('mousemove', doDrag, false);
        document.documentElement.addEventListener('mouseup', stopDrag, false);
    }

    function doDrag(e) {
        p.style.width = (startWidth + e.clientX - startX) + 'px';
        p.style.height = (startHeight + e.clientY - startY) + 'px';
    }

    function stopDrag(e) {
        document.documentElement.removeEventListener('mousemove', doDrag, false);
        document.documentElement.removeEventListener('mouseup', stopDrag, false);
    }
}