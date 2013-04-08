<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <meta name="robots" content="nofollow, noindex" />
    <link rel="canonical" href="http://www.mozillafactory.org/ja/contact/">
    <link rel="stylesheet" type="text/css" href="../css/form.css"/>
  </head>
  <body>

<form id="contact-form" action="confirm.php" method="POST">
  <dl>
    <dt>
       <label for="subject" class="required">Subject</label>
    </dt>
    <dd>
      <select id="subject" name="subject" required>
        <option value="Apply for a project">Apply for a project</option>
        <option value="Apply for an event">Apply for an event</option>
        <option value="Questions for Mozilla Factory">Questions for Mozilla Factory</option>
        <option value="Become a supporter">Become a supporter</option>
        <option value="Other">Other</option>
      </select>
    </dd>

    <dt>
      <label for="title">Project or event you wish to apply for (if applicable)</label>
    </dt>
    <dd>
      <input id="title" name="title" type="text"/>
    </dd>

    <dt>
      <label for="name" class="required">Name</label><em class="required">(required)</em>
    </dt>
    <dd>
      <input id="name" name="name" type="text" required />
    </dd>

    <dt>
      <label for="email" class="required">E-mail address</label><em class="required">(required)</em>
    </dt>
    <dd>
      <input id="email" name="email" type="email" required />
    </dd>

    <dt>
      <label for="age">Age</label>
    </dt>
    <dd>
      <input id="age" name="age" type="number" />
    </dd>

    <dt>
      <label for="organization">Name of school or organization</label>
    </dt>
    <dd>
      <input id="organization" name="organization" type="text" />
    </dd>

    <dt>
      <label for="request">Things you wish to do at Mozilla Factory, or things you wish for Mozilla Factory to do in the near future</label>
    </dt>
    <dd>
      <textarea id="request" name="request" rows="5"></textarea>
    </dd>

    <dt>
      <label for="comment">Message</label>
    </dt>
    <dd>
      <textarea id="comment" name="comment" rows="5"></textarea>
    </dd>
  </dl>

  <div id="send-mail">
    <fieldset>
      <p>We respect your privacy and entered information will be handled properly according to our privacy policy. Your contact information will be used for Mozilla Factory to contact you and to notify you about any future promotions of Mozilla Factory.</p>
      <label for="privacy" class="required"><input id="privacy" name="privacy" type="checkbox" value="agree" required />Agree</label><em class="required">(required)</em>
    </fieldset>
    <input id="submit" name="submit" type="submit" value="confirm" />
  </div>
</form>

  </body>
</html>
