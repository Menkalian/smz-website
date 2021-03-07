<!DOCTYPE html>
<html lang="de">
<head>
    <?php
        include_once "resources/php/util.php";
        include_once "resources/php/form-util.php";

        commonHead();
    ?>
    <title>Spielmannszug Frammersbach</title>
</head>
<body onload='requestCookie()'>
<?php
    cookieRequest();
    homeMenu("HOME");
?>
<div id="content">
    <h1>Wir sind spielbereit! #restartblasmusik</h1>
    <img src="<?php
        echo absoluteResource("resources/images/content/countdown.jpg"); ?>"
         alt="Der Countdown läuft - wir sind spielbereit! #restartblasmusik Spielmannszug Frammersbach"
         class="fitimage" style="width: 80%">

    <h1>Wir sind auch auf Facebook</h1>
    <div class="facebook-container"
         x-embed='<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FSpielmannszugFrammersbach&tabs=timeline&width=500&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>'>
        <p>Wir sind auch <a href="https://www.facebook.com/SpielmannszugFrammersbach"> auf Facebook</a>. Hier ist eine Vorschau unserer Seite, wenn Facebooks
           Cookies akzeptiert sind.</p>
    </div>
</div>
</body>
</html>