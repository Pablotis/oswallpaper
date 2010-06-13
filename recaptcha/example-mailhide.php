<html><body>
<?
require_once ("recaptchalib.php");

// get a key at http://mailhide.recaptcha.net/apikey
$mailhide_pubkey = "6LfAaQUAAAAAABQSn55UD9YI0tTQuOz5FKMU1FN_";
$mailhide_privkey = "6LfAaQUAAAAAAFLjwdHhyE0far6dtE6v4_at1AHb";

?>

The Mailhide version of example@example.com is
<? echo recaptcha_mailhide_html ($mailhide_pubkey, $mailhide_privkey, "example@example.com"); ?>. <br>

The url for the email is:
<? echo recaptcha_mailhide_url ($mailhide_pubkey, $mailhide_privkey, "example@example.com"); ?> <br>

</body></html>
