<?php

if(!olam_check_edd_exists()){
	return;
}

add_action('widgets_init', 'olam_fes_fields_widget');

function olam_fes_fields_widget()
{
	register_widget('olam_fes_fields_widget');
}

class olam_fes_fields_widget extends WP_Widget {

	function __construct()
	{
		$widget_ops = array('classname' => 'olam_fes_fields_widget', 'description' => esc_html__('Displays Front end submissions fields, used in Single Download Sidebar','olam'));
		$control_ops = array('id_base' => 'olam_fes_fields_widget');
		parent::__construct('olam_fes_fields_widget', esc_html__('Olam FES Fields','olam'), $widget_ops, $control_ops);
		
	}

	function widget($args, $instance)
	{
		extract($args);
		$title = $instance['title'];
		echo $before_widget;
		?>
		<div class="sidebar-item">
			<div class="cart-sidebar-widget">
				<div class="cw-title"><?php echo esc_html($title); ?>
				</div>
					<?php
					global $post;

					if( $post->post_type != 'download' || !function_exists('EDD_FES') ){
						return;
					}

					$form_id     = EDD_FES()->helper->get_option( 'fes-submission-form', false );

					if ( !$form_id ) {
						return ;
					}
					$form = EDD_FES()->helper->get_form_by_id( $form_id, $post->ID );
					unset($form->fields['download_item_thumbnail_id']);
					unset($form->fields['preview_url']);
					unset($form->fields['subheading']);
					$html = $form->display_fields();
					echo  $html;
					?>
			</div>
		</div>
			<?php
			echo $after_widget;
		}

		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}

		function form($instance)
		{
			$defaults = array('title' => esc_html__('Details','olam') );
			$instance = wp_parse_args((array) $instance, $defaults); ?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title','olam');?>:</label>
				<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			<?php }
		}