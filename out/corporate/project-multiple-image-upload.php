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
<h2 title='Add Image'>Add Image</h2>
</div> 
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php include_once (ebimageupload.'/uploadimage-corporate-multi.php'); ?>
<?php
if(isset($_REQUEST['submit']))
{
extract($_REQUEST);
$up = new ebapps\upload\uploadimage();
$url_raw = $up -> upload_file('item_picture');
if($url_raw)
{
$project_big_image_url = str_replace(docRoot, domainForImagStore, $url_raw);
$merchant = new ebapps\corporate\corporate();
$merchant->insert_project_multi_image_url($project_id, $project_big_image_url);
}
}
?>

<?php $merchant = new ebapps\corporate\corporate(); $merchant -> select_multi_image_from_project(); ?>
<?php  if($merchant->data >= 1) { foreach($merchant->data as $val){ extract($val); ?>
<div class="well">
<form method='post' enctype='multipart/form-data'>
<fieldset class='group-select'>
Profile Image: .jpg
NB: Image dimensions must be 1024 in pixels
<input type='hidden' name='project_id' value='<?php echo $project_id; ?>'>
<input type='file' required autofocus name='item_picture' />
<div class='buttons-set'><button type='submit' name='submit' title='Add Screenshot' class='button submit'> <span> Add Screenshot </span> </button></div>
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