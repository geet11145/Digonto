<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<?php include_once (ebaccess.'/access_permission_admin_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7'>
<?php
$pubDate =date("r");
$xml_output  = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xml_output .= "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
$xml_output .= "<channel>\n";
include_once(eblogin.'/registration_page.php');
$obj = new ebapps\login\registration_page();
$obj -> site_owner_title();
if($obj->data >= 1) { foreach($obj->data as $val){ extract($val); 
if(!empty($business_title_one)){
$xml_output .= "\t<title>$business_title_one</title>\n";
}
}
}
$xml_output .= "\t<link>".outLinkFull."/</link>\n";
include_once(eblogin.'/registration_page.php');
$obj = new ebapps\login\registration_page();
$obj -> site_owner_title();
if($obj->data >= 1) { foreach($obj->data as $val){ extract($val); 
if(!empty($business_title_two)){
$xml_output .= "\t<description>$business_title_two</description>\n";
}
}
}
$xml_output .= "\t<language>en-us</language>\n";
$xml_output .= "\t<pubDate>$pubDate</pubDate>\n";
$xml_output .= "\t<lastBuildDate>$pubDate</lastBuildDate>\n";
$xml_output .= "\t<copyright>Copyright (c) ".date("Y")." ".domain."</copyright>\n";
?>
<!--Blog-->
<?php include_once (ebblog.'/blog.php'); ?>
<?php $obj= new ebapps\blog\blog(); $obj ->contents_mrss(); ?>
<?php if($obj->data >=1){ foreach($obj->data as $val): extract($val); ?> 
<?php
$xml_output .= "<item>\n";
$xml_output .= "\t<title>$contents_og_image_title</title>\n";
$xml_output .= "\t<link>".outContentsLinkFull."/contents/details/$contents_id/$contents_category/$contents_sub_category/</link>\n";
$xml_output .= "\t<description><![CDATA[<img src='".hypertextWithOrWithoutWww."$contents_og_image_url' width='1024px' alt='$contents_og_image_title' title='$contents_og_image_title' />]]></description>\n";
$xml_output .= "\t<category>$contents_category</category>\n";
$xml_output .= "\t<pubDate>$contents_date</pubDate>\n";
$xml_output .= "</item>\n";
?>
<?php endforeach; } ?>
<!--Blog-->
<?php include_once (ebblog.'/blog.php'); ?>
<?php
$tagKeyObj= new ebapps\blog\blog(); $tagKeyObj ->select_blog_items_tags_views();
if($tagKeyObj->data >=1){ foreach($tagKeyObj->data as $valtagKeyObj): extract($valtagKeyObj);
$xml_output .= "<item>\n";
$xml_output .= "\t<title>$contents_og_image_title</title>\n";
$xml_output .= "\t<link>".outContentsLinkFull."/contents/tags/$cont_items_id_in_subcat_keywords/$cont_subcategory_keywords_id/$cont_subcategory_keywords_value/$contents_category/$contents_sub_category/</link>\n";
$xml_output .= "\t<description><![CDATA[<img src='".hypertextWithOrWithoutWww."$contents_og_image_url' width='1024px' alt='$contents_og_image_title' title='$contents_og_image_title' />]]></description>\n";
$xml_output .= "\t<category>$cont_subcategory_keywords_value</category>\n";
$xml_output .= "\t<pubDate>$contents_date</pubDate>\n";
$xml_output .= "</item>\n";
?>
<?php endforeach; } ?>
<!--Corporate-->
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php $obj= new ebapps\corporate\corporate(); $obj ->project_mrss(); ?>
<?php if($obj->data >=1){ foreach($obj->data as $val): extract($val); ?> 
<?php
$xml_output .= "<item>\n";
$xml_output .= "\t<title>$project_og_image_title</title>\n";
$xml_output .= "\t<link>".outCorporateLinkFull."/project/details/$project_id/$project_category/$project_sub_category/</link>\n";
$xml_output .= "\t<description><![CDATA[<img src='".hypertextWithOrWithoutWww."$project_og_image_url' width='1024px' alt='$project_og_image_title' title='$project_og_image_title' />]]></description>\n";
$xml_output .= "\t<category>$project_category</category>\n";
$xml_output .= "\t<pubDate>$project_date</pubDate>\n";
$xml_output .= "</item>\n";
?>
<?php endforeach; } ?>
<?php
$xml_output .=  "</channel>\n";
$xml_output .=  "</rss>";
$filenamepath =  eb."/mrss.xml";
chmod($filenamepath, 0755);
$fp = fopen($filenamepath,'w');
$write = fwrite($fp,$xml_output);
echo $xml_output;
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("access-my-account.php"); ?>
</div>
</div>
</div>	
<?php include_once (eblayout.'/a-common-footer.php'); ?>