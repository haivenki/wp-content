<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
    $themefavicon=get_theme_mod('olam_theme_favicon');
    $themefavicon=olam_replace_site_url($themefavicon);
    if(isset($themefavicon) && (strlen($themefavicon)>0) ) { ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url($themefavicon); ?>">
    <?php } } else{ wp_site_icon(); } ?>
    <?php
    $customcss = get_theme_mod( 'olam_custom_css' ); 
    if(isset($customcss) && (strlen($customcss)>0 )  ){ ?>
    <style type="text/css">
      <?php echo esc_html($customcss); ?>
    </style>
    <?php } ?>
    <?php wp_head(); ?>
  </head>
  <?php 
  $bodyClassArray=array();
  $olamheadertrans=get_theme_mod('olam_header_trans');
  $olamheadersticky=get_theme_mod('olam_header_sticky');
  $olamcategoryfilter=get_theme_mod('olam_category_filter');
  if(isset($olamheadertrans) && $olamheadertrans==1 ){ 
    $bodyClassArray[]="header-trans";
    $bodyClassArray[]="header-overlay";
  }
  if(isset($olamheadersticky) && $olamheadersticky==1 ){ 
   $bodyClassArray[]="header-sticky";
 }
 ?>

 <body <?php body_class($bodyClassArray); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade"><?php echo wp_kses(__('You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.</p>','olam'),array('p'=>array(),'strong'=>array() )); ?>
            <![endif]-->
            <?php 
            $olamthemepreloader=get_theme_mod('olam_theme_preloader');
            if(isset($olamthemepreloader)&& $olamthemepreloader==1 ){  include('includes/preloader.php'); } ?>    
            <div class="wrapper">
              <div class="middle-area">
               <?php if(!is_front_page()) { 
                $headStyle=null;
                if(is_page()){
                 $pageHeadImage=wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                 if(isset($pageHeadImage[0]) && (strlen($pageHeadImage[0])>0) ){
                  $pageHeadImage=$pageHeadImage[0];
                }
                else{
                  $olampagebanner=olam_replace_site_url(get_theme_mod( 'olam_page_banner' )); 
                  if(isset($olampagebanner) && strlen($olampagebanner)>1 ){
                    $pageHeadImage=$olampagebanner;
                  }
                }
              }
              else{
                $olampagebanner=olam_replace_site_url(get_theme_mod( 'olam_page_banner' )); 
                if(isset($olampagebanner) && strlen($olampagebanner)>1 ){
                  $pageHeadImage=$olampagebanner;
                }
              }
              ?> 
              <div class="header-wrapper header-bg" style="background-image:url('<?php echo esc_url($pageHeadImage);?>');">
                <?php } else { ?>
                <div class="header-wrapper">
                  <?php } ?>
                  <!-- Header -->
                  <header id="header" class="header navbar-fixed-top">
                    <div class="container">
                    <?php 
            $olamlogocenter=get_theme_mod('olam_logo_center');
            if(isset($olamlogocenter)&& $olamlogocenter==1 ){?>  <div class="logo-center"><?php } 
              else {?>  <div><?php } 

              ?>

                      <div class="header-section">
                        <div class="header-wrap">
                          <div class="header-col col-logo">
                            <div class="logo">
                              <a href="<?php echo get_site_url(); ?>"> 
                               <?php $olamlogo=olam_replace_site_url(get_theme_mod( 'olam_theme_logo' )); ?> 
                               <img class="site-logo" src="<?php if(isset($olamlogo) && strlen($olamlogo)>0 ){ echo esc_url($olamlogo); } else { echo esc_url(get_template_directory_uri()).'/img/logo.png'; } ?>"  alt="<?php echo get_bloginfo('name'); ?>"> 
                             </a>
                           </div>
                         </div>
                         <div class="header-col col-nav">
                          <nav id="nav">
                            <?php if(has_nav_menu('header-top-menu')){ wp_nav_menu( array( 'theme_location' => 'header-top-menu') ); } ?> 
                            <ul class="shop-nav">
                              <li><?php if(!is_user_logged_in()){ ?> <a href="#" class="login-button login-trigger"><?php esc_html_e("Login","olam"); ?></a><?php } else { ?><a href="<?php echo wp_logout_url(home_url()); ?>" class="login-button"><?php esc_html_e('Logout','olam'); ?></a><?php  } ?></li>
                              <li>
                                <?php olam_print_mini_cart(); ?>
                              </li>
                            </ul>
                          </nav>
                        </div>

                        <div class="header-col col-shop">
                        </div>
                      </div>
                      <div class="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>
                      <!-- mobile navigation -->
                      <div class="mob-nav">
                      </div>
                    </div>
                    </div>
                  </div>
                </header>
                <!-- Header End -->
                <?php if(!is_front_page()) { ?>
                <!-- Search Section-->
                <?php $pageHeaderOption=olam_get_page_option(get_the_ID(),"olam_enable_header_search"); ?>
                <?php if(is_tax("download_category")|| is_tax("download_tag")||(($pageHeaderOption))||(is_search() && get_query_var('post_type')=="download")) { ?>
                <div class="section-first colored-section" data-speed="4" data-type="background">
                  <div class="container">
                    <div class="product-search">
                      <div class="product-search-form">
                        <form method="GET" action="<?php echo home_url(); ?>">
                          <?php   if(isset($olamcategoryfilter) && $olamcategoryfilter==1 ){  
                            $taxonomies = array('download_category');
                            $args = array('orderby'=>'count','hide_empty'=>true);
                            echo olam_get_terms_dropdown($taxonomies, $args);
                          } ?> 
                          <div class="search-fields">
                          <input name="s" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" type="text" placeholder="<?php esc_html_e('Search..','olam'); ?>">
                          <input type="hidden" name="post_type" value="download">
                          <span class="search-btn"><input type="submit"></span>
                          </div>
                        </form>
                      </div>
                      <span class="clearfix"></span>
                    </div>
                  </div>
                </div>
                <?php } 
              } ?>
              <!-- Search -->
            </div>