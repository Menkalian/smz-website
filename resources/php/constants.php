<?php
    include_once "util.php";

    $theme = !isset($_COOKIE["theme"]) ? 0 : safe_int($_COOKIE["theme"]);

    /**
     * Define the colors/parameters to use for the color themes
     *
     * Themes:
     *  0/default : Light-Mode / Green Accent
     */

    switch ($theme) {

        case 0:
        default:
            define("COLOR_PRIMARY", "53810C");
            define("COLOR_PRIMARY_LIGHT_VAR", "6CAC0A");
            define("COLOR_PRIMARY_DARK__VAR", "476B12");
            define("COLOR_BACKGROUND", "F5F5F5");
            define("COLOR_STRUCTURAL", "D0D0D0");

            define("COLOR_POSITIVE", "059D1F");
            define("COLOR_POSITIVE_BACKGROUND", "B6FFB1");
            define("COLOR_NEGATIVE", "D40A50");
            define("COLOR_NEGATIVE_BACKGROUND", "FF8B8B");

            define("PANEL_OVERLAY_COLOR_RED", "215");
            define("PANEL_OVERLAY_COLOR_GRE", "180");
            define("PANEL_OVERLAY_COLOR_BLU", "120");
            define("PANEL_OVERLAY_OPACITY", 0.4);
            break;
    }

