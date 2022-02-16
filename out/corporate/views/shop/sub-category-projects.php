<h3 class='text-center text-uppercase'>Projects</h3>
<div class='container'>
<div class='row'>
<div class='col-xs-12 eb-center'>
<button class='eb-filter-back filter-button' data-filter='all'>All</button>
<!-- Category -->
<?php $obj= new ebapps\corporate\corporate(); $obj -> project_thurmnail_category_sub_category($projectCategory, $projectSubCategory); ?>
<?php if($obj->data){ foreach($obj->data as $val): extract($val); ?> 
<button class='eb-filter-back filter-button' data-filter='<?php echo $project_sub_category; ?>'><?php echo ucfirst($project_sub_category); ?></button>
<?php endforeach; ?>
<?php } ?>
</div>
</div>
<div class='row'>
<?php $obj= new ebapps\corporate\corporate(); $obj -> project_thurmnail_sub_category($projectCategory, $projectSubCategory); ?>
<?php if($obj->data){ foreach($obj->data as $val): extract($val); ?> 
<div class='col-md-3 filter filterContent <?php echo $project_sub_category; ?>'>
<div class='each-item'><img class="port-image" src="<?php echo hypertextWithOrWithoutWww.$project_og_small_image_url; ?>" alt="<?php echo ucfirst($project_og_image_title); ?>" title="<?php echo ucfirst($project_og_image_title); ?>" />
<div class='cap1'>
<h3 title='<?php echo ucfirst($obj->visulString($projectSubCategory)); ?>'><?php echo ucfirst($obj->visulString($projectSubCategory)); ?></h3>
<p><a class='eb-filter-back' href='<?php echo outCorporateLink; ?>/project/details/<?php echo $project_id; ?>/<?php echo $project_category; ?>/<?php echo $project_sub_category; ?>/' role='button'><?php echo ucfirst($obj->visulString($project_sub_category)); ?></a></p>
</div>
<div class='cap2'>
<a title='<?php echo ucfirst($project_og_image_title); ?>' class='eb-filter-back' href='<?php echo outCorporateLink; ?>/project/details/<?php echo $project_id; ?>/<?php echo $project_category; ?>/<?php echo $project_sub_category; ?>/' role='button'><?php echo ucfirst($project_og_image_title); ?></a>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php } ?> 
</div>