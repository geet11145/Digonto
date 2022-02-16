<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
session_destroy();
unset($_SESSION['ebusername']);
unset($_SESSION['ebpassword']);
?>
<?php include_once (ebaccess.'/landingPage.php'); ?>