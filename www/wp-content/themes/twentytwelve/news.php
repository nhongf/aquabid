<?php
/*
Template Name: news
*/

get_header(); ?>

<?php while ( have_posts() ) : the_post(); 
$feature_image_id = get_post_thumbnail_id($id); 
$feature_image_meta = wp_get_attachment_image_src($feature_image_id, '32')  
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
                                            <ul id="tabHeader">
													<li class="<?php echo ($id==70)? 'Active':''?>"><a title="Tin tức" href="<?php echo esc_url( home_url( '/tin-tuc' ) ); ?>"><span>Tất cả</span></a></li>
													<li class="<?php echo ($id==629)? 'Active':''?>"><a title="Tin nhà tài trợ" href="<?php echo esc_url( home_url( '/tin-nha-tai-tro' ) ); ?>"><span>Tin nhà tài trợ</span></a></li>
													<li class="<?php echo ($id==632)? 'Active':''?>"><a title="Tin khách mời" href="<?php echo esc_url( home_url( '/tin-khach-moi' ) ); ?>"><span>Tin khách mời</span></a></li>													
											</ul>
                                            <div class="StaticOuter">
													<div class="StaticInner">
														<!--StaticMain-->
														<div class="StaticMain">
                                            <ul class="ListEvent">
                                            <?php 
                                            if($id ==70)
                                                $category = '1,8,9';
                                            elseif($id==629){//Tin nha tai tro
                                                $category = 9;
                                            }elseif(632){//Tin khach moi
                                                $category = 8;
                                            }
                                            $page = get_query_var('paged');
                                            $page = (($page>1)?$page:1);
                                            $posts_per_page = 10; //Number record
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
                                              <li>
                                                	<a href="<?php echo get_permalink($item->ID)?>" title="<?php echo $item->post_title?>"><span class="BorderSuKien">Avatar</span><?php echo get_the_post_thumbnail( $item->ID, 'category-thumb', array('title'	=> trim(strip_tags( $item->post_title )), 'alt'	=> trim(strip_tags( $item->post_title ))) ); ?></a>
                                                    <div class="EventContent">
                                                    <h3><a href="<?php echo get_permalink($item->ID)?>" title="<?php echo $item->post_title?>"><?php echo $item->post_title?></a></h3>  
                                                    <p class="Date"><?php echo mysql2date('d-m-y', $item->post_date)?> </p>
                                                    <div class="EShortContent"><?php echo wp_trim_words($item->post_content, 40, '...')?></div>
                                                    <div class="ViewMore"><a href="<?php echo get_permalink($item->ID)?>" title="Xem thêm">Xem thêm</a></div>
                                                    </div>
        										</li>
                                              <?php  
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