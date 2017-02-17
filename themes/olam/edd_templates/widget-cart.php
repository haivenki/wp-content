<?php
/**
 * This template is used to display the Downloads cart widget.
 */
$cart_items    = edd_get_cart_contents();
$cart_quantity = edd_get_cart_quantity();
$display       = $cart_quantity > 0 ? '' : ' style="display:none;"';
$cartclass       = $cart_quantity > 0 ? null : 'empty-cart-table';
?>
<p class="edd-cart-number-of-items"<?php echo esc_attr($display); ?>><?php esc_html_e( 'Number of items in cart', 'olam' ); ?>: <span class="edd-cart-quantity"><?php echo esc_html($cart_quantity); ?></span></p>
<table id="edd_checkout_cart" class="ajaxed <?php echo esc_attr($cartclass); ?>">
	<thead>
		<tr class="edd_cart_header_row">
			<th class="edd_cart_item_name"><?php esc_html_e("Item Name","olam"); ?></th>
			<th class="edd_cart_quantity"><?php esc_html_e("Item Quantity","olam"); ?></th>
			<th class="edd_cart_item_price"><?php esc_html_e("Item Price","olam"); ?></th>
			<th class="edd_cart_actions"><?php esc_html_e("Actions","olam"); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if( $cart_items ) : ?>
			<?php foreach( $cart_items as $key => $item ) : ?>
				<?php echo edd_get_cart_item_template( $key, $item, false ); ?>
			<?php endforeach; ?>
			<?php edd_get_template_part( 'widget', 'cart-checkout' ); ?>
		<?php else : ?>
			<?php edd_get_template_part( 'widget', 'cart-empty' ); ?>
		<?php endif; ?>
	</tbody>
</table>
<div class="text-right">
	<a href="<?php echo edd_get_checkout_uri(); ?>" class="btn btn-checkout right"><?php esc_html_e( 'Checkout', 'olam' ); ?></a>
	<span class="clearfix"></span>
</div>