<?php
    $articles     = scandir("articles");
    $article_objs = array();
    foreach ($articles as $article) {
        if (preg_match("/.+\\.json/", $article) != false) {
            $obj            = json_decode(file_get_contents("articles/" . $article));
            $obj->name      = str_replace(".json", "", $article);
            $article_objs[] = $obj;
        }
    }

    function compare_json($json1, $json2)
    {
        return strcmp($json1->date, $json2->date);
    }

    usort($article_objs, "compare_json");

    $of = fopen("aggregated.json", "w");
    fwrite($of, json_encode($article_objs));

    echo "<pre>";
    print_r($article_objs);
    echo "</pre>";
