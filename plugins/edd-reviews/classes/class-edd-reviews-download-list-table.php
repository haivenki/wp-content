<?php
/**
 * EDD Reviews Download List Table
 *
 * This is the class for the list table shown on the edit.php screen
 *
 * @package EDD_Reviews
 * @subpackage Admin
 * @copyright Copyright (c) 2016, Sunny Ratilal
 * @since 2.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Load WP_List_Table if not loaded
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

if ( ! class_exists( 'EDD_Reviews_Download_List_Table' ) ) :

/**
 * EDD_Reviews_Download_List_Table Class
 *
 * @package EDD_Reviews
 * @since 2.0
 * @version 1.0
 * @author Sunny Ratilal
 * @see WP_List_Table
 */
class EDD_Reviews_Download_List_Table extends EDD_Reviews_List_Table {
	/**
	 * Number of reviews to show per page
	 *
	 * @var string
	 * @since 2.0
	 */
	public $per_page = 10;

	/**
	 *
	 * @return array
	 */
	protected function get_column_info() {
		return array(
			array(
				'review'  => _x( 'Review', 'column name', 'edd-reviews' ),
				'rating' => _x( 'Rating', 'column name', 'edd-reviews' )
			),
			array(),
			array(),
			'review',
		);
	}

	/**
	 *
	 * @return array
	 */
	protected function get_table_classes() {
		$classes = parent::get_table_classes();
		$classes[] = 'wp-list-table';
		$classes[] = 'edd-reviews-box';
		return $classes;
	}

	/**
	 *
	 * @param bool $output_empty
	 */
	public function display( $output_empty = false ) {
		$singular = $this->_args['singular'];
?>
<table class="<?php echo implode( ' ', $this->get_table_classes() ); ?>">
	<tbody>
		<?php $this->display_rows_or_placeholder(); ?>
	</tbody>
</table>
<?php
	}
}

endif;