<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// フォームデータを変数に代入
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$type = htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

// PHPMailerのインスタンスを作成
$mail = new PHPMailer(true);

try {
    // サーバー設定
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // GmailのSMTPサーバー
    $mail->SMTPAuth = true;
    $mail->Username = '3start.official@gmail.com'; // 自分のGmailアドレス
    $mail->Password = '3start-0627'; // 自分のGmailパスワード
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // 受信者設定
    $mail->setFrom('3start.official@gmail.com', 'お問い合わせ確認 - 3start'); // 送信者情報
    $mail->addAddress('3start.official@gmail.com'); // 受信者情報

    // コンテンツ設定
    $mail->isHTML(true); // HTML形式でメールを送信
    $mail->Subject = '新しいお問い合わせがあります';
    $mail->Body    = "
    <h1>新しいお問い合わせ</h1>
    <p><strong>名前:</strong> {$name}</p>
    <p><strong>メールアドレス:</strong> {$email}</p>
    <p><strong>お問い合わせ種別:</strong> {$type}</p>
    <p><strong>メッセージ:</strong><br>{$message}</p>
    ";
    $mail->AltBody = "
    新しいお問い合わせ\n
    名前: {$name}\n
    メールアドレス: {$email}\n
    お問い合わせ種別: {$type}\n
    メッセージ:\n{$message}
    ";

    $mail->CharSet = 'UTF-8'; // 文字コードをUTF-8に設定
    $mail->send();
    echo 'メッセージが送信されました';
} catch (Exception $e) {
    echo "メッセージの送信に失敗しました: {$mail->ErrorInfo}";
}
?>
