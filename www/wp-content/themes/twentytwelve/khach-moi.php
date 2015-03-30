<?php
/*
Template Name: khach-moi
*/

get_header(); ?>

<?php while ( have_posts() ) : the_post(); 
$feature_image_id = get_post_thumbnail_id($id); 
$feature_image_meta = wp_get_attachment_image_src($feature_image_id, '30')  
?>

<div class="Content InnerWrapper">
            	<div class="Wrapper">
                	<div class="MainContent">
                    	<div class="Content">
                        	<div class="HeaderImg">                            	
								<img title="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo $feature_image_meta[0]?>" width="960" height="200" />								
							</div>
							<div id="static">
                            	<div class="StaticTopPanel">
                                    <h2 class="TitleMain"><?php the_title(); ?></h2>
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
                                            <ul class="ListGuests">
                                            <?php 
                                            $i = 1;
                                            $category = 6;
                                            $page = get_query_var('paged');
                                            $page = (($page>1)?$page:1);
                                            $posts_per_page = 9; //Number record
                                            $numberposts = 5;
                                            $offset = $posts_per_page*($page-1);                                            
                                            $args = array(
                                        	'posts_per_page'  => $posts_per_page,
                                        	'numberposts'     => $numberposts,
                                        	'offset'          => $offset,
                                        	'category'        => $category,
                                        	'orderby'         => 'post_date',
                                        	'order'           => 'DESC',
                                        	'include'         => '',
                                        	'exclude'         => '',
                                        	'meta_key'        => '',
                                        	'meta_value'      => '',
                                        	'post_type'       => 'post',
                                        	'post_mime_type'  => '',
                                        	'post_parent'     => '',
                                        	'post_status'     => 'publish',
                                        	'suppress_filters' => true ); 
                                            $postsNews = get_posts( $args );
                                            if(count($postsNews)>0){
                                            foreach($postsNews as $key=>$item){                                        
                                            ?>
                                            <li <?php echo ($i%3 == 0)?'class="LastCol"':''?>>
												<a title="<?php echo $item->post_title?>" href="<?php echo get_permalink($item->ID)?>">												
                                                <?php echo get_the_post_thumbnail( $item->ID, 'guest-thumb', array('title'	=> trim(strip_tags( $item->post_title )), 'class'=>'Image', 'alt'	=> trim(strip_tags( $item->post_title ))) ); ?>
												<span class="Mask">Xem chi tiết</span>
                                                </a>
                                                <p class="Descript">
                                                	<a href="#" title="<?php echo $item->post_title?>" class="Name"><?php echo $item->post_title?></a>
													<br />
                                                    <span class="RoleDescription"><?php the_field('nghe_nghiep', $item->ID)?></span>
												</p>
											</li>
                                             
                                              <?php
                                              if($i%3 == 0)
                                                $i=1;
                                              else 
                                                $i++;
                                            } 
                                            
                                            ?>
                                            </ul>
                                            <div class="PagingWrapper">
																<div class="PagingControl PagingControl2">
																	<div class="CenterWrapper">
                                                                    <?php            
                                                                    $posts_query = new WP_Query("cat={$category}&post_type=post&posts_per_page={$posts_per_page}&paged=".$page);                                                                                                                      
                                                                    $args = array(
                                                                             'base' => add_query_arg( 'paged', '%#%' ),
                                                                             'total' => $posts_query->max_num_pages,
                                                                             'current' => $page                                                                           
                                                                             
                                                                        );
                                                                    echo wp_paging($args); ?>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                            <?php } else{
                                               echo '<center>Không tìm thấy bài viết nào!</center>'; 
                                            }?>
											
											
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
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>