<?php
    // needs util.php
    include_once "util.php";

    function galleryHeaders()
    {
        includeCss("slideshow.css");
        includeJs("slideshow.js");
    }

    function createGalleryContainer()
    {
        echo "<div class='slideshow-container'>";

        $galleryObject = loadJson("gallery.json");
        $count         = count($galleryObject);
        $inc           = 0;

        foreach ($galleryObject as $item) {
            echo "
            <div class='slide fade'>
                <div class='numbertext'>" . (++$inc) . " / $count</div>
                <img src='" . absoluteResource("resource/images/content/image_gallery/" . $item->file) . "' alt='" . $item->description . "'>
                <div class='caption'><span>" . $item->description . "</span></div>
            </div>
            ";
        }

        // Next and previous
        echo "<a class='prev' onclick='changeSlides(-1)'>&#10094;</a>";
        echo "<a class='next' onclick='changeSlides(1)' >&#10095;</a>";

        echo "</div>";

        echo "<div style='text-align:center;margin-top: 0.3rem'>";
        // Dots for directly selecting a picture
        for ($i = 0 ; $i < $count ; ++$i) {
            echo "<span class='dot' onclick='toSlide(" . $i . ")'></span>";
        }
        echo "</div>";
    }
