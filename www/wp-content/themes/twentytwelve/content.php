<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

 <li>
<a href="<?php the_permalink()?>" title="<?php the_title()?>"><span class="BorderSuKien">Avatar</span><?php the_post_thumbnail('category-thumb') ?></a>
<div class="EventContent">
<h3><a href="<?php the_permalink()?>" title="<?php the_title()?>"><?php the_title()?></a></h3>  
<p class="Date"><?php echo mysql2date('d-m-y', $item->post_date)?> </p>
<div class="EShortContent"><?php the_excerpt()?></div>
<div class="ViewMore"><a href="<?php echo the_permalink()?>" title="Xem thêm">Xem thêm</a></div>
</div>
</li>
    