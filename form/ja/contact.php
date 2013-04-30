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

<form id="contact-form" action="confirm.php" method="POST">
  <dl>
    <dt>
       <label for="subject" class="required">お問い合わせ内容</label>
    </dt>
    <dd>
      <select id="subject" name="subject" required>
        <option value="プロジェクトへの参加希望">プロジェクトへの参加希望</option>
        <option value="イベントへの参加希望">イベントへの参加希望</option>
        <option value="Mozilla Factory に関するご質問">Mozilla Factory に関するご質問</option>
        <option value="Mozilla Factory へのご協力やご支援のお申し出">Mozilla Factory へのご協力やご支援のお申し出</option>
        <option value="その他">その他</option>
      </select>
    </dd>

    <dt>
      <label for="title">参加を希望するプロジェクトやイベント名があれば
ご記入ください</label>
    </dt>
    <dd>
      <input id="title" name="title" type="text"/>
    </dd>

    <dt>
      <label for="name" class="required">お名前</label><em class="required">（必須）</em>
    </dt>
    <dd>
      <input id="name" name="name" type="text" required />
    </dd>

    <dt>
      <label for="email" class="required">メールアドレス</label><em class="required">（必須）</em>
    </dt>
    <dd>
      <input id="email" name="email" type="email" required />
    </dd>

    <dt>
      <label for="age">年齢</label>
    </dt>
    <dd>
      <input id="age" name="age" type="number" />
    </dd>

    <dt>
      <label for="organization">学校名または所属</label>
    </dt>
    <dd>
      <input id="organization" name="organization" type="text" />
    </dd>

    <dt>
      <label for="request">Mozilla Factory でやりたいこと、期待することがあればお書きください</label>
    </dt>
    <dd>
      <textarea id="request" name="request" rows="5"></textarea>
    </dd>

    <dt>
      <label for="comment">コメント</label>
    </dt>
    <dd>
      <textarea id="comment" name="comment" rows="5" placeholder="ご質問やお問い合わせなどご記入ください"></textarea>
    </dd>
  </dl>

  <div id="send-mail">
    <fieldset>
    <p>ここで入力いただいた情報は、Mozilla Japan <a target="_blank" href="http://www.mozilla.jp/legal/privacy/japan/">個人情報保護方針</a> に従って管理し、Mozilla Factory に関するご連絡および Mozilla Japan からの各種ご案内 (イベント告知など) にのみ使用されます。</p>
      <label for="privacy" class="required"><input id="privacy" name="privacy" type="checkbox" value="agree" required />同意する</label><em class="required">（必須）</em>
    </fieldset>
    <input id="submit" name="submit" type="submit" value="確認" />
  </div>
</form>

  </body>
</html>
