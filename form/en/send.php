<?php
  include_once("../include/key.inc");
  if (!(isset($_POST['key']) && $_POST['key'] === $_key)) {
    return;
  }
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <meta name="robots" content="nofollow, noindex" />
    <link rel="canonical" href="http://www.mozillafactory.org/ja/contact/">
    <link rel="stylesheet" type="text/css" href="../css/form.css"/>
  </head>
  <body>
<?php
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
Unfortunatery, faild to send the form. Please submit later.
</div>
<?php
  } else {
?>
<div>
Thank you for contacting us. Your message will be read by a Mozilla
Factory staff and will be returned shortly.
We appreciate your patience.
</div>
<?php
  } 
  $subject = "【Mozilla Factory】Thank you for contact us";
  $body = "Thank you for contacting us. Your message will be read by a Mozilla Factory staff and will be returned shortly. We appreciate your patience.";
  $body .= "\n\n";
  $body .= "*****************************************\n";
  $body .= "Mozilla Factory Secretariat\n";
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
