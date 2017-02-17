   <?php
   $eddColumn=get_theme_mod('olam_edd_columns');
  // var_dump($eddColumn);
   switch ($eddColumn) {
   	case '2 columns':
   	$colsize=6;
   	$division=2;
   	$colclass="col-sm-6";
   	break;
   	case '3 columns':
   	$colsize=4;
   	$division=3;
   	$colclass=null;
   	break;
   	case '4 columns':
   	$colsize=3;
   	$division=4;
   	$colclass="col-sm-6";
   	break;
   	default:
    $colclass=null;
   	break;
   }
   if(($wp_query->current_post)%($division)==0){ echo "<div class='row'>"; } ?>
   <div class="col-md-<?php echo $colsize; ?> <?php echo $colclass; ?>">
   	<div class="edd_download_inner">
   		<div class="thumb">
   			<?php $videoCode=get_post_meta(get_the_ID(),"download_item_video_id"); 
   			$audioCode=get_post_meta(get_the_ID(),"download_item_audio_id");
   			if(isset($videoCode[0]) && (strlen($videoCode[0])>0) ){
   				$videoUrl=wp_get_attachment_url($videoCode[0]);  
   				?>
   				<div class="media-thumb">
   					<?php echo do_shortcode("[video src='".$videoUrl."']"); ?>
   				</div> <?php
   			}
   			else if(isset($audioCode[0]) && (strlen($audioCode[0])>0) ){
   				$audioUrl=wp_get_attachment_url($audioCode[0]);
   				?>
   				<div class="media-thumb">
   					<?php echo do_shortcode("[audio src='".$audioUrl."']"); ?>
   				</div><?php
   			} ?>
   			<a href="<?php the_permalink(); ?>"><span><i class="demo-icons icon-link"></i></span>
   				<?php
   				if ( has_post_thumbnail() ) {
   					the_post_thumbnail('olam-product-thumb');
   				}
   				else {
   					echo '<img src="' . get_template_directory_uri(). '/img/thumbnail-default.jpg" />';
   				}
   				?>
   			</a>
   		</div>		
   		<div class="product-details">
   			<?php	$defaultPriceID=edd_get_default_variable_price( get_the_ID() ); ?>
   			<div class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
   			<div class="product-price"><?php edd_price(get_the_ID(),true,$defaultPriceID); ?></div>
            <?php echo olam_get_edd_sale_count(get_the_ID()); ?><span> <?php esc_html_e("Sales","olam"); ?>
            <?php $previewLink=get_post_meta(get_the_ID(),'preview_url');  ?><?php if(isset($previewLink[0])&& (strlen($previewLink[0])>0) ) { ?> <a target="_blank" href="<?php echo esc_url($previewLink[0]); ?>" class="active"><i class="demo-icons icon-eye"></i><?php esc_html_e('Live Preview','olam'); ?></a> <?php } ?>
            <div class="details-bottom">
   				<div class="product-options">
   					<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('View','olam'); ?> "><i class="demo-icons icon-search"></i>Download</a>                                            

   					<?php if(!olam_check_if_added_to_cart(get_the_ID())){
   						$eddOptionAddtocart=edd_get_option( 'add_to_cart_text' );
   						$addCartText=(isset($eddOptionAddtocart) && $eddOptionAddtocart  != '') ?$eddOptionAddtocart:esc_html__("Add to cart","olam");
   						if(edd_has_variable_prices(get_the_ID())){

   							$downloadArray=array('edd_action'=>'add_to_cart','download_id'=>$post->ID,'edd_options[price_id]'=>$defaultPriceID);
   						}
   						else{
   							$downloadArray=array('edd_action'=>'add_to_cart','download_id'=>$post->ID);
   						}
   						?>	
   						<a href="<?php echo esc_url(add_query_arg($downloadArray,edd_get_checkout_uri())); ?>" title="<?php esc_attr_e('Buy Now','olam'); ?>"><i class="demo-icons icon-download"></i>Buy Now</a>
   						<a href="<?php echo esc_url(add_query_arg($downloadArray,olam_get_current_page_url())); ?>" title="<?php echo esc_html($addCartText); ?>"><i class="demo-icons icon-cart"></i>Add To Cart</a>                                    
   						<?php } else { ?>
   						<a class="cart-added" href="<?php echo edd_get_checkout_uri(); ?>" title="<?php esc_attr_e('Checkout','olam'); ?> "><i class="fa fa-check"></i></a>    
   						<?php } ?>
   					</div>

         <div class="product-author"><a href="<?php echo esc_url(add_query_arg( 'author_downloads', 'true', get_author_posts_url( get_the_author_meta('ID')) )); ?>"><?php esc_html_e('','olam'); ?>                      <?php    $avatarCustom=get_the_author_meta('authorbanner', $author);
         $avatarFES=get_the_author_meta('user_avatar', $author);
         if(isset($avatarCustom) && (strlen($avatarCustom)>0) ){
            $avatarUrl=$avatarCustom;
         }
         else if(isset($avatarFES) && (strlen($avatarFES)>0) ){
            $avatarUrl=$avatarFES;
         }
         else if(isset($author->user_email)&&olam_validate_gravatar($author->user_email)){
            $avatarUrl=get_avatar_url($author);
         }
         if( isset($avatarUrl) && (strlen($avatarUrl)>0) ) { ?>  <div class="author-pic"><img src="<?php echo esc_url($avatarUrl) ?>" alt=""></div><?php } ?> <?php the_author(); ?></a></div>
   				</div>
   			</div>
   		</div>
   	</div>
   	<?php if(($wp_query->current_post+1)%($division)==0){  echo "</div>"; }
   	else if(($wp_query->current_post+1)==$wp_query->post_count ){ echo "</div>"; }