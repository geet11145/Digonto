<?php
if(!mysqli_connect_errno()){ ?>
<li> <a href='<?php echo outContentsLink; ?>/contents/' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog <b class='caret'></b></a>
<ul class='dropdown-menu multi-level'>
<li><a href='<?php echo outContentsLink; ?>/contents-add-items.php' title='Submit your Article'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Submit your Article</a></li>
<li><a href='<?php echo outContentsLink; ?>/contents/' title='Blog'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog</a></li>
<?php include_once (ebblog.'/blog.php'); ?>
<?php
$category = new ebapps\blog\blog();
$category ->menu_category_contents();
?>
<?php if($category->data >= 1) { ?>
<?php foreach($category->data as $catval): extract($catval); ?>
<?php if (!empty($contents_category)){ ?>
<?php $cat = $contents_category; ?>
<li class='dropdown-submenu'> <a href='<?php echo outContentsLink; ?>/contents/' class='dropdown-toggle' data-toggle='dropdown'><?php echo ucfirst($category->visulString($contents_category)); ?></a>
<ul class='dropdown-menu'>
<?php
$subcategory = new ebapps\blog\blog();
$subcategory ->menu_sub_category_contents($cat);
?>
<?php if($subcategory->data >= 1) { ?>
<?php foreach($subcategory->data as $subval): extract($subval); ?>
<?php if (!empty($contents_category) and !empty($contents_sub_category)){ ?>
<li><a href='<?php echo outContentsLink; ?>/contents/category/<?php echo $contents_id; ?>/' title='<?php echo ucfirst($contents_sub_category); ?>'><?php echo ucfirst($subcategory->visulString($contents_sub_category)); ?></a></li>
<?php } ?>
<?php endforeach; } ?>
</ul>
</li>
<?php } ?>
<?php endforeach; } ?>
</ul>
</li>
<?php } ?>