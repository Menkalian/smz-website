<!DOCTYPE html>
<html lang="de">
<head>
    <?php
        include_once "resources/php/util.php";
        include_once "resources/php/image-gallery.php";
        include_once "resources/php/form-util.php";

        common_head();
        gallery_headers();
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
    <h1>Neuigkeiten von uns</h1>
    <?php
        $entries      = array();
        $all_articles = load_json("aggregated.json");
        $len          = count($all_articles);

        for ($i = 1 ; $i <= 5 ; $i++) {
            $article = $all_articles[ $len - $i ];
            if ($article == null) {
                break;
            }

            $entries[] = new gallery_entry($article->title, $article->thumbnail, absolute_resource("post.php?post=" . $article->name));
        }

        create_gallery_container($entries);
    ?>

    <h1>Weitere Inhalte auf der Website</h1>
    <div class="legal-text">
        <p>
            Die bisherigen Neuigkeiten/Posts können im <a href="archive.php">Archiv</a> angesehen werden.<br>
        </p>
        <p>
            Unsere Vereinsgeschichte wird <a href="post.php?post=history">hier</a> erzählt.<br>
        </p>
        <p>
            Aufgrund von Corona gab es leider keine Terminliste für das Jahr 2021.<br>
            Sobald es eine Terminliste für das Jahr 2022 gibt, wird diese hier verlinkt.
        </p>
    </div>

    <h1>Wir sind auch auf Facebook</h1>
    <div class="facebook-container"
         x-embed='<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FSpielmannszugFrammersbach&tabs=timeline&width=500&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>'>
        <p>Wir sind auch <a href="https://www.facebook.com/SpielmannszugFrammersbach"> auf Facebook</a>.
           Hier wird eine Vorschau unserer Seite angezeigt, falls Facebook Cookies akzeptiert wurden.</p>
    </div>
</div>
</body>
</html>