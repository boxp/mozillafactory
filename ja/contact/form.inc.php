<?

// フォームのカスタマイズ
$_form = (object) array(
  'description' => 'Mozilla Factory の取り組みに興味のある方は、このフォームからご連絡ください。',
  'required' => array(),
  'default_comment' => ''
);
if (!empty($_GET['type'])) {
  switch ($_GET['type']) {
    case 'join-scp':
      $_form->description = 'Mozilla Summer Code Party in Kyoto への参加をご希望の方は、このフォームからお申込みください。';
      $_form->required = array('age', 'comment');
      $_form->default_comment = '来場予定時間: ';
      break;
  }
}
if (!empty($_POST['comment'])) {
  $_form->comment = $_POST['comment'];
} else {
  $_form->comment = $_form->default_comment;
}

// 件名
$_subject = 'Mozilla Factory について';
if (!empty($_POST['subject'])) {
  $_subject = $_POST['subject'];
} else if (!empty($_GET['type'])) {
  switch ($_GET['type']) {
    case 'projects':
      $_subject = 'Mozilla Factory のプロジェクトについて';
      break;
    case 'webmaker':
      $_subject = 'Webmaker について';
      break;
    case 'join-webmaker':
      $_subject = 'Webmaker プロジェクト参加希望';
      break;
    case 'mecha':
      $_subject = 'Mecha-Mozilla について';
      break;
    case 'join-mecha':
      $_subject = 'Mecha-Mozilla プロジェクト参加希望';
      break;
    case 'mentor':
      $_subject = 'メンター参加希望';
      break;
    case 'join-scp':
      $_subject = 'Mozilla Summer Code Party in Kyoto 参加予定';
      break;
    case 'join-buttobi':
      $_subject = 'ぶっとびケータイプロジェクト参加希望';
      break;
    default:
      $_subject = 'About Mozilla Factory'; break;
  }
}

// スパム送信を防ぐためのキー
$_key = md5(strtotime('today') * 5716);
// ステータス (-1: エラー、0: 未送信、1: 送信完了)
$_status = (object) array('code' => 0, 'text' => '');

if (isset($_POST['key']) && $_POST['key'] === $_key) {
  // 入力値のチェック
  if (empty($_POST['name'])) {
    $_status->code = -1;
    $_status->text = 'お名前が入力されていません。';
  } else if (empty($_POST['email'])) {
    $_status->code = -1;
    $_status->text = 'メールアドレスが入力されていません。';
  } else if (!preg_match('/^[\w\.\-]+@[\w\.\-]+$/', $_POST['email'])) {
    $_status->code = -1;
    $_status->text = 'メールアドレスの形式が正しくありません。';
  }

  if ($_status->code === 0) {
    $_fields = array(
      'key' => 'ohweiGeeXeichogie1aiLa9eejei)z7i',
      'from' => $_POST['email'],
      'to' => 'education@mozilla-japan.org',
      'cc' => '',
      'bcc' => '',
      'subject' => $_subject . ' (Web サイトからの問い合わせ)',
      'body' => implode("\n\n", array(
        'お名前' . "\n" . $_POST['name'],
        'メールアドレス' . "\n" . $_POST['email'],
        '年齢' . "\n" . $_POST['age'],
        '学校名／所属' . "\n" . $_POST['organization'],
        'コメント' . "\n" . $_POST['comment']
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
      $_status->text = 'フォームを送信できませんでした。申し訳ありませんが、また後でお試しください。';
    } else {
      $_status->code = 1;
      $_status->text = 'ありがとうございました。折り返しご連絡を差し上げます。';
    }

    curl_close($_ch);
    unset($_fields, $_ch);
  }
}
