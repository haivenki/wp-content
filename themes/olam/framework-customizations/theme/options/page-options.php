<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
	'olam_page_subtitle' => array(
		'label' => esc_html__( 'Page Subtitle', 'olam' ),
		'type'  => 'text',
		'desc'  => esc_html__( 'Enter the subtitle','olam' ),
		),
	'olam_page_alttitle' => array(
		'label' => esc_html__( 'Page Alternate title', 'olam' ),
		'type'  => 'text',
		'desc'  => esc_html__( 'Alternate page title. This will override the default page title, keep blank if not needed','olam' ),
		),
	'olam_enable_header_search' => array(
		'label' => esc_html__( 'Enable header search section', 'olam' ),
		'type'  => 'checkbox',
		'desc'  => esc_html__( 'Enter header search section','olam' ),
		),
	);
