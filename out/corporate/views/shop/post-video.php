<?php $obj= new ebapps\corporate\corporate(); $obj -> project_detail_video($projectid); ?>
<?php if($obj->data >= 1) { ?>
<?php foreach($obj->data as $val): extract($val); ?>
<?php if(!empty($project_video_link)){ ?>
<div class='well'>
<div class='bs-example' data-example-id='responsive-embed-16by9-iframe-youtube'>
<div class='embed-responsive embed-responsive-16by9'>
<iframe class='embed-responsive-item' src='<?php echo hypertextWithOrWithoutWww.$project_video_link; ?>' allowfullscreen=''> </iframe>
</div>
</div> 
</div>   
<?php } endforeach; } ?>