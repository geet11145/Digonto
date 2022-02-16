<div class='breadcrumbs'>
<div class='container'>
<div class='row'>
<div class='col-xs-12'>
<ul>
<li class='home'><a href='<?php echo outCorporateLink; ?>/project/' title='HOME'>HOME</a><span>/ </span></li>
<?php if(isset($_GET['id'])){$projectid = $_GET['id']; ?>
<?php $obj= new ebapps\corporate\corporate(); $obj -> itemDetailsBreadcrumbs($projectid); ?>
<?php  if($obj->data) { foreach($obj->data as $val){ extract($val); ?>
<li><a href='<?php echo outCorporateLink; ?>/project/category/<?php echo $project_id; ?>/'><strong><?php echo strtoupper($obj->visulString($project_category)); ?></strong></a><span>/ </span></li>
<li><a href='<?php echo outCorporateLink; ?>/project/subcategory/<?php echo $project_id; ?>/'><strong><?php echo strtoupper($obj->visulString($project_sub_category)); ?></strong></a></li>
<?php }}} ?>
</ul>
</div>
</div>
</div>
</div>