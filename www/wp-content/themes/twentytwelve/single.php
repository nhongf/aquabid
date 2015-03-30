<?php  
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

while ( have_posts() ){
the_post();
$category = the_category_ID(false);
if($category ==7){//Neu là chi tiết đấu giá thì hiển thị captcha
    $timezone  = +7; //(GMT +7:00)  
    $timeNow = strtotime(gmdate("Y-m-d H:i", time() + 3600*($timezone+date("0")))); 
    $timeStart = strtotime(get_field('thoi_gian_bat_dau'));   
    $timeStop = strtotime(get_field('thoi_gian_ket_thuc'));	
    
    if ( is_user_logged_in() ) { //Kiem tra login        
        $msg = '';
        $aMsg = array();
        $captcha = new ReallySimpleCaptcha();
        $captcha_word = $captcha -> generate_random_word(); //generate a random string with letters
        $captcha_prefix = mt_rand(); //random number
        $captcha_image = $captcha -> generate_image($captcha_prefix, $captcha_word); //generate the image file. it returns the file name
        $captcha_file = rtrim(get_bloginfo('wpurl'), '/') . '/wp-content/plugins/really-simple-captcha/tmp/' . $captcha_image; //construct the absolute URL of the captcha image
        
        if (!empty($_POST)) { //data has been posted by the user, lets check whats going on
                $buocgia = intval($_POST['buoc_gia']);                
                if($buocgia < 1 || $buocgia >3){
                    $msg = __("Bạn chọn bước giá không hợp lệ"); //the captcha has been proven as correct
                }elseif($timeStart > $timeNow){
                    $msg = __("Thời gian đấu giá chưa bắt đầu"); 
                }elseif($timeStop < $timeNow){
                    $msg = __("Thời gian đấu giá đã kết thúc"); 
                }elseif (empty($_POST['captcha'])) {
                    $msg = __("Chưa nhập mã bảo vệ"); //the captcha has been proven as correct
                }elseif (!$captcha -> check($_POST['captcha_prefix'], $_POST['captcha'])) {
                    $msg = __("Mã bảo vệ không chính xác"); //the captcha has been proven as correct
                }
                if(empty($msg)){   
                    global $wpdb, $current_user;
                    get_currentuserinfo();
                    $giaKD = get_field('gia_khoi_diem');
                    $giaBuocGia = get_field('buoc_gia');
                    $gia = $buocgia*$giaBuocGia;
                    $auctionId = get_the_ID();
                    //Lay gia hien tai cao nhat
                    $currentMoney = $wpdb->get_var( "SELECT max(money_auction) FROM history_auction WHERE auction_id ='{$auctionId}'" );
                    $currentMoney = ($currentMoney <=0 ) ? $giaKD : $currentMoney;
                    $data = array(                    
                    'user_id'       => $current_user->ID,
                    'username'      => $current_user->user_login,
                    'auction_id'    => $auctionId,
                    'money_current' => $currentMoney,
                    'level_auction' => $buocgia,
                    'money_auction' => $gia + $currentMoney,
                    'date_auction'  => time()
                    );                    
                    $status = $wpdb->insert('history_auction', $data);
                    if($status == 1)
                    {
                        $msg = __('Bạn đã đấu giá thành công');
                        $aMsg = array(1, $msg, $captcha_file, $captcha_prefix); 
                    } else{
                        $msg = __('Hệ thống hiện tại đang quá tải, bạn vui lòng đấu giá lại sau ít phút');
                        $aMsg = array(0, $msg, $captcha_file, $captcha_prefix);
                    }               
                } else{
                    $aMsg = array(0, $msg, $captcha_file, $captcha_prefix);
                }
                $captcha->remove($_POST['captcha_prefix']);
                echo json_encode($aMsg);
                exit();
        }    
    }
    
}
get_header(); 
?>

<?php
if($category ==6){
$feature_image_id = get_post_thumbnail_id(30); 
}if ($category == 7){
    $feature_image_id = get_post_thumbnail_id(33); 
}    
else {
    $feature_image_id = get_post_thumbnail_id(70);
}  
$feature_image_meta = wp_get_attachment_image_src($feature_image_id, '32');
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
                                    <h2 class="TitleMain"><?php 
                                    if($category == 6){
                                        esc_html_e('Khách mời');
                                    } elseif ($category == 7){
                                        esc_html_e('Phiên đấu giá');
                                    } else {
                                        the_title();
                                    }                                         
                                    ?>
                                    </h2>
                                    <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
								</div>								
                                <?php                    
                                if($category == 6){
                                    get_template_part('guest-detail'); 
                                } elseif ($category == 7){
                                    get_template_part('dau-gia-detail'); 
                                }else{
                                    get_template_part( 'news-detail');
                                }    
                                ?>                                
                                
							</div>
						</div>
						<div class="Clear"></div>
					</div>
				</div>
			</div>

<?php } get_footer(); ?>