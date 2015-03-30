<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
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
                            	<a href="#" title="<?php the_title(); ?>">
								<img title="Tìm kiếm" title="Tìm kiếm" src="<?php echo get_template_directory_uri(); ?>/images/contents/sub-imghead.jpg" width="960" height="200" />
								<span class="Mask">&nbsp;</span>
                                </a>
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
                                            
                                                <div class="pageSearch">
                                                    <p><?php printf( __( 'Không tìm thấy trang này, bạn có thể sử dụng tìm kiếm', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?> </p>	
                                                	<?php get_search_form(); ?>
                                                </div>
                                    		
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