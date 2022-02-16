<?php
include_once('initialize.php');
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->AdminUserIsSet))
{
?>
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php
$obj= new ebapps\corporate\corporate();
$obj ->corporate_control();
?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (ebcorporatePages.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?> 
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-corporate.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<?php include_once (ebcorporatePages.'/views/shop/search.php'); ?>
<?php include_once (ebcorporatePages.'/views/shop/carousel.php'); ?>
<section class='contentIndex'>
<?php include_once(ebcorporatePages.'/views/shop/projects.php'); ?>
<?php include (eblayout.'/a-common-ad-body.php'); ?>
</section>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
