<!DOCTYPE html>
<html lang="de">
<head>
    <?php
        include_once "resources/php/util.php";
        include_once "resources/php/form-util.php";
        include_once "resources/php/image-gallery.php";

        commonHead();
        galleryHeaders();
    ?>
    <title>Spielmannszug Frammersbach - Bilder</title>
</head>
<body onload='requestCookie();showSlide(0)'>
<?php
    cookieRequest();
    homeMenu();
?>
<div id="content">
    <h1>Die Bildergallerie</h1>
    <?php
        createGalleryContainer() ?>
</div>
</body>
</html>
