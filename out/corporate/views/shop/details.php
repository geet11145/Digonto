<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-corporate.php'); ?>
    </div>
  </div>
</nav>
<?php include_once('breadcrumbs.php'); ?>
<?php include_once('post-multi-carosoul.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad-left.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<?php include_once("post-header.php"); ?>
<?php include_once (eblayout."/a-common-ad-content-col-7-body.php"); ?>
<?php include_once("post-details.php"); ?>
</div>
<div class='col-right sidebar col-md-3 col-xs-12'>
<?php include_once('rightWidgetForCategory.php'); ?>
<?php include_once("rightWidgetForPost.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>


