<?php
    
    $total = [
        "male" => $_POST["male"],
        "female" => $_POST["female"],
        "other" => $_POST["other"]
    ];

    echo "男性".$_POST["male"]."%<br>";
    echo "女性".$_POST["female"]."%<br>";
    echo "その他".$_POST["other"]."%<br>";

    $total_sum = array_sum($total);
    echo "合計".$total_sum."%<br>";

    if ($total_sum !== 100) {
        echo "合計が100パーセントになっていません<br>";
    } else {
        echo "合計が100パーセントですね...<br>";
    }
?>