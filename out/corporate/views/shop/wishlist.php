<?php include_once (eblayout.'/a-common-header-meta-scripts-text-editor.php'); ?>
<?php include_once (eblogin."/session.inc.php"); ?>
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
<?php include_once (ebaccess."/access_permission_online_minimum.php"); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad-left.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Wishlist'>Wishlist</h2>
</div>
<?php $obj= new ebapps\corporate\corporate(); $obj -> CorporateLikeAll();
if($obj->data > 0)
{
foreach($obj->data as $val): extract($val);
$likeList ="<div class='row'>";
$likeList .="<div class='col-xs-12 col-md-4'>";
$likeList .="<b><a title='".ucfirst($project_og_image_title)."' href='";
$likeList .= outCorporateLink."/project/details/$project_id/$project_category/$project_sub_category/";
$likeList .="'>";
$likeList .=ucfirst($project_og_image_title);
$likeList .="</a></b>";
$likeList .="<br>";
$likeList .="<a title='".ucfirst($project_og_image_title)."' href='";
$likeList .= outCorporateLink."/project/details/$project_id/$project_category/$project_sub_category/";
$likeList .="'>";
if(!empty($project_og_image_url)){
$likeList .="<img class='img-responsive' alt='".ucfirst($project_og_image_title)."' src='";
$likeList .=hypertextWithOrWithoutWww."$project_og_image_url";
$likeList .="'>";
}
$likeList .="</a>";
$likeList .="<br>";
//
$countComment = new ebapps\corporate\corporate();
$countComment ->count_total_like_corporate($project_id);
if($countComment->data)
{
foreach($countComment->data as $valcountComment): extract($valcountComment);
$likeList .="<i class='fa fa-heart'></i>  ";
$likeList .=$totalPostLikes;
endforeach;
}
$likeList .="</div>";
//
$likeList .="<div class='col-xs-12 col-md-8'>";
$likeList .=ucfirst($project_og_image_what_to_do);
$likeList .="</div>";
$likeList .="</div>";
echo $likeList;
endforeach;
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("project-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>