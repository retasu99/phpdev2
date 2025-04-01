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
    require_once('constants.php');

    $name = '';
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
    }

    $message = '';
    if(mb_strlen($name) > MAX_NAME_LENGTH) {
        $message = '名前は'.MAX_NAME_LENGTH.'文字以内で入力してください。';
    }

?>

<!-- =================================================================================== -->

<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>

<!-------------------------------------------------------------------------------------------- -->

<h1>定数のサンプル</h1>
<form action="" method="POST">
    <label>名前を入力してください：</label><input type="text" name="name" placeholder="10文字以内で入力してください" size="20" value="<?php echo $name; ?>">
    <div style="color: red"><?php echo $message; ?></div>
    <button type="submit">送信</button>

<!-------------------------------------------------------------------------------------------- -->

    </body>
</html>
