<?php
    if (isset($_GET["fruits"])) {
        foreach($_GET["fruits"] as $fruits) {
            echo $fruits."<br>";
        }
    }
?>