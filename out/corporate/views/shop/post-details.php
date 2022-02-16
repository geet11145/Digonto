<?php $obj= new ebapps\corporate\corporate(); $obj -> itemDetailsAll($projectid); ?>
<?php if($obj->data >= 1) { ?>
<?php foreach($obj->data as $val): extract($val); ?>
<?php if(!empty($project_og_image_what_to_do)){ ?>
<?php
$whatToDo ="<div class='well'>";
$whatToDo .=ucfirst($project_og_image_what_to_do); 
$whatToDo .="</div>";
echo $whatToDo; 
?>
<?php } endforeach; } ?>
<?php $obj= new ebapps\corporate\corporate(); $obj -> itemDetailsAll($projectid); ?>
<?php if($obj->data >= 1) { ?>
<?php foreach($obj->data as $val): extract($val); ?>
<?php if(!empty($project_og_image_how_to_solve)){ ?>
<?php
$howToDo ="<div class='well'>";
$howToDo .=ucfirst($project_og_image_how_to_solve);
$howToDo .="</div>";
echo $howToDo; 
?>
<?php } endforeach; } ?>
<?php include_once("download.php"); ?>
<?php include_once("screenshots.php"); ?>
<?php include_once("post-video.php"); ?>
<?php include_once("comments.php"); ?>