<!--ScreenShots -->
<?php
if(!empty($project_id))
{
$objapprovedmultiProjectImage = new ebapps\corporate\corporate();
$objapprovedmultiProjectImage ->project_same_project_multi_image($project_id);
if($objapprovedmultiProjectImage->data)
{
$screen ="<div class='well'>";
foreach($objapprovedmultiProjectImage->data as $approvedMulit): extract($approvedMulit);
{
$screen .="<img class='img-responsive' alt='$project_og_image_title' title='$project_og_image_title' src='".hypertextWithOrWithoutWww."$eb_corporate_big_imag_url' />";
$screen .="</br>";
}
endforeach;
$screen .="</div>";
echo $screen;
}
}
?>