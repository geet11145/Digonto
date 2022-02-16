<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (ebcorporatePages.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php
$obj= new ebapps\corporate\corporate();
$obj ->corporate_control();
?>