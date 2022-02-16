<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<aside class='col-right sidebar wow bounceInUp animated'>
<div class='block block-account'>
<div class='block-title'>Project Settings</div>
<div class='block-content'>
<ul>
<?php if ($_SESSION['memberlevel'] >= 1) { ?>
<li><a href='<?php echo outCorporateLink; ?>/project/'><i class='fa fa-briefcase fa-lg' aria-hidden='true'></i> Project</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 9) { ?>
<li><a href='<?php echo outCorporateLink; ?>/project-approve-query.php' title='Comments'><i class='fa fa-comment fa-lg' aria-hidden='true'></i> Comments</a></li>
<li><a href='<?php echo outCorporateLink; ?>/project-admin-view-items.php' title='Approval'><i class='fa fa-refresh fa-lg' aria-hidden='true'></i> Approval</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 2) { ?>
<li><a href='<?php echo outCorporateLink; ?>/project-items-status.php' title='Post Status'><i class='fa fa-tasks fa-lg' aria-hidden='true'></i> Post Status</a></li>
<li><a href='<?php echo outCorporateLink; ?>/project-add-items.php' title='New Project Post'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> New Project Post</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 9) { ?>
<li><a href='<?php echo outCorporateLink; ?>/project-add-sub-category.php' title='Add Sub Category'><i class='fa fa-sort-amount-asc fa-lg' aria-hidden='true'></i> Add Sub Category</a></li>
<li><a href='<?php echo outCorporateLink; ?>/project-add-category.php' title='Add Category'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category</a></li>
<?php } ?>
</ul>
</div>
</div>
</aside>