<?php include_once (ebcorporate."/corporate.php"); ?>
<?php if(isset($_GET["id"])){$projectid = $_GET["id"]; ?>
<?php $obj= new ebapps\corporate\corporate(); $obj -> item_details_seo($projectid); ?>
<?php  if($obj->data >= 1) { foreach($obj->data as $val){ extract($val); ?>
<meta property="og:image:url" content="<?php echo hypertextWithOrWithoutWww.$project_og_image_url; ?>" />
<meta property='og:image:type' content='image/jpeg' />
<meta property='og:image:width' content='1024' />
<meta property='og:image:height' content='717' />
<meta property="og:title" content="<?php echo $project_og_image_title; ?> - <?php echo domain; ?>" />
<meta property="og:description" content="<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($project_og_image_title); ?>" />
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:site' content='eBangali'>
<meta name='twitter:creator' content='@eBangali'>
<meta name='twitter:url' content='<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>'>
<meta name='twitter:title' content='<?php echo $project_og_image_title; ?> - <?php echo domain; ?>'>
<meta name='twitter:description' content='<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($project_og_image_title); ?>'>
<meta name='twitter:image' content='<?php echo hypertextWithOrWithoutWww.$project_og_image_url; ?>'>
<title><?php echo ucfirst($project_og_image_title); ?></title>
<meta name='description' content='<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($project_og_image_title); ?>'>
<meta name='keywords' content='<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($obj->visulString($project_category)); ?>'>
<?php }}} ?>
<?php if(empty($_GET['id'])){ ?>
<?php $obj= new ebapps\corporate\corporate(); $obj -> last_item(); ?>
<?php if($obj->data >= 1) { foreach($obj->data as $val){ extract($val); ?>
<meta property='og:image:url' content='<?php echo hypertextWithOrWithoutWww.$project_og_image_url; ?>' />
<meta property='og:image:type' content='image/jpeg' />
<meta property='og:image:width' content='1024' />
<meta property='og:image:height' content='717' />
<meta property='og:title' content='<?php echo ucfirst($project_og_image_title); ?>' />
<meta property='og:description' content='<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($project_og_image_title); ?>' />
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:site' content='eBangali'>
<meta name='twitter:creator' content='@eBangali'>
<meta name='twitter:url' content='<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>'>
<meta name='twitter:title' content='<?php echo ucfirst($project_og_image_title); ?>' />
<meta name='twitter:description' content='<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($project_og_image_title); ?>' />
<meta name='twitter:image' content='<?php echo hypertextWithOrWithoutWww.$project_og_image_url; ?>'>
<title><?php echo ucfirst($project_og_image_title); ?></title>
<meta name='description' content='<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($project_og_image_title); ?>'>
<meta name='keywords' content='<?php echo ucfirst($obj->visulString($project_sub_category)); ?> - <?php echo ucfirst($obj->visulString($project_category)); ?>'>
<?php } } ?>
<?php } ?>