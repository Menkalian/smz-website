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
    settings_menu();
    home_menu();
?>
<div id="content">
    <?php
        # Load JSON for the requested post
        $postname = $_GET["post"];
        if (!isset($_GET["post"]) || preg_match("/[a-zA-Z0-9\\-_\\/]+/", $postname) == false) {
            echo "<p class='error'>Dieser Inhalt konnte nicht gefunden werden. Versuchen Sie es doch einmal im <a href='archive.php'>Archiv</a> oder auf der <a href='index.php'>Startseite</a>.</p>";
            http_response_code(403);
            exit();
        }

        if (!file_exists("resources/json/articles/" . $_GET["post"] . ".json")){
            echo "<p class='error'>Dieser Inhalt konnte nicht gefunden werden. Versuchen Sie es doch einmal im <a href='archive.php'>Archiv</a> oder auf der <a href='index.php'>Startseite</a>.</p>";
            http_response_code(400);
            exit();
        }

        $post_object = new post(load_json("articles/" . $_GET["post"] . ".json"));

    ?>
    <h1><?php
            echo $post_object->title; ?></h1>
    <?php
        $entries = array();

        $entries[] = new gallery_entry("", $post_object->thumbnail, "");
        foreach ($post_object->images as $image) {
            $entries[] = new gallery_entry($image->text, $image->img, "");
        }

        create_gallery_container($entries);

        echo "<p>" . $post_object->text . "</p>"
    ?>
</div>
</body>
</html>
