<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="Content InnerWrapper">
            	<div class="Wrapper">
                	<div class="MainContent">
                    	<div id="boxEvent" class="BigSlider Slider">
                            <?php do_action('slideshow_deploy', '41'); ?>
						</div>
                        <div class="Content">
                            
                            <div class="DivContent">  
                                <div class="ContentLeft NewsBlock">
                                <h3><a onclick="_gaq.push(['_trackEvent','ContentBlock', 'Tin tuc', 'MainSite']);" href="tin-tuc" title="Tin mới">Tin mới</a><a onclick="_gaq.push(['_trackEvent','ContentBlock', 'Tin tuc', 'MainSite']);" class="ViewMore" href="tin-tuc" title="Xem thêm"><span>Xem thêm</span></a></h3>
                                 <ul>
                                    <?php 
                                    $args = array(
                                	'posts_per_page'  => 2,
                                	'numberposts'     => 2,
                                	'offset'          => 0,
                                	'category'        => '1',
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
                                    'meta_key' => 'display_home_page',
	                                'meta_value' => '1',
                                	'suppress_filters' => true ); 
                                    $postsNews = get_posts( $args );
                                    foreach($postsNews as $key=>$item){                                        
                                      ?>
                                      <li>
                                        	<a href="<?php echo get_permalink($item->ID)?>" class="Image" title="<?php echo $item->post_title?>"><?php echo get_the_post_thumbnail( $item->ID, 'homepage-thumb', array('title'	=> trim(strip_tags( $item->post_title )), 'alt'	=> trim(strip_tags( $item->post_title ))) ); ?></a>
                                            <h4><a href="<?php echo get_permalink($item->ID)?>" title="<?php echo $item->post_title?>"><?php echo __getSubString($item->post_title,35)?></a>  <span class="Date">[ <?php echo mysql2date('d - m', $item->post_date)?> ]</span></h4>
                                            <span class="ShortDescr"><?php echo wp_trim_words($item->post_content, 20, '...')?></span>
										</li>
                                      <?php  
                                    } 
                                    
                                    ?>
									</ul>
								</div>                      		
                        		<div class="ContentRight AutionBlock">
                                	<h3><a href="<?php echo home_url( '/phien-dau-gia' )?>" title="Phiên đấu giá">Phiên đấu giá</a><a class="ViewMore" href="<?php echo home_url( '/phien-dau-gia' )?>" title="Xem thêm"><span>Xem thêm</span></a></h3>
                                    <ul>
                                     <?php 
                                    $args = array(
                                	'posts_per_page'  => 2,
                                	'numberposts'     => 2,
                                	'offset'          => 0,
                                	'category'        => 7,
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
                                    if(count($postsNews)){
                                    foreach($postsNews as $key=>$item){                                        
                                      ?>
                                      <li>
                                            <h4><a href="<?php echo get_permalink($item->ID)?>" title="<?php echo $item->post_title?>"><?php echo $item->post_title?></a></h4>
                                           	<span class="OpenTime"><?php $date = date_create(get_field('thoi_gian_bat_dau',$item->ID)); _e("Thời gian diễn ra"); echo ': '.date_format( $date, 'H:i d/m/Y'); ?>
                                               <?php $date = date_create(get_field('thoi_gian_ket_thuc',$item->ID)); echo ' - '.date_format( $date, 'H:i d/m/Y'); ?>
                                               </span>
                                            
                                            <span class="ShortDescr"><?php echo wp_trim_words($item->post_content, 10, '...')?></span>
										</li>                                      
                                      <?php  
                                    } }else
                                    {
                                        echo "<li><br/><br/><br/><center>".__("Nội dung đang được cập nhật")."</center></li>";
                                    }
                                    
                                    ?>                                    	
									</ul>
								</div>
                                
							</div>
                            <div class="DivContent">
                        		<div class="ContentLeft ShortIntro">
                                    <?php
                                        $about = get_page( 2 )
                                    ?>
                                	<h3 class="NoBackground"><a onclick="_gaq.push(['_trackEvent','ContentBlock', '<?php echo $about->post_title?>', 'MainSite']);" href="<?php echo get_permalink($about->ID)?>" title="<?php echo $about->post_title?>"><?php echo $about->post_title?></a></h3>
                                    <p class="First">
                                    <?php echo wp_trim_words($about->post_content, 150, '...')?>
									</p>
									<div class="Clear"></div>
                                    <a onclick="_gaq.push(['_trackEvent','ContentBlock', '<?php echo $about->post_title?>', 'MainSite']);" class="ViewMore" href="<?php echo get_permalink($about->ID)?>" title="Xem thêm"><span>Xem thêm</span></a>
									<div class="Clear"></div>
								</div>
                        		<div class="ContentRight VideoBlock">
                                	<?php dynamic_sidebar( 'video-home' ); ?>
								</div>
							</div>
						</div>
                        <div class="Donator">
                        	<div class="CurvedTop">&nbsp;</div>
                        	<div class="Wrapper">     
                                <div class="Block"><?php dynamic_sidebar( 'donvitochuc' ); ?></div>                           
                                <div class="Block"><?php dynamic_sidebar( 'partner' ); ?></div>
								 <div class="Block">
                                    <?php dynamic_sidebar( 'nha_tai_tro_vang' ); ?>
                                 </div>
							</div>
							<div class="CurvedBottom">&nbsp;</div>
						</div>
						<div class="Clear"></div>
					</div>
				</div>
			</div>
<?php get_footer(); ?>