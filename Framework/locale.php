<?php
// $user_locale = 'en_US';
$user_locale = 'es_MX';

putenv("LANGUAGE=$user_locale");
putenv("LANG=$user_locale");  // Por si LANGUAGE falla

if (!defined('LC_MESSAGES')) define('LC_MESSAGES', 5);
setlocale(LC_MESSAGES, $user_locale);

bindtextdomain("translate", "./locale");
textdomain("translate");