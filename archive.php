<!DOCTYPE html>
<html lang="de">
<head>
    <?php
        include_once "resources/php/util.php";
        include_once "resources/php/form-util.php";
        include_once "resources/php/image-gallery.php";

        common_head();
    ?>
    <title>Spielmannszug Frammersbach</title>
</head>
<body onload='requestCookie()'>
<?php
    cookie_request();
    settings_menu();
    home_menu("HOME");
?>
<div id="content">
    <h1>Archiv</h1>
    <?php
        $entries      = array();
        $all_articles = load_json("aggregated.json");
        $len          = count($all_articles);

        $all_articles = array_reverse($all_articles);
        echo "<table class='archive'><thead><td>Datum</td><td>Titel</td></thead>";
        foreach ($all_articles as $article) {
            $name = $article->name;
            $post = new post($article);

            echo "<tr><td>" . date_format($post->date, "d.m.Y") . "</td><td><a href='" . absolute_resource("post.php?post=$name") . "'>" . $post->title .
                 "</a></td></tr>";
        }
        echo "</table>";
    ?>
</div>
</body>
</html>