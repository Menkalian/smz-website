<?php
    include_once "constants.php";

    /**
     *  Generates common elements for html-head element
     */
    function common_head()
    {
        // Metadata
        echo "<meta charset=\"UTF-8\">\n";
        echo "<link rel='icon' href='" . absolute_resource("resources/images/base/logos/smz/icon.gif") . "'>\n";

        // preload images
        preload("resources/images/base/logos/fb/facebook_black.png", "image");
        preload("resources/images/base/logos/fb/facebook_white.png", "image");
        preload("resources/images/base/background.png", "image");

        // Script files
        include_js("libs/cookies-eu-banner.js");
        include_js("libs/js.cookie.js");
        include_js("default.js");

        // CSS
        include_css("constants.css");
        include_css("main.css");
        include_css("cookienotice.css");
    }

    function cookie_request()
    {
        echo "<div id='cookies-eu-banner'>";
        echo "<p>Wir setzen auf dieser Seite Cookies ein, um die Nutzung angenehmer zu gestalten. Diese Auswahl kann jederzeit in den Einstellungen angepasst werden.</p>";
        echo "<a href='" . absolute_resource("legal/datenschutz/_general_cookie_info.php") .
             "' id='cookies-eu-more'>Weitere Infos zur Verwendung von Cookies</a><br>";

        // Create Sliders
        echo "<ul><li>";
        create_slider("cookies-eu-essential", "Notwendige Cookies", true, false);
        echo "</li><li>";
        create_slider("cookies-eu-convenience", "Cookies für eine verbesserte Nutzungserfahrung", true);
        echo "</li><li>";
        create_slider("cookies-eu-facebook", "(externe) Facebook Cookies", true);
        echo "</li></ul>";

        // Buttons
        echo "<button id='cookies-eu-accept'>Auswahl bestätigen</button>";

        echo "</div>";
    }

    function home_menu($current = "NONE")
    {
        echo "<nav class='navbar'>\n";

        // Left halve
        echo "<div>
                <div><img src='" . absolute_resource("resources/images/base/logos/smz/smz_logo_freigestellt.png") . "' alt='Spielmannszug Frammersbach' class='fitimage'></div>
                <div>
                    <a href='" . absolute_resource("index.php") . "' " . ($current == "HOME" ? "class='active'" : "") . ">Home</a>
                </div>
                <div>
                    <a 
                    href='https://de-de.facebook.com/SpielmannszugFrammersbach/' 
                    onmouseenter='colorswitch(\"menu-facebook\")' 
                    onmouseleave='colorswitch(\"menu-facebook\")' >
                        <img 
                        src='" . absolute_resource("resources/images/base/logos/fb/facebook_black.png") . "' 
                        x-other='" . absolute_resource("resources/images/base/logos/fb/facebook_white.png") . "' 
                        id='menu-facebook' 
                        alt='Facebook' 
                        class='fitimage colorswitch' >
                    </a>
                </div>\n";

        // Placeholder
        echo "<div class='placeholder'></div>\n";

        // Right halve
        echo "  <div><a href='" . absolute_resource("legal/Impressum.php") . "' " . ($current == "IMPRESS" ? "class='active'" : "") . ">Impressum</a></div>
                <div><a href='" . absolute_resource("legal/datenschutz/Datenschutz.php") . "' " . ($current == "DATASEC" ? "class='active'" : "") . ">Datenschutz</a></div>
                <div>
                    <a href='' 
                    onclick='open_settings();return false;'
                    onmouseenter='colorswitch(\"menu-settings\")' 
                    onmouseleave='colorswitch(\"menu-settings\")'>
                        <img
                        id='menu-settings'
                        src='" . absolute_resource("resources/images/base/settings_wheel.png.php?color=" . COLOR_PRIMARY) . "'
                        x-other='" . absolute_resource("resources/images/base/settings_wheel.png.php?color=" . COLOR_BACKGROUND) . "'
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
     * @param bool   $intern   whether the request is to be made internally (by php) or externally (js)
     *
     * @return string
     */
    function absolute_resource($resource, $intern = false)
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = "https://";
        }
        else {
            $url = "http://";
        }

        if ($intern) {
            $url .= "localhost";
        }
        else {
            $url .= $_SERVER['HTTP_HOST'];
        }

        $url .= "/";
        $url .= $resource;
        return $url;
    }

    function include_js($filename)
    {
        $res = "resources/js/" . $filename;
        preload($res, "script");
        echo "<script type='text/javascript' src='" . absolute_resource($res) . "'></script>\n";
    }

    function include_css($filename)
    {
        $res = "resources/css/" . $filename;
        preload($res, "style");
        echo "<link rel='stylesheet' href='" . absolute_resource($res) . "'>\n";
    }

    function load_json($filename)
    {
        $fn          = absolute_resource("resources/json/" . $filename, true);
        $json_string = file_get_contents($fn);
        return json_decode($json_string);
    }

    function preload($filename, $as = "")
    {
        echo "<link rel='preload' href='" . absolute_resource($filename) . "'" . (strlen($as) === 0 ? "" : " as='$as'") . ">\n";
    }

    function safe_int($str_val, $base = 10)
    {
        $int_val = intval($str_val, $base);
        if (strcasecmp(
                str_pad(base_convert(strval($int_val), 10, $base), strlen($str_val), "0", STR_PAD_LEFT),
                $str_val) == 0) {
            return $int_val;
        }
        else {
            return false;
        }
    }

    function safe_double($str_val)
    {
        $double_val = doubleval($str_val);
        if (strcasecmp(strval($double_val), $str_val) == 0) {
            return $double_val;
        }
        else {
            return false;
        }
    }
