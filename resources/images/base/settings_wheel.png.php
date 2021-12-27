<?php
    include_once "../../php/util.php";

    const IMAGE_SIZE         = 512;
    const IMAGE_MID          = IMAGE_SIZE / 2;
    const COG_INNER_RADIUS   = 75;
    const COG_INNER_DIAMETER = COG_INNER_RADIUS * 2;
    const COG_OUTER_RADIUS   = 150;
    const COG_OUTER_DIAMETER = COG_OUTER_RADIUS * 2;
    const COG_TOOTH_COUNT    = 8;
    const COG_TOOTH_WIDTH    = 76;
    const COG_TOOTH_HEIGHT   = 65;

    if (!isset($_GET["color"])) {
        http_response_code(400);
        exit(1);
    }

    $color = safe_int($_GET["color"], 16);

    if ($color === false) {
        var_dump($color);
        http_response_code(400);
        exit();
    }

    $blue  = $color & 0xff;
    $green = ($color >> 8) & 0xff;
    $red   = ($color >> 16) & 0xff;

    $image = imagecreate(IMAGE_SIZE, IMAGE_SIZE);
    imagecolorallocatealpha($image, 0, 0, 0, 127);
    imagecolorallocatealpha($image, $red, $green, $blue, 0);

    // Draw cog
    imagefilledellipse($image, IMAGE_MID, IMAGE_MID, COG_OUTER_DIAMETER, COG_OUTER_DIAMETER, $color);
    imagefilledellipse($image, IMAGE_MID, IMAGE_MID, COG_INNER_DIAMETER, COG_INNER_DIAMETER, (127 << 24));


    for ($i = 0 ; $i < COG_TOOTH_COUNT ; $i++) {
        $angle  = $i * 2 * pi() / COG_TOOTH_COUNT;
        $base_x = IMAGE_MID + cos($angle) * COG_OUTER_RADIUS;
        $base_y = IMAGE_MID + sin($angle) * COG_OUTER_RADIUS;

        $bot   = -20;
        $top   = $bot + COG_TOOTH_HEIGHT;
        $lleft = -1 * COG_TOOTH_WIDTH / 2.0;
        $right = +1 * COG_TOOTH_WIDTH / 2.0;

        $points = [
            $base_x + $top * cos($angle) - $lleft * sin($angle), $base_y + $top * sin($angle) + $lleft * cos($angle),
            $base_x + $bot * cos($angle) - $lleft * sin($angle), $base_y + $bot * sin($angle) + $lleft * cos($angle),
            $base_x + $bot * cos($angle) - $right * sin($angle), $base_y + $bot * sin($angle) + $right * cos($angle),
            $base_x + $top * cos($angle) - $right * sin($angle), $base_y + $top * sin($angle) + $right * cos($angle),
        ];

        imagefilledpolygon($image, $points, 4, $color);
    }


    header("Content-Type: image/png");
    imagepng($image);
    imagedestroy($image);
