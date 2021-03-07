<?php
    function createSlider($id, $description, $initial = false, $editable = true)
    {
        echo "<label><label class='switch'><input id='$id' type='checkbox'"
             . ($initial ? " checked" : "")
             . ($editable ? "" : " disabled='disabled'") .
             " ><span class='slider'></span></label>$description</label>";
    }