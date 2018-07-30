

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
                <button id="uploadBtn" class="vidBtns" onclick="document.getElementById('uploadFile').click();">
                    <input id="uploadFile" type="file" onchange="checkMime()">Upload</button>

                <button id="webCamBtn" class="vidBtns" onclick="showCamera()">Wec-cam</button>
            </div>
            <div id="videoParent">
                <video id="video">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div id="underVideoBlock">
                <div id="tools">
    <!--                <div id="">-->
                        <img id="pony-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-pony.png">
                        <img id="glasses-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-glasses.png">
                        <img id="vla-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-vlastelin.png">
                        <img id="hat-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-hat.png">
                        <img id="beard-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-beard2.png">
                        <img id="fish-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-fish.png">
                        <img id="pipe-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-pipe.png">
                        <img id="pika-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-pika.png">
                        <img id="ira-tool" class="tools-img" onclick="chooseTool(id)" src="../../resources/tool-ira.png">
    <!--                    <div id ="tools-pony"></div>-->
    <!--                </div>-->
                </div>
                <button id="makePhoto" class="btn" style="display: none" onclick="makePhoto(id)">Make photo!</button>
                <button id="savePhoto" class="btn" style="display: none" onclick="savePhoto(id)">Save this photo!</button>
            </div>
        </div>
        <div id="canvasDiv" style="display: none">
            <canvas id="canvas">

            </canvas>
        </div>
    </div>
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