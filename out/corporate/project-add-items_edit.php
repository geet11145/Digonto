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
<div class='well'>
<h2 title='Edit Post'>Edit Post</h2>
</div>
<?php include_once (ebcorporate.'/corporate.php'); ?> 
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
if(isset($_REQUEST['option_project_edit']))
{
extract($_REQUEST);
$obj=new ebapps\corporate\corporate();
$obj->edit_select_project_item();
}
?>
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
$project_og_image_title_error = '*';
$project_og_image_what_to_do_error = '*';
$project_og_image_how_to_solve_error = '*';
$project_affiliate_link_error = '*';
$project_github_link_error = '*';
$project_preview_link_error = '*';
$project_video_link_error = '*';
$captcha_error = "*";

?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['project_edit']))
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
if (empty($_REQUEST['project_og_image_title']))
{
$project_og_image_title_error = "<b class='text-warning'>Title required</b>";
$error =1;
} 
/* valitation project_og_image_title  Tested allow (productname-productname-product-name)*/
elseif (!preg_match('/^([A-Za-z0-9\?\.\,\-\ ]{19,55})$/',$project_og_image_title))
{
$project_og_image_title_error = "<b class='text-warning'>Single or double quotes, certain special characters are not allowed. Minimum characters 19 maximum characters 55</b>";
$error =1;
}
else 
{
$project_og_image_title = $sanitization -> test_input($_POST['project_og_image_title']);
}
/* project_og_image_what_to_do */
if (empty($_REQUEST['project_og_image_what_to_do']))
{

} 
/* valitation project_og_image_what_to_do Tested*/
elseif (!preg_match("/^([a-zA-Z0-9\,\.\?\!\#\-\_\<\>\/\'\"\ ]{3,3000})/",$project_og_image_what_to_do))
{
$project_og_image_what_to_do_error = "<b class='text-warning'>Description upper lower letters and numbers 3-5000 are allowed</b>";
$error =1;
}
else 
{
$project_og_image_what_to_do = $sanitization -> testArea($_POST['project_og_image_what_to_do']);
}
/* project_og_image_how_to_solve */
if (empty($_REQUEST['project_og_image_how_to_solve']))
{

} 
elseif (!preg_match("/^([a-zA-Z0-9\,\.\?\!\#\-\_\<\>\/\'\"\ ]{3,3000})/",$project_og_image_how_to_solve))
{
$project_og_image_how_to_solve_error = "<b class='text-warning'>Description upper lower letters and numbers 3-5000 are allowed</b>";
$error =1;
}
else 
{
$project_og_image_how_to_solve = $sanitization -> testArea($_POST['project_og_image_how_to_solve']);
}

/* project_affiliate_link */ 
if (!empty($_REQUEST['project_affiliate_link']))
{
/* valitation project_affiliate_link  */
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

/* Captcha */
if (empty($_REQUEST['answer']))
{
$captcha_error = "<b class='text-warning'>Captcha required</b>";
$error =1;
}
elseif (isset($_SESSION['captcha']) and $_POST['answer'] !==$_SESSION['captcha'])
{
unset($_SESSION['captcha']);
$captcha_error = "<b class='text-warning'>Captcha?</b>";
$error =1;
}
else
{
$sanitization->test_input($_POST['answer']);
}

/* Submition form */
if($error == 0){
extract($_REQUEST);
$merchant->edit_update_project_item($project_id, $username_project, $project_approved, $project_category, $project_sub_category, $project_og_image_title,$project_og_image_what_to_do,$project_og_image_how_to_solve, $project_affiliate_link, $project_github_link,$project_preview_link,$project_video_link);
}
//
}
?>
<div class='well'>
<?php
$obj = new ebapps\corporate\corporate();
$obj->edit_select_project_item($project_id,$username_project);
if($obj->data >= 1)
{
foreach($obj->data as $val)
{
extract($val);
$updateproject ="<form method='post' enctype='multipart/form-data'>"; 
$updateproject .="<fieldset class='group-select'>";
$updateproject .="<input type='hidden' name='form_key' value='";
$updateproject .= $formKey->outputKey(); 
$updateproject .="'>"; 
$updateproject .="$formKey_error";
$updateproject .="Title: $project_og_image_title_error";
$updateproject .="<input class='form-control' type='text' name='project_og_image_title' value='$project_og_image_title' placeholder='Clipping Path' required autofocus />";
$updateproject .="Select Category: $project_category_error "; 
$updateproject .="<select class='form-control' id='project_category' name='project_category' required autofocus><option value='$project_category'>".$obj->visulString($project_category)."</option>"; 
$obj = new ebapps\corporate\corporate();
$obj->edit_select_project_category();
if($obj->data >= 1)
{
foreach($obj->data as $val)
{
extract($val);
$updateproject .="<option value='$project_category'>".ucfirst($obj->visulString($project_category))."</option>"; 
}
}
$updateproject .="</select>"; 
$updateproject .="Selected Sub Category: $project_sub_category_error"; 
$updateproject .="<select class='form-control' id='project_sub_category' name='project_sub_category' required autofocus><option value='$project_sub_category'>$project_sub_category</option></select>";
$updateproject .="What to do: $project_og_image_what_to_do_error";
$updateproject .="<textarea class='form-control' class='well' name='project_og_image_what_to_do' id='WhatToDo'>$project_og_image_what_to_do</textarea>";
$updateproject .="How to do: $project_og_image_how_to_solve_error";

$updateproject .="<textarea class='form-control' name='project_og_image_how_to_solve' id='HowToDo'>$project_og_image_how_to_solve</textarea>";

$updateproject .="Affiliate link whthout https://www: $project_affiliate_link";
$updateproject .="<input class='form-control' type='text' name='project_affiliate_link' value='$project_affiliate_link' />";
	
$updateproject .="Download link whthout https://www: $project_github_link_error";
$updateproject .="<input class='form-control' type='text' name='project_github_link' value='$project_github_link' />";
$updateproject .="Preview link whthout https://www: $project_preview_link_error";
$updateproject .="<input class='form-control' type='text' name='project_preview_link' value='$project_preview_link' />";
$updateproject .="Video embed link whthout https://www: $project_video_link_error";
$updateproject .="<input class='form-control' type='text' name='project_video_link' value='$project_video_link'/>";
//
$updateproject .="Captcha: ";
$updateproject .= $captcha_error;
include_once(ebfromeb.'/captcha.php');
$cap = new ebapps\captcha\captchaClass();	
$captcha = $cap -> captchaFun();
$updateproject .="<b class='btn btn-Captcha btn-sm gradient'>$captcha</b>";
$updateproject .="<input class='form-control' type='text' name='answer' placeholder='Enter captcha' />";
//   
$updateproject .="<input type='hidden' class='btn btn-eb-cart btn-lg gradient' name='project_approved' value='$project_approved' /><div class='buttons-set'><button type='submit' name='project_edit' title='Submit' class='button submit'> <span> Submit </span> </button></div>"; 
$updateproject .="</fieldset>";
$updateproject .="</form>";
echo $updateproject;  
}
}
?>

</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("project-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>