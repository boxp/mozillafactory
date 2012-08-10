<?

// debug
$DEBUG = false;
$DEBUG_mail = 'shuntaro@mozilla-japan.org';
if ($_ENV["USER"] == 'dynamis') {
  $DEBUG_mail = 'dynamis@mozilla-japan.org';
}

$testservers = array(
  'local.mozillafactory.org',
  'beta.mozillafactory.org',
  'prod.mozillafactory.org'
);
if (in_array($_SERVER['SERVER_NAME'], $testservers)) {
  $DEBUG = true;
}

// locale and languages
if (!$locale) {
  $locale = 'ja_JP.UTF8';
}
if (!in_array($_SERVER['SERVER_NAME'], $testservers)) {
  if ($locale === 'ja_JP.UTF8')
    $locale = 'ja_JP.UTF-8';
  if ($locale === 'en_US.UTF8')
    $locale = 'en_US.UTF-8';
}
putenv("LANG=$locale");
putenv("LANGUAGE=$locale");
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
$textdomain = 'messages';
bindtextdomain($textdomain, $_SERVER['DOCUMENT_ROOT'] . "/locale");
textdomain($textdomain);
function _e($text) {
  echo _($text);
}

