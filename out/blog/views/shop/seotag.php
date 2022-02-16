<?php include_once (ebblog.'/blog.php'); ?>
<?php if(isset($_GET['id'])){$contentsid = $_GET['id']; ?>
<?php $oSeoTag = new ebapps\blog\blog(); $oSeoTag -> item_details($contentsid); ?>
<?php  if($oSeoTag->data >= 1) { foreach($oSeoTag->data as $valoSeoTag){ extract($valoSeoTag); ?>
<meta property="og:image:url" content="<?php echo hypertextWithOrWithoutWww.$contents_og_small_image_url; ?>" />
<meta property='og:image:type' content='image/jpeg' />
<meta property='og:image:width' content='1024' />
<meta property='og:image:height' content='717' />
<meta property="og:title" content="<?php echo $oSeoTag->visulString($contentsKeyword); ?>" />
<meta property="og:description" content="<?php echo $oSeoTag->visulString($contentsKeyword); ?> <?php echo $oSeoTag->visulString($contents_sub_category); ?>" />
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:site' content='@eBangali'>
<meta name='twitter:domain' content='<?php echo domain; ?>'/>
<meta name='twitter:creator' content='@eBangali'>
<meta name='twitter:title' content='<?php echo $oSeoTag->visulString($contentsKeyword); ?>' />
<meta name='twitter:description' content='<?php echo $oSeoTag->visulString($contentsKeyword); ?> <?php echo $oSeoTag->visulString($contents_sub_category); ?>' />
<meta name='twitter:image' content='<?php echo $oSeoTag->visulString($contentsKeyword); ?> <?php echo $oSeoTag->visulString($contents_sub_category); ?>'>
<meta name='twitter:url' content='<?php echo fullUrl; ?>'>
<title><?php echo $oSeoTag->visulString($contentsKeyword); ?></title>
<meta name='keywords' content='<?php echo $oSeoTag->visulString($contentsKeyword); ?>, <?php echo $oSeoTag->visulString($contents_sub_category); ?>' />
<meta name='description' content='<?php echo $oSeoTag->visulString($contentsKeyword); ?> <?php echo $oSeoTag->visulString($contents_sub_category); ?>' />
<?php }}} ?>