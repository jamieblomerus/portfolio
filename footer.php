<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jamie_Blomerus_Portfolio
 */

?>
<footer data-anchor="contact" class="section">
    <div class="content">
        <div class="contact-form">
            <h2>Send me a message</h2>
			<p>Got a question or proposal, or wanna say hi? Send me a message and I'll get back to you as soon as possible.</p>
			<?php get_sidebar( 'footer-cf' ); ?>
        </div>
    </div>
	<div class="footerbar">
		<p class="copyright">© <?php echo date("Y"); ?> Jamie Blomerus, All rights reserved.</p>
		<p class="email">Email me at: <a href="mailto:jamie.blomerus@protonmail.com">jamie.blomerus@protonmail.com</a></p>
		<p class="phone">Call me at: <a href="tel:+46735004889">+46 (0) 73 500 48 89</a></p>
	</div>
</footer>


</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
