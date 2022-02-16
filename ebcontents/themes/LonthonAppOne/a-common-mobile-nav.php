<div id='mobile-menu'>
  <ul>
    <?php if (isset($_SESSION['ebusername'])){ ?>
    <!--Corporate-->
    <li><a href='<?php echo outCorporateLink; ?>/project/'><i class='fa fa-briefcase fa-lg' aria-hidden='true'></i> Projects</a>
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
    </li>
    <!--Blog-->
    <li><a href='<?php echo outContentsLink; ?>/contents/'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog </a>
      <ul>
        <?php if ($_SESSION['memberlevel'] >= 1) { ?>
        <li><a href='<?php echo outContentsLink; ?>/contents/' title='Blog'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog</a></li>
        <?php } ?>
        <?php if ($_SESSION['memberlevel'] >= 9) { ?>
        <li><a href='<?php echo outContentsLink; ?>/contents-approve-query.php' title='Comments'><i class='fa fa-comment fa-lg' aria-hidden='true'></i> Comments</a></li>
        <li><a href='<?php echo outContentsLink; ?>/contents-admin-view-items.php' title='Approval'><i class='fa fa-refresh fa-lg' aria-hidden='true'></i> Approval</a></li>
        <li><a href='<?php echo outContentsLink; ?>/contents_add_tags.php' title='Add Tags'><i class='fa fa-tags fa-lg' aria-hidden='true'></i> Add Tags</a></li>
        <?php } ?>
        <?php if ($_SESSION['memberlevel'] >= 1) { ?>
        <li><a href='<?php echo outContentsLink; ?>/contents_add_tags_pub.php' title='Tags URL'><i class='fa fa-tags fa-lg' aria-hidden='true'></i> Tags URL</a></li>
        <li><a href='<?php echo outContentsLink; ?>/contents-items-status.php' title='Post Status'><i class='fa fa-tasks fa-lg' aria-hidden='true'></i> Post Status</a></li>
        <li><a href='<?php echo outContentsLink; ?>/contents-add-items.php' title='Submit your Article'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Submit your Article</a></li>
        <?php } ?>
        <?php if ($_SESSION['memberlevel'] >= 9) { ?>
        <li><a href='<?php echo outContentsLink; ?>/contents-add-sub-category.php' title='Add Sub Category'><i class='fa fa-sort-amount-asc fa-lg' aria-hidden='true'></i> Add Sub Category</a></li>
        <li><a href='<?php echo outContentsLink; ?>/contents-add-category.php' title='Add Category'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category</a></li>
        <?php } ?>
      </ul>
    </li>
    <!--SATTINGS-->
    <li><a href='<?php echo outAccessLink; ?>/home.php'><i class='fa fa-cogs fa-lg' aria-hidden='true'></i> <?php echo $_SESSION['ebusername']; ?> </a>
      <ul>
        <?php if ($_SESSION['memberlevel'] >= 9) { ?>
        <li><a href='<?php echo outAccessLink; ?>/sendMail.php' title='Mass eMail'><i class='fa fa-envelope fa-lg' aria-hidden='true'></i> Send eMail</a></li>
        <li><a href='<?php echo outAccessLink; ?>/access_all_account_information.php' title='User Info'><i class='fa fa-users fa-lg' aria-hidden='true'></i> User Info</a></li>
        <li><a href='<?php echo outAccessLink; ?>/all_user_analytics.php' title='User Analytics'><i class='fa fa-users fa-lg' aria-hidden='true'></i> User Analytics</a></li>
        <li><a href='<?php echo outAccessLink; ?>/all_visitor_analytics.php' title='Visitor Analytics'><i class='fa fa-users fa-lg' aria-hidden='true'></i> Visitor Analytics</a></li>
        <li><a href='<?php echo outAccessLink; ?>/mrss.php' title='All mRSS'><i class='fa fa-rss fa-lg' aria-hidden='true'></i> All mRSS</a></li>
        <li><a href='<?php echo outAccessLink; ?>/sitemap.php' title='Sitemap'><i class='fa fa-sitemap fa-lg' aria-hidden='true'></i> Sitemap</a></li>
        <li><a href='<?php echo outAccessLink; ?>/access_payment_gateways.php' title='Payment Gateways'><i class='fa fa-credit-card fa-lg' aria-hidden='true'></i> Payment Gateways</a></li>
        <?php } ?>
        <?php if ($_SESSION['memberlevel'] >= 8) { ?>
        <li><a href='<?php echo outAccessLink; ?>/access-admin-merchant-profile.php' title='Business Info'><i class='fa fa-briefcase fa-lg' aria-hidden='true'></i> Business Info</a></li>
        <?php } ?>
        <?php if ($_SESSION['memberlevel'] >= 6) { ?>
        <li><a href='<?php echo outAccessLink; ?>/access-invite-result.php' title='Referral Statuses'><i class='fa fa-bar-chart fa-lg' aria-hidden='true'></i> Referral Statuses </a></li>
        <li><a href='<?php echo outAccessLink; ?>/access-invite.php' title='Refer Someone'><i class='fa fa-user-plus fa-lg' aria-hidden='true'></i> Refer Someone</a></li>
        <?php } ?>
        <?php if ($_SESSION['memberlevel'] >= 1) { ?>
        <li><a href='<?php echo outAccessLink; ?>/access_update_account_information.php' title='Account Settings'><i class='fa fa-cog fa-lg' aria-hidden='true'></i> Account Settings </a></li>
        <?php } ?>
        <li class='last'><a href='<?php echo outPagesLink; ?>/logout.php' title='Log Out'><i class='fa fa-sign-out fa-lg' aria-hidden='true'></i> Log Out</a></li>
      </ul>
    </li>
    <?php } else { ?>
    <?php if(!mysqli_connect_errno()){ ?>
    <?php if (empty($_SESSION['ebusername'])){ ?>
    <li class='nosub'><a href='<?php echo outAccessLink; ?>/home.php' title='Log In'><i class='fa fa-sign-in fa-lg' aria-hidden='true'></i> Log In</a></li>
    <li class='nosub'><a href='<?php echo outAccessLink; ?>/signup.php' title='Sign Up'><i class='fa fa-user-plus fa-lg' aria-hidden='true'></i> Sign Up</a></li>
    <?php } ?>
    <!--Start Projects Mobile Manue -->
    <?php include_once (ebcorporate.'/corporate.php'); ?>
    <li><a href='<?php echo outCorporateLink; ?>/project/' title='Projects'><i class='fa fa-briefcase fa-lg' aria-hidden='true'></i> Projects</a>
      <?php $corporateCategory = new ebapps\corporate\corporate(); $corporateCategory ->menu_category_project(); ?>
      <?php if($corporateCategory->data >= 1) { ?>
      <?php foreach($corporateCategory->data as $corporateCategoryVal): extract($corporateCategoryVal); ?>
      <?php if (!empty($project_category)){ ?>
      <ul>
        <li><a href='<?php echo outCorporateLink; ?>/project/category/<?php echo $project_id; ?>/'><?php echo ucfirst($corporateCategory->visulString($project_category)); ?></a>
          <?php $corPorateSubCategory = new ebapps\corporate\corporate(); $corPorateSubCategory ->menu_sub_category_project($project_category); ?>
          <?php if($corPorateSubCategory->data >= 1) { ?>
          <?php foreach($corPorateSubCategory->data as $corPorateSubCategoryVal): extract($corPorateSubCategoryVal); ?>
          <?php if (!empty($project_category) and !empty($project_sub_category)){ ?>
          <ul>
            <li><a href='<?php echo outCorporateLink; ?>/project/subcategory/<?php echo $project_id; ?>/' title='<?php echo ucfirst($project_sub_category); ?>'><?php echo ucfirst($corPorateSubCategory->visulString($project_sub_category)); ?></a></li>
          </ul>
          <?php } endforeach; } ?>
        </li>
      </ul>
      <?php } endforeach; } ?>
    </li>
    <!--End Projects Mobile Manue -->
    <!--Start Blog Mobile Manue -->
    <?php include_once (ebblog.'/blog.php'); ?>
    <li><a href='<?php echo outContentsLink; ?>/contents/' title='Blog'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog</a>
      <?php $contentCategory = new ebapps\blog\blog(); $contentCategory ->menu_category_contents(); ?>
      <?php if($contentCategory->data >= 1) { ?>
      <?php foreach($contentCategory->data as $contentCategoryVal): extract($contentCategoryVal); ?>
      <?php if (!empty($contents_category)){ ?>
      <ul>
        <li> <a href='<?php echo outContentsLink; ?>/contents/category/<?php echo $contents_id; ?>/'><?php echo ucfirst($contentCategory->visulString($contents_category)); ?></a>
          <?php $contentSubCategory = new ebapps\blog\blog(); $contentSubCategory ->menu_sub_category_contents($contents_category); ?>
          <?php if($contentSubCategory->data >= 1) { ?>
          <?php foreach($contentSubCategory->data as $contentSubCategoryVal): extract($contentSubCategoryVal); ?>
          <?php if (!empty($contents_category) and !empty($contents_sub_category)){ ?>
          <ul>
            <li><a href='<?php echo outContentsLink; ?>/contents/subcategory/<?php echo $contents_id; ?>/' title='<?php echo ucfirst($contents_sub_category); ?>'><?php echo ucfirst($contentSubCategory->visulString($contents_sub_category)); ?></a></li>
          </ul>
          <?php } endforeach; } ?>
        </li>
      </ul>
      <?php } endforeach; } ?>
    </li>
    <!--End Blog Mobile Manue -->
    <?php } ?>
    <?php } ?>
  </ul>
</div>
