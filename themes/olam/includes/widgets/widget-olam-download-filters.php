<?php

if(!olam_check_edd_exists()){
	return;
}

add_action('widgets_init', 'olam_download_filters');

function olam_download_filters()
{
	register_widget('olam_download_filters');
}

class olam_download_filters extends WP_Widget {
	
	function __construct()
	{
		$widget_ops = array('classname' => 'olam_download_filters', 'description' =>esc_html__('Displays download item filters. Used in Download Category Sidebar','olam'));
		$control_ops = array('id_base' => 'olam_download_filters');
		parent::__construct('olam_download_filters', esc_html__('Olam download Filters','olam'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		echo $before_widget;
		?>
		<div class="filter-by">
			<?php 
			$activeNewest=null;
			$activeCheapest=null;
			$activeBest=null;
			if(isset($_GET['orderby'])){
				if($_GET['orderby']=="price"){
					$activeCheapest="active";
				}
				else if($_GET['orderby']=="date"){
					$activeNewest="active";
				}
				else if($_GET['orderby']=="sales"){
					$activeBest="active";
				}
			}
			else{
				$activeNewest="active";;
			} ?>
			<a class="<?php echo esc_html($activeNewest); ?>" href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'date'))); ?>"><?php esc_html_e('Newest Items','olam'); ?> <span></span></a>
			<a class="<?php echo esc_html($activeCheapest); ?>" href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'price'))); ?>"><?php esc_html_e('Cheapest','olam'); ?> <span></span></a>
			<a class="<?php echo esc_html($activeBest); ?>" href="<?php echo esc_url(add_query_arg(array( 'orderby'=>'sales'))); ?>"><?php esc_html_e('Best Selling','olam'); ?> <span></span></a>
		</div>
		<?php
		echo $after_widget;
	}
}
