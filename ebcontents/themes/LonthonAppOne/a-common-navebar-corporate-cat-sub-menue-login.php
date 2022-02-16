<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php
$category = new ebapps\corporate\corporate();
$category ->menu_category_project();
?>
<?php if($category->data >= 1) { ?>
<?php foreach($category->data as $catval): extract($catval); ?>
<?php if (!empty($project_category)){ ?>
<?php $cat = $project_category; ?>
<li class='dropdown-submenu'> <a href='<?php echo outCorporateLink; ?>/project/' class='dropdown-toggle' data-toggle='dropdown'><?php echo ucfirst($category->visulString($project_category)); ?></a>
<ul class='dropdown-menu'>
<?php
$subcategory = new ebapps\corporate\corporate();
$subcategory ->menu_sub_category_project($cat);
?>
<?php if($subcategory->data >= 1) { ?>
<?php foreach($subcategory->data as $subval): extract($subval); ?>
<?php if (!empty($project_category) and !empty($project_sub_category)){ ?>
<li><a href='<?php echo outCorporateLink; ?>/project/subcategory/<?php echo $project_id; ?>/' title='<?php echo ucfirst($project_sub_category); ?>'><?php echo ucfirst($subcategory->visulString($project_sub_category)); ?></a></li>
<?php } ?>
<?php endforeach; } ?>
</ul>
</li>
<?php } ?>
<?php endforeach; } ?>