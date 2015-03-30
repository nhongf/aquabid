<div class="StaticOuter">
<div class="StaticInner">
	<div class="StaticMain">
		<div class="GuestDetail">
        	<div class="Image">
            	<?php the_post_thumbnail( 'guest-full', array('title'	=> trim(strip_tags( $item->post_title )), 'class'=>'', 'alt'	=> trim(strip_tags( $item->post_title ))) ); ?>
			</div>
			<div class="Detail HasImage">
            	<h3><?php the_title();?></h3>
                <!--<ul class="ListDetail">					
					<li><?php  esc_html_e('Ngày sinh')?>: <strong><?php //the_field('nam_sinh');?></strong></li>
					<li><?php  esc_html_e('Nghề nghiệp')?>: <strong><?php //the_field('nghe_nghiep');?></strong></li>
					<li><?php  esc_html_e('Sở thích')?>: <strong><?php //the_field('so_thich');?></strong></li>
					<li><?php  esc_html_e('Phương châm sống')?>: <strong><?php //the_field('phuong_cham_song');?></strong></li></li>
					<li><?php  esc_html_e('Châm ngôn ưa thích')?>: <strong><?php //the_field('cham_ngon_uu_thich');?></strong></li>

					
				</ul>-->
			</div>
             
		</div>
        <div class="Clear"></div>	
             <div class="detailGuest">
						<p class="title"><?php  esc_html_e('Thông tin khác')?>:	</p>					
                        <?php the_content()?>
			</div>        
        <div class="Clear"></div>		
            <?php                                
            $category = the_category_ID(false);    
            $id = get_the_ID();        
            $page = get_query_var('paged');
            $page = (($page>1)?$page:1);
            $posts_per_page = 4; //Number record
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
            ?>
            <div class="MoreGuests">
			<h3><span><?php esc_html_e('Những khách mời khác')?></span></h3>
			<ul>
            <?php
            foreach($postsNews as $key=>$item){                                        
            ?>  
            <li>
					<a href="<?php echo get_permalink($item->ID)?>" title="<?php echo $item->post_title?>">
						<?php echo get_the_post_thumbnail($item->ID, 'guest-thumb', array('title'	=> trim(strip_tags( $item->post_title )), 'class'=>'Image', 'alt'	=> trim(strip_tags( $item->post_title ))) ); ?>                        
						<span class="Mask"><?php esc_html_e('Xem chi tiết')?></span>
					</a>
					<p class="Descript">
						<a class="Name" title="<?php echo $item->post_title?>" href="#"><?php echo $item->post_title?></a>
						<!-- <br>
						<span class="RoleDescription">Chức vụ: CEO Founder</span> -->
					</p>
				</li>                                   
              
              <?php  
            }
            ?>
            </ul>
    		</div>
            <div class="Clear"></div>        	
                <?php
            } 
           
?>					
</div>
</div>
</div>
			
