<?php
$searchobj= new ebapps\corporate\corporate();
$searchobj -> project_thurmnail_group($username_project);
if($searchobj->data)
{
$newSearch ="<div class='content-page'>";
$newSearch .="<div class='container'>"; 
$newSearch .="<div class='category-product'>";
$newSearch .="<div class='navbar nav-menu'>";
$newSearch .="<div class='navbar-collapse'>";
$newSearch .="<ul class='nav navbar-nav'>";
$newSearch .="<li>";
$newSearch .="<div class='new_title'>";
$newSearch .="<h2>".strtoupper($username_project)."</h2>";
$newSearch .="</div>";
$newSearch .="</li>";

$newSearch .="</ul>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="<div class='product-bestseller'>";
$newSearch .="<div class='product-bestseller-content'>";
$newSearch .="<div class='product-bestseller-list'>";
$newSearch .="<div class='tab-container'>";

$newSearch .="<div class='tab-panel active'>";
$newSearch .="<div class='category-products'>";
$newSearch .="<ul class='products-grid'>";
foreach($searchobj->data as $vaLsearchobj): extract($vaLsearchobj);

$newSearch .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-6'>";
$newSearch .="<div class='item-inner'>";
$newSearch .="<div class='item-title'><h2 title='".strtoupper($project_og_image_title)."'>".strtoupper($project_og_image_title)."</h2></div>";
$newSearch .="<div class='item-title'><h3>".strtoupper($searchobj->visulString($project_category))."</h3></div>";
$newSearch .="<div class='item-img'>";
$newSearch .="<div class='item-img-info'><a class='product-image' title='".ucfirst($project_og_image_title)."' href='";
$newSearch .=outCorporateLink."/project/details/$project_id/$project_category/$project_sub_category/";
$newSearch .="'><img alt='".ucfirst($project_og_image_title)."' src='";

$newSearch .=hypertextWithOrWithoutWww.$project_og_small_image_url;

$newSearch .="'></a>";
$newSearch .="<div class='box-hover'>";
$newSearch .="<ul class='add-to-links'>";
$newSearch .="<li><a class='link-quickview' href='";
$newSearch .=outCorporateLink."/project/details/$project_id/$project_category/$project_sub_category/";
$newSearch .="'>Quick View</a></li>";
$newSearch .="<li><a class='link-compare' href='";
$newSearch .=outCorporateLink."/project/category/$project_id/";
$newSearch .="'>Compare</a></li>";
$newSearch .="</ul>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";


/*############*/
$newSearch .="<div class='entry-content'>";	
$newSearch .="<ul class='post-meta'>";				
$countLikeNow = new ebapps\corporate\corporate();
$countLikeNow ->count_corporate_like_now($project_id);

if($countLikeNow->data)
{
foreach($countLikeNow->data as $valcountLikeNow): extract($valcountLikeNow);
	
if(isset($_SESSION['ebusername']) and $likeNow == 0)
{
/*Logined True with hober effect */
/*Like Now*/
if(isset($_REQUEST['add_for_like']))
{
extract($_REQUEST);
$countLike = new ebapps\corporate\corporate();
$countLike ->add_for_like_corporate($corporate_id_for_like);
}
$newSearch .="<li><form method='post' class='toLike'><input type='hidden' name='corporate_id_for_like' value='$project_id' /><button type='submit' name='add_for_like'><i class='fa fa-heart'></i></button></form></li>";
}
else 
{
/*Logined False with hober effect */
/* Login to like */
$newSearch .="<li><i class='fa fa-heart'></i></li>";	
}
endforeach;
}			   
$newSearch .="<li><a href='";
$newSearch .=outCorporateLink."/contents/solve/$project_id/".$searchobj->seoUrl($project_og_image_title)."/";			   
$newSearch .="'>";
$countComment = new ebapps\corporate\corporate();
$countComment ->count_total_like_corporate($project_id);
if($countComment->data)
{
foreach($countComment->data as $valcountComment): extract($valcountComment);
	
if($totalPostLikes <= 1)
{
$newSearch .=" ";
$newSearch .=$totalPostLikes;
}
else 
{
$newSearch .=" ";
$newSearch .=$totalPostLikes;	
}
endforeach;
}
$newSearch .="</a></li>";
					
$newSearch .=" <li><i class='fa fa-comments'></i><a href='";
$newSearch .=outCorporateLink."/project/solve/$project_id/".$searchobj->seoUrl($project_og_image_title)."/";
$newSearch .="'>";
$countComment = new ebapps\corporate\corporate();
$countComment ->count_total_contents_in_project($project_id);
if($countComment->data)
{
foreach($countComment->data as $valcountComment): extract($valcountComment);
if($totalPostCommentsProject <= 1)
{
$newSearch .=" ";
$newSearch .=$totalPostCommentsProject;
}
else 
{
$newSearch .=" ";
$newSearch .=$totalPostCommentsProject;
}
endforeach;
$newSearch .="</a></li>";
$newSearch .=" <li><i class='fa fa-clock-o'></i><span class='day'> ".date('d M Y',strtotime($project_date))."</span></li>";
}
$newSearch .="</ul>";
$newSearch .="</div>";
/*############*/
$newSearch .="<div class='item-info'>";
$newSearch .="<div class='info-inner'>";
$newSearch .="<div class='item-content'>";

$newSearch .="<div class='action'>";
$newSearch .="<a href='";
$newSearch .=outCorporateLink."/project/details/$project_id/$project_category/$project_sub_category/";
$newSearch .="' class='button btn-cart'>Read More";
$newSearch .="</a>";
$newSearch .="</div>";

$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</li>";
endforeach;

$newSearch .="</ul>";
$newSearch .="</div>";
$newSearch .="</div>";

$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
echo $newSearch;
}
?>