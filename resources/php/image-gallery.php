<?php
    // needs util.php
    include_once "util.php";

    class post_image
        {
        /**
         * @var $img string Path to the image relative to the `resources/images/content/image_gallery` directory.
         */
        public $img;
        public $text;

        /**
         * @param $json_obj object Deserialized json Object, that will be converted to an object of this class.
         */
        public function __construct($json_obj)
        {
            $this->img  = $json_obj->img;
            $this->text = $json_obj->text;
        }
        }

    class post
        {
        public $date;
        public $title;
        public $thumbnail;
        public $text;
        public $images = array();

        public function __construct($json_obj)
        {
            $this->date      = date_create($json_obj->date, new DateTimeZone("CET"));
            $this->title     = $json_obj->title;
            $this->thumbnail = $json_obj->thumbnail;
            $this->text      = $json_obj->text;

            foreach ($json_obj->images as $img_json) {
                $this->images[] = new post_image($img_json);
            }
        }
        }

    class gallery_entry
        {
        public $text;
        public $image;
        public $link;

        /**
         * @param $text
         * @param $image
         * @param $link
         */
        public function __construct($text, $image, $link)
        {
            $this->text  = $text;
            $this->image = $image;
            $this->link  = $link;
        }
        }

    function gallery_headers()
    {
        include_css("slideshow.css");
        include_js("slideshow.js");
    }

    /**
     * @param $entries gallery_entry[]
     *
     * @return void
     */
    function create_gallery_container($entries)
    {
        echo "<div class='slideshow-container'>";
        $count = count($entries);
        $inc   = 0;

        foreach ($entries as $entry) {
            echo "<div class='slide fade'>";


            echo "<div class='numbertext' > " . (++$inc) . " / $count</div >";

            if (strlen($entry->link) > 0) {
                echo "<a href=" . $entry->link . ">";
            }
            echo "<img src = '" . absolute_resource("resources/images/content/image_gallery/" . $entry->image) . "' alt = '" . $entry->text . "' >";
            if (strlen($entry->link) > 0) {
                echo "</a>";
            }

            if (strlen($entry->text) > 0) {
                echo "<div class='caption' ><span > " . $entry->text . "</span ></div >";
            }

            echo "</div>";
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
