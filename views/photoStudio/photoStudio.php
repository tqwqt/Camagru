

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
        <div id="videoDiv" >
            <div id="videoBtnsBlock">
                <button id="uploadBtn" class="vidBtns">Upload</button>
                <button id="webCamBtn" class="vidBtns" onclick="showCamera()">Wec-cam</button>
            </div>
            <video id="video">
                Your browser does not support the video tag.
            </video>
            <div id="tools">
<!--                <div id="">-->
                    <img id="pony-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-pony.png">
<!--                    <div id ="tools-pony"></div>-->
<!--                </div>-->
            </div>
        </div>
        <div id="canvasDiv">
            <canvas id="canvas">

            </canvas>
        </div>
    </div>
    <button id="makePhoto" onclick="makePhoto(id)">Make photo!</button>
    <button id="savePhoto" onclick="savePhoto(id)">Save this photo!</button>
</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
<script src="../../js/like.js"></script>
<script src="../../js/scripts.js"></script>
<!--<script type="text/javascript">-->
<!--   -->
<!--</script>-->
</body>
</html>