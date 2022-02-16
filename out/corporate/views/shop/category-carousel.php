<?php $obj= new ebapps\corporate\corporate(); $obj -> project_carousel_category($projectCategory); ?>
<?php if($obj->data > 0) { ?>
<div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
<div id='rev_slider_4' class='rev_slider fullwidthabanner'>
<ul>
<?php foreach($obj->data as $val): extract($val); ?>
<li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='<?php echo hypertextWithOrWithoutWww.$project_og_image_url; ?>'><img src='<?php echo hypertextWithOrWithoutWww.$project_og_image_url; ?>' alt='<?php echo ucfirst($project_og_image_title); ?>' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' />
<div class='info'>
<div class='tp-caption ExtraLargeTitle sft  tp-resizeme' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><span class='eBTextBack'><?php echo ucfirst($obj->visulString($project_category)); ?></span> </div>
<div class='tp-caption LargeTitle sfl  tp-resizeme' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><span class='eBTextBack'><?php echo ucfirst($obj->visulString($project_sub_category)); ?></span> </div>
<div class='tp-caption Title sft  tp-resizeme' data-endspeed='500' data-speed='500' data-start='1450' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><span class='eBTextBack'><?php echo strtoupper($project_og_image_title); ?></span></div>
<div class='tp-caption sfb  tp-resizeme' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><a href='<?php echo outCorporateLink; ?>/project/subcategory/<?php echo $project_id; ?>/' class='buy-btn eBTextBack'>Compare</a></div>
</div>
</li>
<?php endforeach;  ?>
</ul>
</div>
</div>
<?php } ?>