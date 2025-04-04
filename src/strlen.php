<?php
    $title = "strlen関数サンプル";

    $sentence = '';
    $message = '';
    if (isset($_GET['sentence'])) {
        $sentence = $_GET['sentence'];
        $strlen = strlen($sentence);
        $mb_strlen = mb_strlen($sentence);
        $message = "{$strlen}バイト、{$mb_strlen}文字です。";
    }
?>