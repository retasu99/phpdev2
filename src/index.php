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



<!-- =================================================================================== -->

<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>参加者内訳</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

<!-------------------------------------------------------------------------------------------- -->

<?php
    $arr = [1, 2, 3, 4, 5];
    print_r($arr);
    echo "<br>";

    shuffle($arr);
    print_r($arr);
?>

<!-------------------------------------------------------------------------------------------- -->

    </body>
</html>
