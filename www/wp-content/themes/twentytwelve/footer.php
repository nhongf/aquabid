<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
        <div class="FooterWrapper">
				<div class="Wrapper">
					<div class="Copyright">Copyright © 2013. All rights reserved</div>
					<div class="Social">
						<p>
							<span><?php echo __("Chia sẻ")?></span>
                            <ul><li>
                            <span class='st_facebook_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='facebook'></span><span class='st_twitter_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='twitter'></span><span class='st_linkedin_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='linkedin'></span><span class='st_plusone_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='plusone'></span><span class='st_pinterest_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='pinterest'></span><span class='st_instagram_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='instagram'></span><span class='st_sharethis_large' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='sharethis'></span>
                            </li></ul>
						</p>
					</div>
				</div>
			</div>
		</div>
        <!--[if lt IE 8]>
		<![endif]-->		
		<!-- htmld2p:JS -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ga-donate.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/popupcenter.js"></script>		
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.custom.js"></script>
		<!-- htmld2p:END. JS -->
		<div class="PopupLogin" id="popupLogin">
			<div class="Top"></div>
			<div class="Body">
                 <?php dynamic_sidebar( 'user' ); ?>				                          
			</div>
			<div class="Bottom"></div>
		</div>        
		<?php wp_footer(); ?>
	</body>
</html>
