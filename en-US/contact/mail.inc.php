<?

// デバッグフラグ
$_debug = false;
$_debug_mail = 'dynamis@mozilla-japan.org';

// フォームのカスタマイズ
$_form = (object) array(
  'description' => 'If you are interested in our Mozilla Factory initiative, please let us know by this form.',
  'required' => array(),
  'default_comment' => ''
);
if (!empty($_GET['type'])) {
  switch ($_GET['type']) {
    case 'join-scp':
      $_form->description = 'Mozilla Summer Code Party in Kobe への参加をご希望の方は、このフォームからお申込みください。';
      $_form->required = array('age', 'comment');
      $_form->default_comment = '来場予定時間:';
      break;
  }
}
if (!empty($_POST['comment'])) {
  $_form->comment = $_POST['comment'];
} else {
  $_form->comment = $_form->default_comment;
}

// 件名
if (!empty($_POST['subject'])) {
  $_subject = $_POST['subject'];
} else if (!empty($_GET['type'])) {
  switch ($_GET['type']) {
    case 'projects':
      $_subject = 'About Mozilla Factory projects'; break;
    case 'webmaker':
      $_subject = 'About Webmaker'; break;
    case 'join-webmaker-en':
      $_subject = 'I\'d like to get involved with the Webmaker project'; break;
    case 'mecha':
      $_subject = 'About Mecha-Mozilla'; break;
    case 'join-mecha':
      $_subject = 'I\'d like to get involved with the Mecha-Mozilla project'; break;
    case 'mentor':
      $_subject = 'I\'d like to be a mentor'; break;
    case 'join-mecha-en':
      $_subject = 'I\'d like to get involved with the Mecha-Mozilla project';
      break;
    case 'join-webmaker-en':
      $_subject = 'I\'d like to join webmaker';
      break;
    case 'join-buttobi-en':
      $_subject = 'I\'d like to join buttobi project';
      break;
    default:
      $_subject = ''; break;
  }
} else {
  $_subject = 'About Mozilla Factory';
}

// スパム送信を防ぐためのキー
$_key = md5(strtotime('today') * 5716);
// ステータス (-1: エラー、0: 未送信、1: 送信完了)
$_status = (object) array('code' => 0, 'text' => '');

if (isset($_POST['key']) && $_POST['key'] === $_key) {
  // 入力値のチェック
  if (empty($_POST['name'])) {
    $_status->code = -1;
    $_status->text = 'Your name is not provided.';
  } else if (empty($_POST['email'])) {
    $_status->code = -1;
    $_status->text = 'Your E-mail is not provided.';
  } else if (!preg_match('/^[\w\.\-]+@[\w\.\-]+$/', $_POST['email'])) {
    $_status->code = -1;
    $_status->text = 'Your E-mail is invalid.';
  }

  if ($_status->code === 0) {
    $_fields = array(
      'key' => 'ohweiGeeXeichogie1aiLa9eejei)z7i',
      'from' => $_POST['email'],
      'to' => 'education@mozilla-japan.org',
      'cc' => 'shuntaro@mozilla-japan.org',
      'bcc' => '',
      'subject' => $_subject . ' (from Web)',
      'body' => implode("\n\n", array(
        'Name' . "\n" . $_POST['name'],
        'E-mail' . "\n" . $_POST['email'],
        'Age' . "\n" . $_POST['age'],
        'School/Organization' . "\n" . $_POST['organization'],
        'Comments' . "\n" . $_POST['comment']
      ))
    );

    // API 経由でメールを送信 (mozilla.jp のミラーサーバから直接送信できない場合を考慮)
    $_ch = curl_init('https://secure.mozilla.jp/api/mail/1');
    curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($_ch, CURLOPT_POST, true);
    curl_setopt($_ch, CURLOPT_POSTFIELDS, http_build_query($_fields));
    curl_setopt($_ch, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($_ch, CURLOPT_SSL_VERIFYPEER, true);
    $_result = curl_exec($_ch);

    if (curl_getinfo($_ch, CURLINFO_HTTP_CODE) !== 200 || $_result === false || $_result === '-1') {
      $_status->code = -1;
      $_status->text = 'Sorry, your message could not be sent. Please try again later.';
    } else {
      $_status->code = 1;
      $_status->text = 'Thank you. We\'ll get back to you in a few days.';
    }

    curl_close($_ch);
    unset($_fields, $_ch);
  }
}
