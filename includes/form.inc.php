<?
@include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/common.inc.php';

$_type = $_POST['type'] ? $_POST['type'] : $_GET['type'];
$_isEvent = $_type == 'join-scp';

// フォームのカスタマイズ
$_form = (object) array(
  'description' => _('Mozilla Factory の取り組みに興味のある方は、このフォームからご連絡ください。'),
  'required' => array(),
  'default_comment' => ''
);
if (!empty($_type)) {
  switch ($_type) {
    case 'join-scp':
      $_form->description = _('Mozilla Summer Code Party in Kobe への参加をご希望の方は、このフォームからお申込みください。');
      $_form->required = array('age', 'comment');
      $_form->default_comment = _('来場予定時間:');
      break;
  }
}
if (!empty($_POST['comment'])) {
  $_form->comment = $_POST['comment'];
} else {
  $_form->comment = $_form->default_comment;
}

// 件名
$_subject = _('Mozilla Factory について');
if (!empty($_POST['subject'])) {
  $_subject = $_POST['subject'];
} else if (!empty($_type)) {
  switch ($_type) {
    case 'projects':
      $_subject = _('Mozilla Factory のプロジェクトについて');
      break;
    case 'webmaker':
      $_subject = _('Webmaker について');
      break;
    case 'join-webmaker':
      $_subject = _('Webmaker プロジェクト参加希望');
      break;
    case 'mecha':
      $_subject = _('Mecha-Mozilla について');
      break;
    case 'join-mecha':
      $_subject = _('Mecha-Mozilla プロジェクト参加希望');
      break;
    case 'mentor':
      $_subject = _('メンター参加希望');
      break;
    case 'join-buttobi':
      $_subject = _('ぶっとびケータイプロジェクト参加希望');
      break;
    case 'join-scp':
      $_subject = _('Mozilla Summer Code Party in Kobe 参加予定');
      break;
  }
}

// 本文
$bodyparts = array(
  _('お名前') . "\n" . $_POST['name'],
  _('メールアドレス') . "\n" . $_POST['email'],
  _('年齢') . "\n" . $_POST['age'],
  _('学校名／所属') . "\n" . $_POST['organization']
);
if (!$_isEvent) {
  $interest_table = array(
    'think' => _('考える'),
    'create' => _('創造する'),
    'design' => _('デザインする'),
    'make&build' => _('作る'),
    'lead' => _('教える')
  );
  if ($_POST['interest']) {
    $interest = implode(', ', array_map(function($v){
        global $interest_table;
        return $interest_table[$v];
      }, $_POST['interest']));
  }
  else {
    $interest = _('なし');
  }
  $bodyparts[] = _('興味のある体験') . "\n" . $interest;
}
$bodyparts[] = _('コメント') . "\n" . $_POST['comment'];
$_body = implode("\n\n", $bodyparts);

// スパム送信を防ぐためのキー
$_key = md5(strtotime('today') * 5716);
// ステータス (-1: エラー、0: 未送信、1: 送信完了)
$_status = (object) array('code' => 0, 'text' => '');

if (isset($_POST['key']) && $_POST['key'] === $_key) {
  // 入力値のチェック
  if (empty($_POST['name'])) {
    $_status->code = -1;
    $_status->text = _('お名前が入力されていません。');
  } else if (empty($_POST['email'])) {
    $_status->code = -1;
    $_status->text = _('メールアドレスが入力されていません。');
  } else if (!preg_match('/^[\w\.\-]+@[\w\.\-]+$/', $_POST['email'])) {
    $_status->code = -1;
    $_status->text = _('メールアドレスの形式が正しくありません。');
  }

  if ($_status->code === 0) {
    $_fields = array(
      'key' => 'ohweiGeeXeichogie1aiLa9eejei)z7i',
      'from' => $_POST['email'],
      'to' => ($DEBUG ? $DEBUG_mail : 'education@mozilla-japan.org'),
      'cc' => '',
      'bcc' => '',
      'subject' => $_subject . _(' (Web サイトからの問い合わせ)'),
      'body' => $_body
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
      $_status->text = _('フォームを送信できませんでした。申し訳ありませんが、また後でお試しください。');
    } else {
      $_status->code = 1;
      $_status->text = _('ありがとうございました。折り返しご連絡を差し上げます。');
    }

    curl_close($_ch);
    unset($_fields, $_ch);
  }
}
