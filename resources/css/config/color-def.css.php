<?php
include_once "../../php/constants.php";

header("Content-Type: text/css");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

echo ":root {
    --color-primary              : #". COLOR_PRIMARY. ";
    --color-light                : #". COLOR_PRIMARY_LIGHT_VAR . ";
    --color-dark                 : #". COLOR_PRIMARY_DARK__VAR. ";
    --color-background           : #". COLOR_BACKGROUND. ";
    --color-structural           : #". COLOR_STRUCTURAL. ";

    --color-positive             : #". COLOR_POSITIVE. ";
    --color-positive-background  : #". COLOR_POSITIVE_BACKGROUND. ";
    --color-negative             : #". COLOR_NEGATIVE. ";
    --color-negative-background  : #". COLOR_NEGATIVE_BACKGROUND. ";
}";