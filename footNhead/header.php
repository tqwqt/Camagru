<?php
?>
<header>
    <div id="headerid">

        <img id="img_icon" src="../resources/iconCama.png">
        <div id="ways">
            <?php
                if (isset($_SESSION['userId']))
                {
                    echo " <img class=\"icon\" src=\"../resources/settings.svg\" onclick=\"cabinet()\"> ".
            "<img class=\"icon\" src=\"../resources/camera-lens.svg\" onclick=\"toMakePhotoPage()\">";
                }?>
            <img class="icon" src="../resources/gallery.svg" onclick="gallery()">
            <img class="icon" src="../resources/iconLogout.svg" onclick="logOut()">
        </div>

    </div>
</header>