<?php
/*
Template Name: Downloads (3 Column)
 */
get_header(); ?>

<?php if(!olam_check_edd_exists()){ ?>
<p><b><?php  esc_html_e("Please install Easy Digital Downloads","olam"); ?></b></p>
<?php } else { ?>
<div class="section">
    <div class="container">
        <div class="page-head ">
            <?php while ( have_posts() ) : the_post(); ?>
            <h1>  <?php $altTitle=olam_get_page_option(get_the_ID(),"olam_page_alttitle"); 
            if(isset($altTitle) && (strlen($altTitle)>0 ) ) { 
               echo wp_kses($altTitle,array('span'=>array('class'=>array()))); 
           } else{
            the_title(); 
        }  ?> </h1>         
        <?php $pageSubs=olam_get_page_option(get_the_ID(),"olam_page_subtitle"); 
        if(isset($pageSubs) && (strlen($pageSubs)>0 )) { ?>
        <div class="page_subtitle"> <?php  echo esc_html($pageSubs); ?></div>
        <?php  } ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>
<div class="row">
    <?php $downloadColumn=12; ?>
    <?php  if ( is_active_sidebar( 'olam-download-category-sidebar' )){ 
        $downloadColumn=9;
        ?>
        <div class="col-md-3">
           <div class="sidebar">
               <?php dynamic_sidebar( 'olam-download-category-sidebar' ); ?>
           </div>
       </div>
       <?php } ?>  
       <div class="col-md-<?php echo esc_attr($downloadColumn); ?> col-right">
        
          <?php 
          $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1; 
          if ( ! isset( $wp_query->query['orderby'] ) ) { 
            $args = array( 
                'orderby' => 'date', 
                'order' => 'DESC', 
                'post_type' => 'download',
                'paged' => $paged );
        } else { 
            switch ($wp_query->query['orderby']) { 
                case 'date': 
                $args = array( 
                    'orderby' => 'date', 
                    'order' => 'DESC', 
                    'post_type' => 'download',
                    'paged' => $paged ); 
                break; 
                case 'sales': 
                $args = array( 
                    'meta_key'=>'_edd_download_sales', 
                    'order' => 'DESC', 
                    'orderby' => 'meta_value_num',
                    'post_type' => 'download', 
                    'paged' => $paged ); 
                break; 
                case 'price': 
                $args = array( 
                    'meta_key'=>'edd_price', 
                    'order' => 'ASC', 
                    'orderby' => 'meta_value_num', 
                    'post_type' => 'download', 
                    'paged' => $paged ); 
                break; 
            } } 
            $temp = $wp_query; $wp_query = null; 
            $wp_query = new WP_Query(); $wp_query->query($args); while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <?php get_template_part('includes/loop-shop-listings'); ?>
            
        <?php endwhile; ?>

        <div class="pagination">
            <?php
            if (function_exists("olam_pagination")) {
                olam_pagination();
            }
            ?>
        </div>
    </div>
</div>
</div>
</div>
<?php } ?>

<?php get_footer(); ?>