<?php $obj= new ebapps\corporate\corporate(); $obj -> project_video(); ?>
<?php if($obj->data > 0) { ?>
<section id='video' class='video'>
<div class='container'>
<div class='row'>
<?php if($obj->data >= 1) { ?>
<?php foreach($obj->data as $val): extract($val); ?>
<?php if(!empty($project_video_link)) { ?>
<div class='col-xs-12 col-sm-6 col-md-3'>
<div class='thumbnail text-center homeCategory'>
<div class='bs-example' data-example-id='responsive-embed-16by9-iframe-youtube'>
<div class='embed-responsive embed-responsive-16by9'>
<iframe class='embed-responsive-item' src='<?php echo hypertextWithOrWithoutWww.$project_video_link; ?>' allowfullscreen=''> </iframe>
</div>
</div>          
</div>
</div>
<?php } endforeach; }  ?>             
</div>
</div>
</section>
<?php  }  ?> 