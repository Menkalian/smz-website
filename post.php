<!DOCTYPE html>
<html lang="de">
<head>
    <?php
        include_once "resources/php/util.php";
        include_once "resources/php/form-util.php";
        include_once "resources/php/image-gallery.php";

        common_head();
        gallery_headers();
    ?>
    <title>Spielmannszug Frammersbach - Bilder</title>
</head>
<body onload='requestCookie();showSlide(0)'>
<?php
    cookie_request();
    home_menu();
?>
<div id="content">
    <?php
        # Load JSON for the requested post
        $postname = $_GET["post"];
        if (!isset($_GET["post"]) || preg_match("[a-zA-Z\\-_\\/]+", $postname) == false) {
            echo "<p class='error'>Dieser Inhalt konnte nicht gefunden werden. Versuchen Sie es doch einmal im <a href='archive.php'>Archiv</a> oder auf der <a href='index.php'>Startseite</a>.</p>";
            http_response_code(403);
            exit();
        }
    ?>
    <h1>Die Bildergalerie</h1>
    <?php
        create_gallery_container() ?>
</div>
</body>
</html>
