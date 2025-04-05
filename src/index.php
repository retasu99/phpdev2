<?php
// データベース接続情報
$host = 'db'; // Docker ComposeでのMySQLサービス名
$dbname = 'test-db';
$user = 'test-user';
$pass = 'test-pass';

// 待機時間を設定してMySQLサービスが起動するのを待つ
$max_attempts = 10;
$attempt = 0;
while ($attempt < $max_attempts) {
    try {
        // データベースに接続
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        break;
    } catch (PDOException $e) {
        // エラーが発生した場合は数秒待機して再試行する
        sleep(1);
        $attempt++;
    }
}

if ($attempt === $max_attempts) {
    echo "データベース接続エラー: MySQLサービスが起動しませんでした\n";
    exit(1);
}

try {
    // テーブル作成クエリ
    $sql = "CREATE TABLE IF NOT EXISTS test_table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";
    
    // テーブルを作成
    $pdo->exec($sql);
    
    // echo "データベース接続成功、テーブル作成成功<br>";
} catch (PDOException $e) {
    // エラーが発生した場合はエラーメッセージを表示
    echo "テーブル作成エラー: " . $e->getMessage() . "\n";
}
?>

<!-- ================================================================================ -->

<?php
    function calc_bmi($height_cm, $weight) {
        $height_m = $height_cm / 100;
        $bmi = $weight / ($height_m * $height_m);
        return $bmi;
    }
?>

<?php
    $title = 'ユーザー定義関数サンプル1';
    $bmi;

    if (isset($_GET['height_cm']) && isset($_GET['weight'])) {
        $bmi = calc_bmi($_GET['height_cm'], $_GET['weight']);
    }
?>

<!-- =================================================================================== -->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title><?php print($title); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

<!-------------------------------------------------------------------------------------------- -->
      <h1><?php print($title); ?></h1>
      <h2>BMI指数を表示します</h2>

      <form method="get">
        <label>身長(cm):</label><input type="text" name="height_cm">
        <br>
        <label>体重(kg):</label><input type="text" name="weight">
        <br>
        <button>計算</button>
      </form>

      <?php
        if (isset($bmi)) {
            echo "BMI指数は{$bmi}です。";
        }
      ?>
<!-------------------------------------------------------------------------------------------- -->

    </body>
</html>
