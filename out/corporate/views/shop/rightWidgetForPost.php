<?php
$rightColumn ="<div role='complementary' class='widget_wrapper13'>";
$rightColumn .="<div class='popular-posts widget widget__sidebar wow bounceInUp animated'>";
$rightColumn .="<h3 class='widget-title'><span>LATEST POSTS</span></h3>";
$rightColumn .="<div class='widget-content'>";
$rightColumn .="<ul class='posts-list unstyled clearfix'>";
$rightColumn .="<li>";
$objThumb = new ebapps\corporate\corporate(); $objThumb -> rightBarAllProjects($projectid);
if($objThumb->data){foreach($objThumb->data as $valThumb): extract($valThumb);
$rightColumn .="<a href='";
$rightColumn .=outCorporateLink."/project/details/$project_id/".$objThumb->seoUrl($project_og_image_title)."/";
$rightColumn .="'><img class='img-responsive' alt='$project_og_image_title' title='$project_og_image_title' src='";
$rightColumn .=hypertextWithOrWithoutWww."$project_og_small_image_url";
$rightColumn .="' /></a>";
$rightColumn .="<h4><a title='".$objThumb->visulString($project_og_image_title)."' href='";
$rightColumn .=outCorporateLink."/project/solve/$project_id/".$objThumb->seoUrl($project_og_image_title)."/";
$rightColumn .="'>".strtoupper($project_og_image_title)."</a></h4>";
/*############*/
$rightColumn .="<div class='entry-content'>";
$rightColumn .="<ul class='post-meta'>";			
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
$rightColumn .="<li><form method='post' class='toLike'><input type='hidden' name='corporate_id_for_like' value='$project_id' /><button type='submit' name='add_for_like'><i class='fa fa-heart'></i></button></form></li>";
}
else 
{
/*Logined False with hober effect */
/* Login to like */
$rightColumn .="<li><i class='fa fa-heart'></i></li>";	
}
endforeach;
}			   
$rightColumn .="<li><a href='";
$rightColumn .=outCorporateLink."/contents/solve/$project_id/".$objThumb->seoUrl($project_og_image_title)."/";			   
$rightColumn .="'>";
$countComment = new ebapps\corporate\corporate();
$countComment ->count_total_like_corporate($project_id);
if($countComment->data)
{
foreach($countComment->data as $valcountComment): extract($valcountComment);
	
if($totalPostLikes <= 1)
{
$rightColumn .=" ";
$rightColumn .=$totalPostLikes;
}
else 
{
$rightColumn .=" ";
$rightColumn .=$totalPostLikes;	
}
endforeach;
}
$rightColumn .="</a></li>";
					
/**/
$rightColumn .=" <li><i class='fa fa-comments'></i><a href='";
$rightColumn .=outCorporateLink."/project/solve/$project_id/".$objPost->seoUrl($project_og_image_title)."/";
$rightColumn .="'>";
$countComment = new ebapps\corporate\corporate();
$countComment ->count_total_contents_in_project($project_id);
if($countComment->data)
{
foreach($countComment->data as $valcountComment): extract($valcountComment);
if($totalPostCommentsProject <= 1)
{
$rightColumn .=" ";
$rightColumn .=$totalPostCommentsProject;
}
else 
{
$rightColumn .=" ";
$rightColumn .=$totalPostCommentsProject;
}
endforeach;
$rightColumn .="</a></li>";
$rightColumn .=" <li><i class='fa fa-clock-o'></i><span class='day'> ".date('d M Y',strtotime($project_date))."</span></li>";
}
$rightColumn .="</ui>";
$rightColumn .="</div>";
/*############*/
endforeach;
}
$rightColumn .="</li>";
$rightColumn .="</ul>";
$rightColumn .="</div>";
$rightColumn .="</div>";
$rightColumn .="</div>";
echo $rightColumn;
?>