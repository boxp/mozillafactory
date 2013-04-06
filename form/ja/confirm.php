<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="Mozilla Factory の取り組みに興味のある方は、このフォームからご連絡ください。"/>
    <meta name="robots" content="nofollow, noindex" />
    <link rel="canonical" href="http://www.mozillafactory.org/ja/contact/">
    <link rel="stylesheet" type="text/css" href="../css/form.css"/>
    <title>お問い合わせフォーム | Mozilla Factory</title>
  </head>
  <body>

<form id="contact-form" action="send.php" method="POST">
  <dl>
    <dt>
       <label for="subject" class="required">お問い合わせ内容</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['subject'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="subject" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="title">参加を希望するプロジェクトやイベント名</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['title'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="title" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="name" class="required">お名前</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['name'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="name" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="email" class="required">メールアドレス</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['email'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="email" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="age">年齢</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['age'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="age" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="organization">学校名または所属</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['organization'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="organization" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="request">Mozilla Factory でやりたいこと、期待すること</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['request'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="request" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="comment">コメント</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['comment'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="comment" value="<?php echo $value; ?>" />
<input type="hidden" name="key" value="<?php include_once('../include/key.inc');
 echo $_key; ?>" />
    </dd>
  </dl>

  <div id="send-mail">
    <input type="button" value="戻る" onclick="history.back();"/>
    <input id="submit" name="submit" type="submit" value="送信" />
  </div>
</form>

  </body>
</html>
