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

<!-- =================================================================================== -->

<html>
    <head>
        <title><?php print($title); ?></title>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1><?php print($title); ?></h1>

        <label>入力した文字列のバイト数と文字数を表示します。</label>
        <form action="strlen.php" method="GET">
            <textarea name="sentence" rows="10" cols="50"><?php print($sentence); ?></textarea>
            <br>
            <button type="submit">送信</button>
        </form>
        <div><?php print($message); ?></div>

<!-------------------------------------------------------------------------------------------- -->



<!-------------------------------------------------------------------------------------------- -->

    </body>
</html>
