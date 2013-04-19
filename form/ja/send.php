<?php
  // スパム送信を防ぐためのキー
  include_once("../include/key.inc");
  if (!(isset($_POST['key']) && $_POST['key'] === $_key)) {
    return;
  }
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="Mozilla Factory の取り組みに興味のある方は、このフォームからご連絡ください。"/>
    <meta name="robots" content="nofollow, noindex" />
    <link rel="canonical" href="http://www.mozillafactory.org/ja/contact/">
    <link rel="stylesheet" type="text/css" href="../css/form.css"/>
  </head>
  <body>
<?php
//  $DEBUG = true;
//  $DEBUG_mail = "daisuke@mozilla-japan.org";
  $MAIL_ADDRESS = ($DEBUG ? $DEBUG_mail : 'mozillafactory@mozilla-japan.org');
  $subject = $_POST['subject'];
  $title = $_POST['title'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $organization = $_POST['organization'];
  $request = $_POST['request'];
  $comment = $_POST['comment'];

  $bodyparts = array(
    _('希望するプロジェクトやイベント') . "\n" . $title,
    _('お名前') . "\n" . $name,
    _('メールアドレス') . "\n" . $email,
    _('年齢') . "\n" . $age,
    _('学校名／所属') . "\n" . $organization,
    _('リクエスト') . "\n" . $request,
    _('コメント') . "\n" . $comment
  );
  $body = implode("\n\n", $bodyparts);
  
  $mailfields = array(
    'key' => 'ohweiGeeXeichogie1aiLa9eejei)z7i',
    'from' => $email,
    'to' => $MAIL_ADDRESS,
    'cc' => '',
    'bcc' => '',
    'subject' => $subject . _(' (Web サイトからの問い合わせ)'),
    'body' => $body
  );

  // API 経由でメールを送信 (mozilla.jp のミラーサーバから直接送信できない場合を考慮)
  $_ch = curl_init('https://secure.mozilla.jp/api/mail/1');
  curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($_ch, CURLOPT_POST, true);
  curl_setopt($_ch, CURLOPT_POSTFIELDS, http_build_query($mailfields));
  curl_setopt($_ch, CURLOPT_SSL_VERIFYHOST, true);
  curl_setopt($_ch, CURLOPT_SSL_VERIFYPEER, true);
  $_result = curl_exec($_ch);

  if (curl_getinfo($_ch, CURLINFO_HTTP_CODE) !== 200 || $_result === false || $_result === '-1') {
?>
<div>
フォームを送信できませんでした。申し訳ありませんが、また後でお試しください。
</div>
<?php
  } else {
?>
<div>

Mozilla Factory に関するお問い合わせをいただきありがとうございます。
あらためて担当者よりご連絡をさせていただきますので、今しばらくお待ちいた
だければと思います。
</div>
<?php
  } 
  //自動返信
  $subject = "【Mozilla Factory】お問い合わせありがとうございます";
  $body = "Mozilla Factory に関するお問い合わせをいただきありがとうございます。\nあらためて担当者よりご連絡をさせていただきますので、今しばらくお待ちいただければと思います。";
  $body .= "\n\n";
  $body .= "*****************************************\n";
  $body .= "Mozilla Factory 事務局\n";
  $body .= "Email: mozillafactory@mozilla-japan.org\n";
  $body .= "*****************************************\n";

  $mailfields = array(
    'key' => 'ohweiGeeXeichogie1aiLa9eejei)z7i',
    'from' => $MAIL_ADDRESS,
    'to' => $email,
    'cc' => '',
    'bcc' => '',
    'subject' => $subject,
    'body' => $body
  );

  // API 経由でメールを送信 (mozilla.jp のミラーサーバから直接送信できない場合を考慮)
  $_ch = curl_init('https://secure.mozilla.jp/api/mail/1');
  curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($_ch, CURLOPT_POST, true);
  curl_setopt($_ch, CURLOPT_POSTFIELDS, http_build_query($mailfields));
  curl_setopt($_ch, CURLOPT_SSL_VERIFYHOST, true);
  curl_setopt($_ch, CURLOPT_SSL_VERIFYPEER, true);
  $_result = curl_exec($_ch);
  
?>
  </body>
</html>
