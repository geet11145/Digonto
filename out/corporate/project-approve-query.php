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
<h2 title='Comments'>Comments</h2>
</div>
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php
if(isset($_REQUEST['option_project_approve']))
{
extract($_REQUEST);
$obj=new ebapps\corporate\corporate();
$obj->approve_project_query_admin($eb_corporates_comments_id, $eb_corporates_id_in_comments, $eb_corporates_comment_details);
}
?>
<?php
if(isset($_REQUEST['option_project_delete']))
{
extract($_REQUEST);
$obj=new ebapps\corporate\corporate();
$obj->delete_project_query_admin($eb_corporates_comments_id,$eb_corporates_comment_details);
}
?>
<?php
$obj = new ebapps\corporate\corporate();
$obj->read_all_project_query_admin();
if($obj->data >= 1)
{
foreach($obj->data as $val)
{
extract($val);

$queryMe ="By $eb_corporates_username on $eb_corporates_comment_date";
$queryMe .="<pre>"; 
$queryMe .="<form method='post'>";
$queryMe .="<input type='hidden' name='eb_corporates_comments_id' value='$eb_corporates_comments_id' />"; 
$queryMe .="<input type='hidden' name='eb_corporates_id_in_comments' value='$eb_corporates_id_in_comments' />"; 
$queryMe .="<textarea class='form-control' name='eb_corporates_comment_details' rows='6' placeholder='Description' required autofocus>$eb_corporates_comment_details</textarea>";
$queryMe .="<input type='submit' class='btn btn-eb-cart btn-lg gradient' name='option_project_approve' value='Approve'  />"; 
$queryMe .="<input type='submit' class='btn btn-eb-cart btn-lg gradient' name='option_project_delete' value='Delete'  />"; 
$queryMe .="</form>"; 
$queryMe .="</pre>"; 
echo $queryMe;  
}
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("project-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>