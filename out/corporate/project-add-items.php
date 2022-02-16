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
<h2 title='New Project Post'>New Project Post</h2>
</div>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php include_once (ebcorporate.'/corporate.php'); ?>
<script language='javascript' type='text/javascript'>
/* Select B from A */
$(document).ready(function()
{
$("#project_category").change(function()
{
var pic_name = $(this).val();
if(pic_name != '')  
{
$.ajax
({
type: "POST",
url: "project_select_b_from_b.php",
data: "pic_name="+ pic_name,
success: function(option)
{
$("#project_sub_category").html("<option value=''>Please Select</option>"+option);
}
});
}
else
{
$("#project_sub_category").html("<option value=''>Please Select</option>");
}
return false;
});
});

</script>
<?php
$merchant = new ebapps\corporate\corporate();
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$project_category_error = "*";
$project_sub_category_error = "*";
$project_og_image_title_error = "*";
$project_og_image_what_to_do_error = "*";
$project_og_image_how_to_solve_error = "*";
$project_affiliate_link_error = "*";
$project_github_link_error = "*";
$project_preview_link_error = "*";
$project_video_link_error = "*";

?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['project_add_items']))
{
extract($_REQUEST);
/* Form Key*/
if(isset($_REQUEST["form_key"]))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST["form_key"]);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry the server is currently too busy please try again later.</b>";
$error = 1;
}
}
/* project_category */
if (empty($_REQUEST["project_category"]))
{
$project_category_error = "<b class='text-warning'>Category required</b>";
$error =1;
} 
/* valitation project_category  */
elseif (!preg_match("/^([a-zA-Z0-9\-]+)$/",$project_category))
{
$project_category_error = "<b class='text-warning'>Category?</b>";
$error =1;
}
else 
{
$project_category = $sanitization -> test_input($_POST["project_category"]);
}
/* project_sub_category */
if (empty($_REQUEST["project_sub_category"]))
{
$project_sub_category_error = "<b class='text-warning'>Sub category required</b>";
$error =1;
} 
/* valitation project_sub_category  */
elseif (!preg_match("/^([a-zA-Z0-9\-]+)$/",$project_sub_category))
{
$project_sub_category_error = "<b class='text-warning'>Sub Category?</b>";
$error =1;
}
else 
{
$project_sub_category = $sanitization -> test_input($_POST["project_sub_category"]);
}

/* project_og_image_title */
if (empty($_REQUEST["project_og_image_title"]))
{
$project_og_image_title_error = "<b class='text-warning'>Title required</b>";
$error =1;
} 
/* valitation project_og_image_title  Tested allow (productname-productname-product-name)*/
elseif (!preg_match("/^([A-Za-z0-9\?\.\,\-\ ]{19,55})$/",$project_og_image_title))
{
$project_og_image_title_error = "<b class='text-warning'>Single or double quotes, certain special characters are not allowed. Minimum characters 19 maximum characters 55</b>";
$error =1;
}
else 
{
$project_og_image_title = $sanitization -> test_input($_POST["project_og_image_title"]);
}
/* project_og_image_what_to_do */
if (empty($_REQUEST["project_og_image_what_to_do"]))
{

} 
/* valitation project_og_image_what_to_do Tested*/
/* VVI Please Never Allow ~!@#$%^&*(){}[]-+=:;'?/\| */
elseif (!preg_match("/^([a-zA-Z0-9\,\.\?\!\#\-\_\<\>\/\'\"\ ]{3,3000})/",$project_og_image_what_to_do))
{
$project_og_image_what_to_do_error = "<b class='text-warning'>Description ?</b>";
$error =1;
}
else 
{
$project_og_image_what_to_do = $sanitization -> testArea($_POST["project_og_image_what_to_do"]);
}
/* project_og_image_how_to_solve */

if (empty($_REQUEST["project_og_image_how_to_solve"]))
{

} 
/* valitation project_og_image_how_to_solve Tested*/
/* VVI Please Never Allow ~!@#$%^&*(){}[]-+=:;'?/\| */
elseif (!preg_match("/^([a-zA-Z0-9\,\.\?\!\#\-\_\<\>\/\'\"\ ]{3,3000})/",$project_og_image_how_to_solve))
{
$project_og_image_how_to_solve_error = "<b class='text-warning'>Solve description ?</b>";
$error =1;
}
else 
{
$project_og_image_how_to_solve = $sanitization -> testArea($_POST["project_og_image_how_to_solve"]);
}

/* project_affiliate_link */ 
if (!empty($_REQUEST['project_affiliate_link']))
{
/* valitation contents_affiliate_link  */
if (!preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,255})$/',$project_affiliate_link))
{
$project_affiliate_link_error = "<b class='text-warning'>Error on affiliate link</b>";
$error =1;
}

else 
{
$project_affiliate_link = $sanitization -> test_input($_POST['project_affiliate_link']);
}
}
	
/* project_github_link */
if (!empty($_REQUEST['project_github_link']))
{
/* valitation project_github_link  */
if (!preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,255})$/',$project_github_link))
{
$project_github_link_error = "<b class='text-warning'>Error on download link</b>";
$error =1;
}
else 
{
$project_github_link = $sanitization -> test_input($_POST['project_github_link']);
}
} 


/* project_preview_link */
if (!empty($_REQUEST['project_preview_link']))
{
/* valitation project_preview_link  */
if (!preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,255})$/',$project_preview_link))
{
$project_preview_link_error = "<b class='text-warning'>Error on preview link</b>";
$error =1;
}
else 
{
$project_preview_link = $sanitization -> test_input($_POST['project_preview_link']);
}
} 

/* project_video_link */
if (!empty($_REQUEST['project_video_link']))
{
/* valitation project_video_link  */
if (!preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,255})$/',$project_video_link))
{
$project_video_link_error = "<b class='text-warning'>Error on video link</b>";
$error =1;
}
else 
{
$project_video_link = $sanitization -> test_input($_POST['project_video_link']);
}
} 

/* Submition form */
if($error == 0){
extract($_REQUEST);
$merchant->submit_new_project_item($project_category, $project_sub_category, $project_og_image_title, $project_og_image_what_to_do, $project_og_image_how_to_solve, $project_affiliate_link, $project_github_link, $project_preview_link, $project_video_link);
}
//
}
?>
<div class="well">
<form method="post" enctype="multipart/form-data">
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
Select Category: <?php echo $project_category_error;  ?>
<select class='form-control' id='project_category' name='project_category' required autofocus><option value=''>Please Select</option><?php $merchant->select_project_category(); ?></select>
Select Sub Category: <?php echo $project_sub_category_error;  ?>
<select class='form-control' id='project_sub_category' name='project_sub_category' required autofocus><option value=''>Please Select</option></select>
Title/ Item Name: <?php echo $project_og_image_title_error;  ?>
<input class='form-control' type="text" name="project_og_image_title" placeholder="" required autofocus />
What to do: <?php echo $project_og_image_what_to_do_error;  ?>
<textarea class='form-control' name='project_og_image_what_to_do' placeholder="Description" id="WhatToDo"></textarea>
How to do: <?php echo $project_og_image_how_to_solve_error;  ?>
<textarea class="form-control" name="project_og_image_how_to_solve" id="HowToDo"></textarea>
Affiliate link whthout https://www: <?php echo $project_affiliate_link_error;  ?>
<input class='form-control' placeholder="amazon.com/abc/" type="text" name="project_affiliate_link" />
Download link whthout https://www: <?php echo $project_github_link_error;  ?>
<input class='form-control'  placeholder="bacd.com/abcd/" type="text" name="project_github_link" />
Preview link whthout https://www: <?php echo $project_preview_link_error;  ?>
<input class='form-control'  placeholder="bacd.com/abcd/" type="text" name="project_preview_link" />
Video embed link whthout https://www: <?php echo $project_video_link_error;  ?>
<input class='form-control'  placeholder="bacd.com/abcd/" type="text" name="project_video_link" />
<div class='buttons-set'><button type='submit' name='project_add_items' title='Submit' class='button submit'> <span> Submit </span> </button></div>
</fieldset>
</form>
</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("project-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>