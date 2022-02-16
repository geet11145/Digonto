<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (ebcontents.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?> 
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblogin."/session.inc.php"); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
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
<h2 title='Likelist'>Likelist</h2>
</div>
<?php $obj= new ebapps\blog\blog(); $obj -> contentsLikeAll();
if($obj->data > 0)
{
foreach($obj->data as $val): extract($val);
$likeList ="<div class='row'>";
$likeList .="<div class='col-xs-12 col-md-4'>";
$likeList .="<b><a title='".ucfirst($contents_og_image_title)."' href='";
$likeList .=outContentsLink."/contents/details/$contents_id/$contents_category/$contents_sub_category/";
$likeList .="'>";
$likeList .=ucfirst($contents_og_image_title);
$likeList .="</a></b>";
$likeList .="<br>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$contents_og_small_image_url))) {
$likeList .="<a title='".ucfirst($contents_og_image_title)."' href='";
$likeList .=outContentsLink."/contents/details/$contents_id/$contents_category/$contents_sub_category/";
$likeList .="'>";
$likeList .="<img class='img-responsive' alt='".ucfirst( $contents_og_image_title )."' src='";
$likeList .=hypertextWithOrWithoutWww."$contents_og_small_image_url";
$likeList .="'>";
$likeList .="</a>";
$likeList .="<br>";
}
//
$countComment = new ebapps\blog\blog();
$countComment ->count_total_like($contents_id);
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
$likeList .=ucfirst($contents_og_image_what_to_do);
$likeList .="</div>";
$likeList .="</div>";
echo $likeList;
endforeach;
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("contents-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
