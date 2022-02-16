<!-- Footer -->
<footer class='footer'>
  <div class='footer-top'>
    <div class='container'>
      <div class='row'>
        <div class='col-xs-12 col-sm-6'>
          <div class='social'>
            <ul>
            
            </ul>
          </div>
        </div>
        <div class='col-xs-12 col-sm-6'>
          <div class='payment-accept'> <img src='<?php echo themeResource; ?>/images/payment-2.png' alt='VISA CARD'> <img src='<?php echo themeResource; ?>/images/payment-3.png' alt='AMERICAN EXPRESS CARD'> <img src='<?php echo themeResource; ?>/images/payment-4.png' alt='MASTER CARD'> </div>
        </div>
      </div>
    </div>
  </div>
  <footer class='footer'>
  <div class='footer-middle'>
    <div class='container'>
      <div class='row'>
        <div class='col-md-3 col-sm-6'>
          <div class='footer-column pull-left'>
            <h4>Guide</h4>
            <ul class='links'>
              <?php if(!mysqli_connect_errno()){ ?>
              <li><a href='<?php echo outPagesLink; ?>/faq.php' title='FAQs'><span>FAQs</span></a></li>
              <li><a href='<?php echo outPagesLink; ?>/payment.php' title='Payment'><span>Payment</span></a></li>
              <li><a href='<?php echo outPagesLink; ?>/shipment.php' title='Shipment'><span>Shipment</span></a></li>
              <li><a href='<?php echo outPagesLink; ?>/return-policy.php' title='Returns Policy'><span>Returns Policy</span></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class='col-md-3 col-sm-6'>
          <div class='footer-column pull-left'>
            <h4>Advisor</h4>
            <ul class='links'>
            <?php if(!mysqli_connect_errno()){ ?>
              <li><a href='<?php echo outAccessLink; ?>/home.php' title='Your Account'>Your Account</a></li>
              <li><a href='<?php echo outAccessLink; ?>/access_update_account_information.php' title='Account Settings'>Account Settings </a></li>
              <li class='last'><a href='<?php echo outSysLink; ?>/point-of-sale-pos-software.php'  title='Free POS System Info'><span>Free POS System Info</span></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class='col-md-3 col-sm-6'>
          <div class='footer-column pull-left'>
            <h4>Information</h4>
            <ul class='links'>
            <?php if(!mysqli_connect_errno()){ ?>
            <li><a href='<?php echo outPagesLink; ?>/aboutus.php' title='About us'><span>About us</span></a></li>
            <li><a href='<?php echo outPagesLink; ?>/terms-conditions.php' title='Terms and Conditions'><span>Terms and Conditions</span></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class='col-md-3 col-sm-6'>
          <h4>Contact us</h4>
          <ul class='links'>
            <?php if(!mysqli_connect_errno()){ ?>
            <li><a href='<?php echo outPagesLink; ?>/our-support-team.php' title='Our Team'><span>Our Team</span></a></li>
            <li><a href='<?php echo outPagesLink; ?>/contact.php' title='Contact us'><span>Contact us</span></a></li>
              <?php } ?>
            </ul>
          <div class='contacts-info'>
          <?php if(!mysqli_connect_errno()){ ?>
          <?php include_once(eblogin.'/registration_page.php');
        $siteLocation = new ebapps\login\registration_page();
        $siteLocation -> site_location();
        ?>
        <?php if($siteLocation->data >= 1) { foreach($siteLocation->data as $val){ extract($val); ?>
            <address>
            <i class='add-icon'>&nbsp;</i><?php if(!empty($business_name)){echo "$business_name <br>"; } ?>
            <?php if(!empty($business_city_town)){echo "$business_city_town"; } ?>
            </address>
            <div class='phone-footer'><i class='phone-icon'>&nbsp;</i> <?php echo adminMobile; ?></div>
			<div class='email-footer'><i class='email-icon'>&nbsp;</i> <a href='mailto:<?php echo adminEmail; ?>'><?php echo adminEmail; ?></a> </div>
			<?php }} ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class='footer-top'>
    <div class='container'>
      <div class='row'>
        <div class='col-xs-12 col-sm-6'>
          <div class='social'>
            <ul>
            <?php if(!mysqli_connect_errno()){ ?>
            <li class='rss'><a href='/mrss.xml'></a></li>
            <?php include_once(eblogin.'/registration_page.php');
			$social = new ebapps\login\registration_page();
			$social -> site_owner_social_info();
			?>
            <?php if($social->data >= 1) { foreach($social->data as $val){ extract($val); ?>
            <?php if(!empty($facebook_link)){echo "<li class='fb'><a href='".hypertextWithOrWithoutWww."$facebook_link' target='_blank' rel='nofollow'></a></li>"; } ?>
            <?php if(!empty($twitter_link)){echo "<li class='tw'><a href='".hypertextWithOrWithoutWww."$twitter_link' target='_blank' rel='nofollow'></a></li>"; } ?>
            <?php if(!empty($google_plus_link)){echo "<li class='googleplus'><a href='".hypertextWithOrWithoutWww."$google_plus_link' target='_blank' rel='nofollow'></a></li>"; } ?>
            <?php if(!empty($github_link)){echo "<li class='github'><a href='".hypertextWithOrWithoutWww."$github_link' target='_blank' rel='nofollow'></a></li>"; } ?>
            <?php if(!empty($linkedin_link)){echo "<li class='linkedin'><a href='".hypertextWithOrWithoutWww."$linkedin_link' target='_blank' rel='nofollow'></a></li>"; } ?>
            <?php if(!empty($pinterest_link)){echo "<li class='pintrest'><a href='".hypertextWithOrWithoutWww."$pinterest_link' target='_blank' rel='nofollow'></a></li>"; } ?>
            <?php if(!empty($youtube_link)){echo "<li class='youtube'><a href='".hypertextWithOrWithoutWww."$youtube_link' target='_blank' rel='nofollow'></a></li>"; } ?>
			<?php if(!empty($instagram_link)){echo "<li class='instagram'><a href='".hypertextWithOrWithoutWww."$instagram_link' target='_blank' rel='nofollow'></a></li>"; } ?>
            <?php }} ?>
            <?php } ?>
            </ul>
          </div>
        </div>
        <div class='col-xs-12 col-sm-6'>
          <div class='payment-accept'> <img src='<?php echo themeResource; ?>/images/bKash.jpg' alt='bKash'> <img src='<?php echo themeResource; ?>/images/payment-1.png' alt='PayPal'> <img src='<?php echo themeResource; ?>/images/payment-2.png' alt='VISA CARD'> <img src='<?php echo themeResource; ?>/images/payment-3.png' alt='AMERICAN EXPRESS CARD'> <img src='<?php echo themeResource; ?>/images/payment-4.png' alt='MASTER CARD'> </div>
        </div>
      </div>
    </div>
  </div>
  <div class='footer-bottom'>
    <div class='container'>
      <div class='row'>
        <div class='col-xs-12'> <?php echo date('Y'); ?> <a href='<?php echo hostingAndRoot; ?>'><?php echo domain; ?></a> All Rights Reserved. Develop by <a href='https://ebangali.com'>eBangali</a></div>
      </div>
    </div>
  </div>
</footer>
</footer>
<!-- End Footer -->
<!-- JavaScript --> 
<script src='<?php echo themeResource; ?>/js/bootstrap.min.js'></script> 
<script src='<?php echo themeResource; ?>/js/revslider.js'></script> 
<script src='<?php echo themeResource; ?>/js/common.js'></script> 
<script src='<?php echo themeResource; ?>/js/jquery.flexslider.js'></script> 
<script src='<?php echo themeResource; ?>/js/owl.carousel.min.js'></script> 
<script src='<?php echo themeResource; ?>/js/jquery.mobile-menu.min.js'></script>
<script src='<?php echo themeResource; ?>/js/countdown.js'></script>
<script src='<?php echo themeResource; ?>/js/cloud-zoom.js'></script>
<script src='<?php echo themeResource; ?>/js/jquery.waypoints.min.20.05.23.js'></script> 
<script src='<?php echo themeResource; ?>/js/main.eb.20.05.23.js'></script>
<script src='<?php echo themeResource; ?>/js/filter.bootstrap.20.05.23.js'></script>
<script src='<?php echo themeResource; ?>/js/masonry.js'></script>
<script src='<?php echo themeResource; ?>/js/masonryAfterCall.js'></script>
</body>
</html>