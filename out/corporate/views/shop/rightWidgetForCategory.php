<?php
$rightColumn ="<div role='complementary' class='widget_wrapper13'>";
$rightColumn .="<div class='popular-posts widget widget__sidebar wow bounceInUp animated'>";
$rightColumn .="<h3 class='widget-title'><span>CATEGORIES</span></h3>";
$rightColumn .="<div class='widget-content'>";
$rightColumn .="<ul class='posts-list unstyled clearfix'>";
$objThumb = new ebapps\corporate\corporate(); $objThumb -> rightBarCategoryProject($projectid);
if($objThumb->data){foreach($objThumb->data as $valThumb): extract($valThumb);
$rightColumn .="<li class='cat-item'><a href='";
$rightColumn .=outCorporateLink."/project/category/$project_id/";
$rightColumn .="'>".strtoupper($objThumb->visulString($project_category))."</a></li>";
endforeach;
}
$rightColumn .="</ul>";
$rightColumn .="<ul class='posts-list unstyled clearfix'>";
$objThumb = new ebapps\corporate\corporate(); $objThumb -> rightBarSubCategoryProject($projectid);
if($objThumb->data){foreach($objThumb->data as $valThumb): extract($valThumb);
$rightColumn .="<li class='cat-item'><a href='";
$rightColumn .=outCorporateLink."/project/subcategory/$project_id/";
$rightColumn .="'>".strtoupper($objThumb->visulString($project_sub_category))."</a></li>";
endforeach;
}
$rightColumn .="</ul>";
$rightColumn .="</div>";
$rightColumn .="</div>";

$rightColumn .="</div>";
echo $rightColumn;
?>