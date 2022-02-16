<?php
$postArticle ="<div class='site-content' id='primary'>";
$postArticle .="<div role='main' id='content'>";
$objPost = new ebapps\corporate\corporate(); $objPost -> itemDetailsAll($projectid);
if($objPost->data){foreach($objPost->data as $valPost): extract($valPost);
$postArticle .="<article class='blog_entry clearfix wow bounceInUp animated' id='post-$project_id'>";
$postArticle .="<header class='blog_entry-header clearfix'>";
$postArticle .="<div class='blog_entry-header-inner'>";
$postArticle .="<h1 title='".ucfirst($project_og_image_title)."'>";
$postArticle .=strtoupper($project_og_image_title);
$postArticle .="</h1>";
$postArticle .="</div>";
$postArticle .="</header>";
$postArticle .="<div class='entry-content'>";
$postArticle .="<div class='featured-thumb'>";
$postArticle .="<img class='img-responsive' title='$project_og_image_title' alt='".ucfirst($project_og_image_title)."' src='";
$postArticle .=hypertextWithOrWithoutWww."$project_og_image_url";
$postArticle .="' />";
$postArticle .="</div>";


$postArticle .="<div class='entry-content'>";
$postArticle .="<ul class='post-meta'>";
$postArticle .="<li><i class='fa fa-user'></i>Posted by <a href='";
$postArticle .=outCorporateLink."/project/writer/$username_project/";
$postArticle .="'>$username_project</a></li>";


/*Like?*/
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
$postArticle .="<li><form method='post' class='toLike'><input type='hidden' name='corporate_id_for_like' value='$project_id' /><button type='submit' name='add_for_like'><i class='fa fa-heart'></i></button></form></li>";
}
else 
{
/*Logined False with hober effect */
/* Login to like */
$postArticle .="<li><i class='fa fa-heart'></i></li>";
/** **/
}
endforeach;
}   
				   
				   
$postArticle .="<li><a href='";
$postArticle .=outCorporateLink."/project/solve/$project_id/".$objPost->seoUrl($project_og_image_title)."/";			   
$postArticle .="'>";
$countComment = new ebapps\corporate\corporate();
$countComment ->count_total_like_corporate($project_id);
if($countComment->data)
{
foreach($countComment->data as $valcountComment): extract($valcountComment);
	
if($totalPostLikes <= 1)
{
$postArticle .=$totalPostLikes;
$postArticle .=" like";
}
else 
{
$postArticle .=$totalPostLikes;
$postArticle .=" Likes";	
}
endforeach;
}
$postArticle .="</a></li>";
/* */				   

$postArticle .="<li><i class='fa fa-comments'></i><a href='";
$postArticle .=outCorporateLink."/project/solve/$project_id/".$objPost->seoUrl($project_og_image_title)."/";
$postArticle .="'>";
$countComment = new ebapps\corporate\corporate();
$countComment ->count_total_contents_in_project($project_id);
if($countComment->data)
{
foreach($countComment->data as $valcountComment): extract($valcountComment);
if($totalPostCommentsProject <= 1)
{
$postArticle .=$totalPostCommentsProject;
$postArticle .=" Comment";
}
else 
{
$postArticle .=$totalPostCommentsProject;
$postArticle .=" Comments";	
}
endforeach;
}
$postArticle .="</a></li>";

$postArticle .="<li><i class='fa fa-clock-o'></i><span class='day'>".date('d M Y',strtotime($project_date))."</span></li>";
$postArticle .="</ul>";
$postArticle .="</div>";
$postArticle .="</div>";
$postArticle .="<footer class='entry-meta'> This entry was posted in <a title='View all posts in ".$objPost->visulString($project_category)."' href='";
$postArticle .=outCorporateLink."/project/category/$project_id/";
$postArticle .="'>".$objPost->visulString($project_category)."</a> and <a title='View all posts in ".$objPost->visulString($project_sub_category)."' href='";
$postArticle .=outCorporateLink."/project/subcategory/$project_id/";
$postArticle .="'>".$objPost->visulString($project_sub_category)."</a></footer>";
$postArticle .="</article>";
endforeach;
}
$postArticle .="</div>";
$postArticle .="</div>";

if(!empty($project_affiliate_link)){
$postArticle .="<div class='entry-content'>";
$postArticle .="<p><a class='eb-cart-back' href='".hypertextWithOrWithoutWww."$project_affiliate_link' target='_blank'";
$postArticle .="'><i class='fa fa-shopping-cart fa-lg' aria-hidden='true'></i> <b>Buy Now</b></a></p></div>";
}

echo $postArticle;
?>
