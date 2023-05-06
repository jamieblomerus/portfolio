<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jamie_Blomerus_Portfolio
 */

if ( ! is_active_sidebar( 'footer-cf' ) ): ?>
	<p style="color: red; background-color: white;text-align: center;">There are no widgets in the footer-cf widget area.</p>
<?php else:
	dynamic_sidebar( 'footer-cf' );
endif;
?>