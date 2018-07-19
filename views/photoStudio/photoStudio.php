

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../../css/ps.css">
    <link rel="stylesheet" href="../../css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php require ROOT.'/footNhead/header.php';?>
<div id="mainPsBlock"  >

    <div id="cameraBlock">
        <div id="videoDiv" onclick="showCamera()">
            <video id="video">
                Your browser does not support the video tag.
            </video>
            <div id="tools">
                <div id="mblock">
<!--                    <img id="pony-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-pony.png">-->
                    <div id ="mblock_resize"></div>
                </div>
            </div>
        </div>
        <div id="canvasDiv">
            <canvas id="canvas">

            </canvas>
        </div>
    </div>
    <button id="makePhoto" onclick="makePhoto(id)">Make photo!</button>
    <div id="block">
        <span>Блок</span>
        <br />
        <span>Текст</span>
        <div id="block_resize"></div>
    </div>

</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
<script src="../../js/like.js"></script>
<script src="../../js/scripts.js"></script>
<script type="text/javascript">
    var ie = 0;
    var op = 0;
    var ff = 0;
    var block; // Основной блок
    var block_r; // Блок для изменения размеров
    var delta_w = 0; // Изменение по ширине
    var delta_h = 0; // Изменение по высоте
    /* После загрузки страницы */
    onload = function () {
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
    };
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
        var point = getXY(obj_event);
        new_w = delta_w + point[0]; // Изменяем новое приращение по ширине
        new_h = delta_h + point[1]; // Изменяем новое приращение по высоте
        block.style.width = new_w + "px"; // Устанавливаем новую ширину блока
        block.style.height = new_h + "px"; // Устанавливаем новую высоту блока
        /* Если блок выходит за пределы экрана, то устанавливаем максимальные значения для ширины и высоты */
        if (block.offsetLeft + block.clientWidth > clientWidth()) block.style.width = (clientWidth() - block.offsetLeft)  + "px";
        if (block.offsetTop + block.clientHeight > clientHeight()) block.style.height = (clientHeight() - block.offsetTop) + "px";
    }
</script>
</body>
</html>