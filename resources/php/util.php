<?php

    /**
     *  Generates common elements for html-head element
     */
    function commonHead()
    {
        // Metadata
        echo "<meta charset=\"UTF-8\">\n";
        echo "<link rel='icon' href='" . absoluteResource("resources/images/base/logos/smz/icon.gif") . "'>\n";

        // preload images
        preload("resources/images/base/logos/fb/facebook_black.png", "image");
        preload("resources/images/base/logos/fb/facebook_white.png", "image");
        preload("resources/images/base/background.png", "image");
        preload("resources/images/base/settings_green.png", "image");
        preload("resources/images/base/settings_white.png", "image");

        // Script files
        includeJs("libs/cookies-eu-banner.js");
        includeJs("libs/js.cookie.js");
        includeJs("default.js");

        // CSS
        includeCss("constants.css");
        includeCss("main.css");
        includeCss("cookienotice.css");
    }

    function cookieRequest()
    {
        echo "<div id='cookies-eu-banner'>";
        echo "<p>Wir setzen auf dieser Seite Cookies ein, um die Nutzung angenehmer zu gestalten. Diese Auswahl kann jederzeit in den Einstellungen angepasst werden.</p>";
        echo "<a href='" . absoluteResource("legal/datenschutz/GeneralCookieInfo.php") .
             "' id='cookies-eu-more'>Weitere Infos zur Verwendung von Cookies</a><br>";

        // Create Sliders
        echo "<ul><li>";
        createSlider("cookies-eu-essential", "Notwendige Cookies", true, false);
        echo "</li><li>";
        createSlider("cookies-eu-convenience", "Cookies für eine verbesserte Nutzungserfahrung", true);
        echo "</li><li>";
        createSlider("cookies-eu-facebook", "(externe) Facebook Cookies", true);
        echo "</li></ul>";

        // Buttons
        echo "<button id='cookies-eu-accept'>Auswahl bestätigen</button>";

        echo "</div>";
    }

    function homeMenu($current = "NONE")
    {
        echo "<nav class='navbar'>\n";

        // Left halve
        echo "<div>
                <div><img src='" . absoluteResource("resources/images/base/logos/smz/smz_logo_freigestellt.png") . "' alt='Spielmannszug Frammersbach' style='flex-grow: 0.5' class='fitimage'></div>
                <div>
                    <a href='" . absoluteResource("index.php") . "' " . ($current == "HOME" ? "class='active'" : "") . ">Home</a>
                </div>
                <div>
                    <a 
                    href='https://de-de.facebook.com/SpielmannszugFrammersbach/' 
                    onmouseenter='colorswitch(\"menu-facebook\")' 
                    onmouseleave='colorswitch(\"menu-facebook\")' >
                        <img 
                        src='" . absoluteResource("resources/images/base/logos/fb/facebook_black.png") . "' 
                        x-other='" . absoluteResource("resources/images/base/logos/fb/facebook_white.png") . "' 
                        id='menu-facebook' 
                        alt='Facebook' 
                        class='fitimage colorswitch' >
                    </a>
                </div>\n";

        // Placeholder
        echo "<div class='placeholder'></div>\n";

        // Right halve
        echo "  <div><a href='" . absoluteResource("legal/Impressum.php") . "' " . ($current == "IMPRESS" ? "class='active'" : "") . ">Impressum</a></div>
                <div><a href='" . absoluteResource("legal/datenschutz/Datenschutz.php") . "' " . ($current == "DATASEC" ? "class='active'" : "") . ">Datenschutz</a></div>
                <div>
                    <a href='' 
                    onclick='openSettings();return false;'
                    onmouseenter='colorswitch(\"menu-settings\")' 
                    onmouseleave='colorswitch(\"menu-settings\")'>
                        <img
                        id='menu-settings'
                        src='" . absoluteResource("resources/images/base/settings_green.png") . "'
                        x-other='" . absoluteResource("resources/images/base/settings_white.png") . "'
                        alt='Einstellungen'
                        class='fitimage colorswitch'>
                    </a>
                </div>
              </div>\n";

        echo "</nav>\n";
    }

    /** Used for loading resources independently from the current files location
     *
     * @param string $resource path to the resource relative to root-directory
     *
     * @return string
     */
    function absoluteResource($resource)
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = "https://";
        }
        else {
            $url = "http://";
        }

        $url .= $_SERVER['HTTP_HOST'];
        $url .= "/";
        $url .= $resource;
        return $url;
    }

    function includeJs($filename)
    {
        $res = "resources/js/" . $filename;
        preload($res, "script");
        echo "<script type='text/javascript' src='" . absoluteResource($res) . "'></script>\n";
    }

    function includeCss($filename)
    {
        $res = "resources/css/" . $filename;
        preload($res, "style");
        echo "<link rel='stylesheet' href='" . absoluteResource($res) . "'>\n";
    }

    function loadJson($filename)
    {
        $fn         = absoluteResource("resources/json/" . $filename);
        $jsonString = file_get_contents($fn);
        return json_decode($jsonString);
    }

    function preload($filename, $as = "")
    {
        echo "<link rel='preload' href='" . absoluteResource($filename) . "'" . (strlen($as) === 0 ? "" : " as='$as'") . ">\n";
    }
