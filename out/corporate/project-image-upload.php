<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-text-editor.php'); ?>
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
<?php include_once (ebaccess.'/access_permission_staff_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Add Image'>Profile Image:</h2>
</div>
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php include_once (ebimageupload.'/uploadimage-corporate.php'); ?>
<?php
if(isset($_REQUEST['submit']))
{
extract($_REQUEST);
$merchant_small = new ebapps\corporate\corporate();
$up = new ebapps\upload\uploadimage();
$url_raw_small = $up -> upload_file_small('item_picture');
/* Change it later with your cpanel login username and hostname*/
$project_og_small_image_url = str_replace(docRoot, domainForImagStore, $url_raw_small);
$merchant_small->updates_project_small_image_url($project_id,$project_og_small_image_url);
//
$merchant = new ebapps\corporate\corporate();
$up = new ebapps\upload\uploadimage();
$url_raw = $up -> upload_file('item_picture');
/* Change it later with your cpanel login username and hostname*/
if($url_raw)
{
$project_og_image_url = str_replace(docRoot, domainForImagStore, $url_raw);
$merchant->updates_project_image_url($project_id,$project_og_image_url);
}
}
?>
<?php $merchant = new ebapps\corporate\corporate(); $merchant -> select_image_from_project(); ?>
<?php  if($merchant->data >= 1) { foreach($merchant->data as $val){ extract($val); ?>
<div class="well">
<form method='post' enctype='multipart/form-data'>
<fieldset class='group-select'>
Profile Image: .jpg
NB: Image dimensions must be 1024x717 in pixels
<input type='hidden' name='project_id' value='<?php echo $project_id; ?>'>
<input type='file' required autofocus name='item_picture' />
<div class='buttons-set'><button type='submit' name='submit' title='Submit' class='button submit'> <span> Submit </span> </button></div>
</fieldset>
</form>
</div>
<?php } } ?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("project-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>