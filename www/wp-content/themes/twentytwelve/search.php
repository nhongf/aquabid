<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="Content InnerWrapper">
            	<div class="Wrapper">
                	<div class="MainContent">
                    	<div class="Content">
                        	<div class="HeaderImg">                            	
								<img title="Tìm kiếm" title="Tìm kiếm" src="<?php echo get_template_directory_uri(); ?>/images/contents/sub-imghead.jpg" width="960" height="200" />								
							</div>
							<div id="static">
                            	<div class="StaticTopPanel">
                                    <h2 class="TitleMain"></h2>
                                    <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
								</div>
								<div class="StaticOuter">							         
									<div class="StaticInner">
										<!--StaticMain-->
										<div class="StaticMain">
											<!-- Advanced search news -->
                                            <div id="boxTab">
                                            <div class="StaticOuter">
											<div class="StaticInner">
											<!--StaticMain-->
											<div class="StaticMain">
                                            	<?php 
                                                global $wp_query;                                                
                                                if ( have_posts() ) : ?>
                                    			<div class="pageSearch" style="clear: both; float: none; margin: 0;">
                                    				<p><?php printf( __( 'Tìm thấy %s  kết quả cho từ khóa: %s', 'twentytwelve' ), '<strong>' . $wp_query->post_count . '</strong>', '<span>' . get_search_query() . '</span>' ); ?></p>
                                   			      </div>
                                    			<?php /* Start the Loop */ ?>
                                                <ul class="ListEvent">
                                    			<?php while ( have_posts() ) : the_post(); ?>
                                    				<?php get_template_part( 'content', get_post_format() ); ?>
                                    			<?php endwhile; ?>
                                                </ul>
                                                <div class="PagingWrapper">
																<div class="PagingControl PagingControl2">
																	<div class="CenterWrapper">
                                    			<?php 
                                                
                                                $page = get_query_var('paged');
                                                $args = array(
                                                             'base' => add_query_arg( 'paged', '%#%' ),
                                                             'total' => $wp_query->max_num_pages,
                                                             'current' => $page);
                                                 echo wp_paging($args); ?>
                                                 </div>
                                                                    </div>
                                                                    </div>
                                               <?php else : ?>
                                                <div class="pageSearch">
                                                    <p><?php printf( __( 'Không tìm thấy kết quả cho từ khóa: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?> </p>	
                                                	<?php get_search_form(); ?>
                                                </div>
                                    		
                                    
                                    		<?php endif; ?>                                           									
											
                                            </div>
                                            </div>
                                            </div>
                                            </div>
											<!-- END. Advanced search news -->
                                        </div>			
                                    </div>					
								</div>
							</div>
						</div>
						<div class="Clear"></div>
					</div>
				</div>
			</div>
            
<?php get_footer(); ?>