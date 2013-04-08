<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <meta name="robots" content="nofollow, noindex" />
    <link rel="canonical" href="http://www.mozillafactory.org/ja/contact/">
    <link rel="stylesheet" type="text/css" href="../css/form.css"/>
  </head>
  <body>
<form id="contact-form" action="send.php" method="POST">
  <dl>
    <dt>
       <label for="subject" class="required">Subject</label>
    </dt>
    <dd>
<?php 
  $hasError = false;
  $value = htmlspecialchars($_POST['subject'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="subject" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="title">Project or event you wish to apply for</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['title'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="title" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="name" class="required">Name</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['name'], ENT_QUOTES);
  $value = trim($value);
  if (strlen($value) == 0) {
    $hasError = true;
    echo "<span class='error'>Please enter your name.</span>";
  } else {
    echo $value;
  }
?>
<input type="hidden" name="name" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="email" class="required">E-mail address</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['email'], ENT_QUOTES);
  if (strlen($value) == 0) {
    $hasError = true;
    echo "<div class='error'>Please enter your e-mail address.<div>";
  } else if (!preg_match('/^[\w\.\-]+@[\w\.\-]+$/', $value)) {
    $hasError = true;
    echo $value;
    echo "<div class='error'>Please enter a valid address in the format.</div>";
  } else {
    echo $value;
  }
?>
<input type="hidden" name="email" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="age">Age</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['age'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="age" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="organization">Name of school or organization</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['organization'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="organization" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="request">Things you wish to do at Mozilla Factory, or things you wish for Mozilla Factory to do in the near future</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['request'], ENT_QUOTES);
  echo $value;
?>
<input type="hidden" name="request" value="<?php echo $value; ?>" />
    </dd>

    <dt>
      <label for="comment">Message</label>
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

    <dt>
      <label for="comment">Agree to plivacy policy</label>
    </dt>
    <dd>
<?php 
  $value = htmlspecialchars($_POST['privacy'], ENT_QUOTES);
  if (strcmp($value, "agree") != 0) {
    $hasError = true;
    echo "<div class='error'>Please select this checkbox if you have read and agree to our Privacy Policy.</div>";
  } else {
    echo "Agree";
  }
?>
<input type="hidden" name="privacy" value="<?php echo $value; ?>" />
    </dd>

  </dl>

  <div id="send-mail">
    <input type="button" value="back" onclick="history.back();"/>
    <?php if ($hasError == false) { ?>
    <input id="submit" name="submit" type="submit" value="submit" />
    <?php } ?>
  </div>
</form>

  </body>
</html>
