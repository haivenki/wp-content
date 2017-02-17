<?php
/**
 * The template for displaying the footer.
 * @package Olam
 */
?>

<?php $olamdata=of_get_options();  ?> 
</div>
<!-- wrapper --></div>
<?php 
$bgStyle=null;
$overLay=null;
$sectionBg=null;

if(isset($olamdata['olam_footer_background'])&&(strlen($olamdata['olam_footer_background']) >0 )) { 
 $overLay=' <div class="dark-overlay"></div>';
 $bgStyle='style="background-image:url(\''.esc_url($olamdata['olam_footer_background']).'\');"';
}
?>

<footer id="footer" class="<?php echo esc_attr($sectionBg); ?>" <?php echo ($bgStyle); ?>>   
  <?php echo wp_kses($overLay,array('div'=>array('class'=>array()))); ?>
  <div class="container">
   <?php  if ( is_active_sidebar( "olam-footer-area-1")){  ?>
   <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("olam-footer-area-1") ) : ?>
 <?php endif; ?>
 <?php } ?>
 <ul class="footer-social social-icons">
  <?php if(isset($olamdata['olam_fb_url'])&&(strlen($olamdata['olam_fb_url']) >0 )) { ?>   <li class="social-facebook"><a href="<?php echo esc_url($olamdata['olam_fb_url']); ?>"><span class="icon"><i class="demo-icon icon-facebook"></i></span></a></li> <?php } ?>
  <?php if(isset($olamdata['olam_youtube_url'])&&(strlen($olamdata['olam_youtube_url']) >0 )) { ?>   <li class="social-youtube"><a href="<?php echo esc_url($olamdata['olam_youtube_url']); ?>"><span class="icon"><i class="demo-icon icon-youtube"></i></span></a></li><?php } ?>
  <?php if(isset($olamdata['olam_twitter_url'])&&(strlen($olamdata['olam_twitter_url']) >0 ) ) { ?>    <li class="social-twitter"><a href="<?php echo esc_url($olamdata['olam_twitter_url']); ?>"><span class="icon"><i class="demo-icon icon-twitter"></i></span></a></li><?php } ?>
  <?php if(isset($olamdata['olam_linkedin_url'])&&(strlen($olamdata['olam_linkedin_url']) >0 ) ) { ?>   <li class="social-linkedin"><a href="<?php echo esc_url($olamdata['olam_linkedin_url']); ?>"><span class="icon"><i class="demo-icon icon-linkedin"></i></span></a></li><?php } ?>
  <?php if(isset($olamdata['olam_googleplus_url'])&& (strlen($olamdata['olam_googleplus_url']) >0 ) ) { ?>   <li class="social-google"><a href="<?php echo esc_url($olamdata['olam_googleplus_url']); ?>"><span class="icon"><i class="demo-icon icon-gplus"></i></span></a></li><?php } ?>
  <?php if(isset($olamdata['olam_instagram_url'])&& (strlen($olamdata['olam_instagram_url']) >0 ) ) { ?>   <li class="social-instagram"><a href="<?php echo esc_url($olamdata['olam_instagram_url']); ?>"><span class="icon"><i class="fa fa-instagram"></i></span></a></li><?php } ?>
</ul>
<?php  if ( is_active_sidebar( "olam-footer-area-2")){  ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("olam-footer-area-2") ) : ?>
<?php endif; ?>
<?php } ?>
<?php if(isset($olamdata['olam_footer_copy'])&& (strlen($olamdata['olam_footer_copy']) >0 ) ) { ?>  <div class="footer-text">&copy;  <?php echo esc_html($olamdata['olam_footer_copy']); ?> </div><?php } ?>
</div>
</footer>
<div class="scroll-top">
  <span class="scrollto-icon"><i class="demo-icon icon-rocket"></i></span>
  <span class="flame"></span>
  <span class="flame"></span>
  <span class="flame"></span>
</div>

<!-- Popup Login -->
<?php get_template_part('includes/popup-login'); ?>
<!-- Quick contact -->
<?php if(!isset($olamdata['olam_footer_support']) || $olamdata['olam_footer_support']!=1 ){ ?>
<?php  get_template_part('includes/quick-contact'); ?>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
