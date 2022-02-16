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
<h2 title='Post Status'>Post Status</h2>
</div>
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php

if(isset($_REQUEST['delete_project_items']))
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

if(isset($_REQUEST['DeleteScreenshots']))
{
extract($_REQUEST);
$obj=new ebapps\corporate\corporate();
$obj->deleteScreenShootMerchantcorporates($eb_corporate_multi_image_id, $eb_corporate_id_in_multi_img, $eb_corporate_big_imag_url);
}
?>
<?php
$obj=new ebapps\corporate\corporate();
$obj->project_view_items();
if($obj->data >= 1)
{
$solutionStatus ="<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
foreach($obj->data as $val)
{
extract($val);
$solutionStatus .= "<div class='panel panel-default'>";
$solutionStatus .= "<div class='panel-heading' role='tab' id='heading".$project_id."'>";
$solutionStatus .= "<h3 class='panel-title'> <a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#collapse".$project_id."' aria-expanded='false' aria-controls='collapse".$project_id."'>";
//
$solutionStatus .= "<div class='row'>";
$solutionStatus .= "<div class='col-xs-12 col-md-12'>";
//
$solutionStatus .= "<div class='row'>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$project_og_image_url)))
{
$solutionStatus .= "<div class='col-xs-12 col-md-3'><img class='img-responsive' src='".hypertextWithOrWithoutWww."$project_og_image_url' /></div>";
}
else
{
$solutionStatus .= "<div class='col-xs-12 col-md-3'><img class='img-responsive' src='".themeResource."/images/blankImage.jpg' /></div>";
}
$solutionStatus .= "<div class='col-xs-12 col-md-9'>";
if($project_approved==0){
$solutionStatus .= "<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i> REVIEWING <br>";
}
if($project_approved==1){
$solutionStatus .= "<i class='fa fa-check-circle fa-lg' aria-hidden='true'></i> PUBLISHED <br>";
}
$solutionStatus .= "<b>Title: ".ucfirst($project_og_image_title)."</b><br>";
$solutionStatus .= "<b>".ucfirst($obj->visulString($project_category))." <i class='fa fa-angle-double-right' aria-hidden='true'></i> ".ucfirst($obj->visulString($project_sub_category))."</b><br>";
$solutionStatus .= "<b>ID: $project_id</b>";
$solutionStatus .= "</div>"; 
$solutionStatus .= "</div>";
//
$solutionStatus .= "</div>";
$solutionStatus .= "</div>";
//
$solutionStatus .= "</a>";
$solutionStatus .= "</div>";
$solutionStatus .= "<div id='collapse".$project_id."' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading".$project_id."'>";
//
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Title:</div><div class='col-xs-12 col-md-9'>".ucfirst($project_og_image_title)."</div></div>";
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Category:</div><div class='col-xs-12 col-md-9'>".ucfirst($obj->visulString($project_category))."</div></div>";
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Sub Category:</div><div class='col-xs-12 col-md-9'>".ucfirst($obj->visulString($project_sub_category))."</div></div>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$project_og_image_url)))
{
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Profile Image:</div><div class='col-xs-12 col-md-9'>";
$solutionStatus .= "<img src='".hypertextWithOrWithoutWww."$project_og_image_url' class='img-responsive' />";
$solutionStatus .= "</div></div>";
}
else
{
/* Do not use, it will not remove the image */
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Upload Profile Image:</div><div class='col-xs-12 col-md-9'><form action='project-image-upload.php' method='post'><input type='hidden' name='project_id' value='$project_id' /><div class='buttons-set'><button type='submit' name='upload_image' title='Upload Profile Image' class='button submit'> <span> Upload Profile Image </span> </button></div></form></div></div>";
}

/**/
if(!empty($project_id))
{
$objmulti = new ebapps\corporate\corporate();
$objmulti ->project_multi_img($project_id);
if($objmulti->data > 0)
{
foreach($objmulti->data as $valmulti)
{
extract($valmulti);
if($eb_corporate_image_approved==1){
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Screenshots:</div><div class='col-xs-12 col-md-9'>";
$solutionStatus .= "<img src='".hypertextWithOrWithoutWww."$eb_corporate_big_imag_url' class='img-responsive' />";
$solutionStatus .= "<form method='post'><input type='hidden' name='eb_corporate_multi_image_id' value='$eb_corporate_multi_image_id' /><input type='hidden' name='eb_corporate_id_in_multi_img' value='$eb_corporate_id_in_multi_img' /><input type='hidden' name='eb_corporate_big_imag_url' value='$eb_corporate_big_imag_url' /><button type='submit' name='DeleteScreenshots' title='Delete Screenshots' class='button submit'> <span> Delete Screenshots </span> </button></form>";
$solutionStatus .= "</div></div>";
}
}
}
}

if($project_approved==1)
{
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Upload Screenshots:</div><div class='col-xs-12 col-md-9'><form action='project-multiple-image-upload.php' method='post'><input type='hidden' name='project_id' value='$project_id' /><div class='buttons-set'><button type='submit' name='project_upload_image' title='Add Screenshot' class='button submit'> <span> Add Screenshot </span> </button></div></form></div></div>";
}
/**/
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>What to do:</div><div class='col-xs-12 col-md-9'>".ucfirst($project_og_image_what_to_do)."</div></div>";
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>How to do:</div><div class='col-xs-12 col-md-9'>".ucfirst($project_og_image_how_to_solve)."</div></div>";

	
if(!empty($project_affiliate_link))
{
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Affiliate Link:</div><div class='col-xs-12 col-md-9'>";
$solutionStatus .= "<p><a rel='nofollow' href='".hypertextWithOrWithoutWww."$project_affiliate_link' target='_blank'><button type='button' class='button submit' title='Affiliate Link'><span> Visit </span></button></a></p>";
$solutionStatus .= "</div></div>";
}


if(!empty($project_github_link))
{
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Download:</div><div class='col-xs-12 col-md-9'>";
$solutionStatus .= "<p><a rel='nofollow' href='".hypertextWithOrWithoutWww."$project_github_link' target='_blank'><button type='button' class='button submit' title='Preview'><span> Download </span></button></a></p>";
$solutionStatus .= "</div></div>";
}

if(!empty($project_preview_link)){
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Preview:</div><div class='col-xs-12 col-md-9'>";
$solutionStatus .= "<p><a rel='nofollow' href='".hypertextWithOrWithoutWww."$project_preview_link' target='_blank'><button type='button' class='button submit' title='Preview'><span> Preview </span></button></a></p>";
$solutionStatus .= "</div></div>";
}

if(!empty($project_video_link))
{
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Solution Video:</div><div class='col-xs-12 col-md-9'>";
$solutionStatus .="<div class='bs-example' data-example-id='responsive-embed-16by9-iframe-youtube'>";
$solutionStatus .="<div class='embed-responsive embed-responsive-16by9'>";
$solutionStatus .="<iframe class='embed-responsive-item' src='".hypertextWithOrWithoutWww."$project_video_link' allowfullscreen=''>";
$solutionStatus .="</iframe>";
$solutionStatus .="</div>";
$solutionStatus .="</div>";
$solutionStatus .= "</div></div>";
}

$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Upload Date:</div><div class='col-xs-12 col-md-9'>$project_date</div></div>";
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>OPTION:</div><div class='col-xs-12 col-md-9'>";
$solutionStatus .= "<form action='project-add-items_edit.php' method='get'><input type='hidden' name='username_project' value='$username_project' /><input type='hidden' name='project_id' value='$project_id' /><div class='buttons-set'><button type='submit' title='EDIT' class='button submit'> <span> EDIT </span> </button></div></form>";
$solutionStatus .= "</div></div>";
if(empty($project_approved))
{
$solutionStatus .= "<div class='row'><div class='col-xs-12 col-md-3'>Delete:</div><div class='col-xs-12 col-md-9'><form method='post'><input type='hidden' name='project_id' value='$project_id' /><input type='hidden' name='project_og_image_url' value='$project_og_image_url' /><input type='hidden' name='project_og_small_image_url' value='$project_og_small_image_url' /><div class='buttons-set'><button type='submit' name='delete_project_items' title='Delete' class='button submit'> <span> Delete </span> </button></div></form></div></div>";
}
//
$solutionStatus .= "</div>";
$solutionStatus .= "</div>";
}
$solutionStatus .= "</div>";
echo $solutionStatus;
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("project-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?> 