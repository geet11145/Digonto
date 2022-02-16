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
<?php include_once (ebaccess.'/access_permission_admin_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Approval'>Approval</h2>
</div> 
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php

if(isset($_REQUEST['approve_project_items']))
{
extract($_REQUEST);
$obj=new ebapps\corporate\corporate();
$obj->approve_project_items($project_id);
}
?>
<?php
if(isset($_REQUEST['notSercicesApproved']))
{
extract($_REQUEST);
$obj=new ebapps\corporate\corporate();
$obj->notSercicesApproved($project_id, $project_og_image_url);
$obj=new ebapps\corporate\corporate();
$obj->notSercicesApproved_small($project_id, $project_og_small_image_url);
}
?>
<?php

if(isset($_REQUEST['reject_corporates_item']))
{
extract($_REQUEST);
$obj=new ebapps\corporate\corporate();
$obj->delete_project_items($project_id, $project_og_image_url);
$obj=new ebapps\corporate\corporate();
$obj->delete_project_small_items($project_id, $project_og_small_image_url);
$obj->delete_project_items_multi_image($project_id);
}
?>
<?php
////////// Multi IMAGE////////////////
if(isset($_REQUEST['approve_the_image_corporates']))
{
extract($_REQUEST);
$obj = new ebapps\corporate\corporate();
$obj->approve_the_image_corporates($project_id,$eb_corporate_multi_image_id);
}
?>

<?php
if(isset($_REQUEST['reject_the_image_corporates']))
{
extract($_REQUEST);
$obj = new ebapps\corporate\corporate();
$obj->reject_the_image_corporates($eb_corporate_multi_image_id, $eb_corporate_big_imag_url);
}
?>
<?php
$obj = new ebapps\corporate\corporate();
$obj->admin_project_view_items();
if($obj->data >= 1)
{
$projectviewitems ="<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
foreach($obj->data as $val)
{
extract($val);
$projectviewitems .="<div class='panel panel-default'>";
$projectviewitems .="<div class='panel-heading' role='tab' id='heading".$project_id."'>";
$projectviewitems .="<h3 class='panel-title'> <a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#collapse".$project_id."' aria-expanded='false' aria-controls='collapse".$project_id."'>";

//
$projectviewitems .="<div class='row'>";
$projectviewitems .="<div class='col-xs-12 col-md-12'>";
//
$projectviewitems .="<div class='row'>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$project_og_image_url)))
{
$projectviewitems .="<div class='col-xs-12 col-md-3'><img class='img-responsive' src='".hypertextWithOrWithoutWww."$project_og_image_url' /></div>";
}
else
{
$projectviewitems .="<div class='col-xs-12 col-md-3'><img class='img-responsive' src='".themeResource."/images/blankImage.jpg' /></div>";
}
$projectviewitems .="<div class='col-xs-12 col-md-9'>";
if($project_approved==0)
{
$projectviewitems .="<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i> REVIEWING <br>";
}
if($project_approved==1)
{
$projectviewitems .="<i class='fa fa-check-circle fa-lg' aria-hidden='true'></i> PUBLISHED <br>";
}
$projectviewitems .="<b>Title: ".ucfirst($project_og_image_title)."</b><br>";
$projectviewitems .="<b>".ucfirst($obj->visulString($project_category))." <i class='fa fa-angle-double-right' aria-hidden='true'></i> ".ucfirst($obj->visulString($project_sub_category))."</b><br>";
$projectviewitems .="<b>ID: $project_id</b>";
$projectviewitems .="</div>"; 
$projectviewitems .="</div>";
//
$projectviewitems .="</div>";
$projectviewitems .="</div>";
//
$projectviewitems .="</a>";
$projectviewitems .="</h3>";

$projectviewitems .="</div>";
$projectviewitems .="<div id='collapse".$project_id."' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading".$project_id."'>";
//
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Corporate provider:</div><div class='col-xs-12 col-md-9'>$username_project</div></div>";
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Title:</div><div class='col-xs-12 col-md-9'>".ucfirst($project_og_image_title)."</div></div>";
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Category:</div><div class='col-xs-12 col-md-9'>".ucfirst($obj->visulString($project_category))."</div></div>";
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Sub Category:</div><div class='col-xs-12 col-md-9'>".ucfirst($obj->visulString($project_sub_category))."</div></div>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$project_og_image_url)))
{
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Profile Image:</div><div class='col-xs-12 col-md-9'><img src='".hypertextWithOrWithoutWww."$project_og_image_url' width='100%' /></div></div>";
}
/**/
if(!empty($project_id))
{
$objmulti = new ebapps\corporate\corporate();
$objmulti ->project_multi_img_admin_review($project_id);
if($objmulti->data > 0)
{
foreach($objmulti->data as $valmulti)
{
extract($valmulti);
if(hypertextWithOrWithoutWww.$eb_corporate_big_imag_url){
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'><b>Screenshot</b></div><div class='col-xs-12 col-md-9'>";
$projectviewitems .="<img src='".hypertextWithOrWithoutWww."$eb_corporate_big_imag_url' width='100%' />";

if($eb_corporate_image_approved==0){
$projectviewitems .="<a class='btn btn-sm btn-warning' role='button'>NOT APPROVED SCREENSHOT</a><form method='post'><input type='hidden' name='project_id' value='$project_id' /><input type='hidden' name='eb_corporate_multi_image_id' value='$eb_corporate_multi_image_id' /><div class='buttons-set'><button type='submit' name='approve_the_image_corporates' title='APPROVE THE SCREENSHOT' class='button submit'> <span> APPROVE THE SCREENSHOT </span> </button></div></form><form method='post'><input type='hidden' name='eb_corporate_multi_image_id' value='$eb_corporate_multi_image_id' /><input type='hidden' name='eb_corporate_big_imag_url' value='$eb_corporate_big_imag_url' /><div class='buttons-set'><button type='submit' name='reject_the_image_corporates' title='REJECT THE SCREENSHOT' class='button submit'> <span> REJECT THE SCREENSHOT </span> </button></div></form>";
}
if($eb_corporate_image_approved==1){
$projectviewitems .="<a class='btn btn-sm btn-success' role='button'>APPROVED SCREENSHOT</a><form method='post'><input type='hidden' name='eb_corporate_multi_image_id' value='$eb_corporate_multi_image_id' /><input type='hidden' name='eb_corporate_big_imag_url' value='$eb_corporate_big_imag_url' /><div class='buttons-set'><button type='submit' name='reject_the_image_corporates' title='REJECT THE SCREENSHOT' class='button submit'> <span> REJECT THE SCREENSHOT </span> </button></div></form>";
}

$projectviewitems .="</div></div>";
}
}
}
}
/**/
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>What to do:</div><div class='col-xs-12 col-md-9'>".ucfirst($project_og_image_what_to_do)."</div></div>";
if(!empty($project_og_image_how_to_solve)){
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>How to do:</div><div class='col-xs-12 col-md-9'>".ucfirst($project_og_image_how_to_solve)."</div></div>";
}
if(!empty($project_affiliate_link)){
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Affiliate Link:</div><div class='col-xs-12 col-md-9'><p><a rel='nofollow' href='".hypertextWithOrWithoutWww."$project_affiliate_link' target='_blank'><button type='button' class='button submit' title='Visit'><span> Visit </span></button></a></p>
</div></div>";
}
if(!empty($project_github_link)){
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Download Link:</div><div class='col-xs-12 col-md-9'><p><a rel='nofollow' href='".hypertextWithOrWithoutWww."$project_github_link' target='_blank'><button type='button' class='button submit' title='Preview'><span> Download </span></button></a></p>
</div></div>";
}
if(!empty($project_preview_link)){
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Preview Link:</div><div class='col-xs-12 col-md-9'>
<p><a rel='nofollow' href='".hypertextWithOrWithoutWww."$project_preview_link' target='_blank'><button type='button' class='button submit' title='Preview'><span> Download </span></button></a></p></div></div>";
}
if(!empty($project_video_link)){
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Video:</div>";
$projectviewitems .="<div class='col-xs-12 col-md-9'>";
$projectviewitems .="<div class='bs-example' data-example-id='responsive-embed-16by9-iframe-youtube'>";
$projectviewitems .="<div class='embed-responsive embed-responsive-16by9'>";
$projectviewitems .="<iframe class='embed-responsive-item' src='".hypertextWithOrWithoutWww."$project_video_link' allowfullscreen=''>";
$projectviewitems .="</iframe>";
$projectviewitems .="</div>";
$projectviewitems .="</div>";
$projectviewitems .="</div>";
$projectviewitems .="</div>";
}
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Submit Date:</div><div class='col-xs-12 col-md-9'>$project_date</div></div>";

if(!empty($project_og_image_url) and $project_approved != 1)
{
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>OPTION:</div><div class='col-xs-12 col-md-9'><form method='post'><input type='hidden' name='project_id' value='$project_id' /><div class='buttons-set'><button type='submit' name='approve_project_items' title='PUBLISH' class='button submit'> <span> PUBLISH </span> </button></div></form></div></div>";
}
$projectviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>OPTION:</div><div class='col-xs-12 col-md-9'><form method='post'><input type='hidden' name='project_id' value='$project_id' /><input type='hidden' name='project_og_image_url' value='$project_og_image_url' /><input type='hidden' name='project_og_small_image_url' value='$project_og_small_image_url' /><div class='buttons-set'><button type='submit' name='notSercicesApproved' title='Not Approved' class='button submit'> <span> Not Approved </span> </button></div></form><form method='post'><input type='hidden' name='project_id' value='$project_id' /><input type='hidden' name='project_og_image_url' value='$project_og_image_url' /><input type='hidden' name='project_og_small_image_url' value='$project_og_small_image_url' /><div class='buttons-set'><button type='submit' name='reject_corporates_item' title='REJECT' class='button submit'> <span> REJECT </span> </button></div></form></div></div>";
//
$projectviewitems .="</div>";
$projectviewitems .="</div>";
}

$projectviewitems .="</div>";
echo $projectviewitems;
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("project-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>