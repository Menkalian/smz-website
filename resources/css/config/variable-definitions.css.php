<?php
    include_once "../../php/constants.php";

    header("Content-Type: text/css");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    $rgba_value = "rgba(" . PANEL_OVERLAY_COLOR_RED . "," . PANEL_OVERLAY_COLOR_GRE . "," . PANEL_OVERLAY_COLOR_BLU . ",". PANEL_OVERLAY_OPACITY . ")";
    echo ":root {
    --background-image: linear-gradient($rgba_value,$rgba_value),
                        url(\"../images/base/background.png\");
}";