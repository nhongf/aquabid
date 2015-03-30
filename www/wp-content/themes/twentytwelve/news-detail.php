<div class="StaticOuter">
<?php
the_content(); 
?>   
</div>
<div class="BlockListNews">
	<h4><?php  esc_html_e('Các tin liên quan')?></h4>
    <?php
    echo '<ul class="ListNews">';            
    $category = the_category_ID(false);   
    $page = get_query_var('paged');
    $id = get_the_ID();    
    $page = (($page>1)?$page:1);
    $posts_per_page = 8; //Number record
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
	'suppress_filters' => true,
    'post__not_in'    => array($id)); 
    $postsNews = get_posts( $args );
    if(count($postsNews)>0){
    foreach($postsNews as $key=>$item){                                        
    ?>                                      
      <li><a title="" href="<?php echo get_permalink($item->ID)?>"><span class="Date"><?php echo mysql2date('d-m-y', $item->post_date)?></span><?php echo $item->post_title?></a></li>
      <?php  
    }
    } 
    echo '</ul>';
    ?>																
</div> 