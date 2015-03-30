<?php
/*
Template Name: dau-gia
*/

get_header(); ?>

<?php while ( have_posts() ) : the_post(); 
$feature_image_id = get_post_thumbnail_id($id); 
$feature_image_meta = wp_get_attachment_image_src($feature_image_id, '32');
$timezone  = +7; //(GMT +7:00)  
$timeNow = strtotime(gmdate("Y-m-d H:i", time() + 3600*($timezone+date("0")))); 
$number =1;
 $aDate = array();
?>
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/auction.css" />
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
                                            <ul class="ListEvent">
                                            <?php 
                                            $category = 7;
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
                                                
                                                $timeStart = strtotime(get_field('thoi_gian_bat_dau', $item->ID));   
                                                $timeStop = strtotime(get_field('thoi_gian_ket_thuc', $item->ID));
                                            ?>
                                              <li>
                                                	<a href="<?php echo get_permalink($item->ID)?>" title="<?php echo $item->post_title?>"><span class="BorderSuKien">Avatar</span><?php echo get_the_post_thumbnail( $item->ID, 'category-thumb', array('title'	=> trim(strip_tags( $item->post_title )), 'alt'	=> trim(strip_tags( $item->post_title ))) ); ?></a>
                                                    <div class="EventContent">
                                                    <h3><a href="<?php echo get_permalink($item->ID)?>" title="<?php echo $item->post_title?>"><?php echo $item->post_title?></a></h3>                                                    
                                                    <?php
                                                    if($timeStart <= $timeNow && $timeStop > $timeNow){//Dang dien ra
                                                        $aDate[$number] = $timeStop;
                                                        echo '<p class="Date">Thời gian còn lại: </p><span id="defaultCountdown'.$number.'"></span>';
                                                        $number++;
                                                    } elseif ($timeStart > $timeNow) {//Chưa điễn ra
                                                        $aDate[$number] = $timeStart;
                                                        echo '<p class="Date">Thời gian bắt đầu: </p><span id="defaultCountdown'.$number.'"></span>';
                                                        $number++;
                                                    } else {
                                                        global $wpdb;
                                                        $sql = "UPDATE history_auction SET isActive =0 WHERE auction_id ='{$item->ID}'";
                                                        $wpdb->query($sql);
                                                        echo '<p class="Date">Phiên đấu giá đã kết thúc</p>';
                                                    }
                                                    ?>                                                    
                                                    <div class="EShortContent"><?php echo wp_trim_words($item->post_content, 40, '...')?></div>
                                                    <div class="ViewMore"><a href="<?php echo get_permalink($item->ID)?>" title="<?php _e("Đấu giá")?>"><?php _e("Đấu giá")?></a></div>
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
<?php
 endwhile; // end of the loop. ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.countdown.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.countdown-vi.js"></script>
<script type="text/javascript">
$(function () {
	<?php
    for($j=1; $j<$number; $j++){        
    ?>
	austDay = new Date(<?php echo date('Y', $aDate[$j])?>, <?php echo (date('m', $aDate[$j])-1)?>, <?php echo date( 'd', $aDate[$j])?>,<?php echo date('H', $aDate[$j])?>, <?php echo date('i', $aDate[$j])?>,<?php echo date('s', $aDate[$j])?>);    
	$('#defaultCountdown<?php echo $j?>').countdown({until: austDay,timezone: +7, serverSync:serverTime, onExpiry: liftOff});
    $.countdown.setDefaults($.countdown.regional['vi']);
    <?php
    }
    ?>
});

function serverTime() {    
    <?php
    $timezone  = +7; //(GMT +7:00)  
    $time = gmdate("M j, Y H:i:s", time() + 3600*($timezone+date("0")));
    ?>    
    var time = new Date('<?php echo $time?>');  
    return time; 
}
function liftOff() { 
    window.location.reload();
}
</script>
<?php get_footer(); ?>