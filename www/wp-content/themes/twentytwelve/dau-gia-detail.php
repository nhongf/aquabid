<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/auction.css" />
<div class="StaticOuter">
<div class="StaticInner">
	<div class="StaticMain">
		<div class="AutionDetail">
        	<div class="Image">
            	<?php the_post_thumbnail( 'guest-full', array('title'	=> trim(strip_tags( $item->post_title )), 'class'=>'Image', 'alt'	=> trim(strip_tags( $item->post_title ))) ); ?>
			</div>
			<div class="Detail HasImage">
            	<h3><?php the_title();?></h3>
                <ul class="ListDetail">					
					<li><?php  esc_html_e('Khách mời')?>: <strong><?php $obj = get_field('khach_moi'); echo $obj[0]->post_title;?></strong></li>
					<li><?php  esc_html_e('Giá khởi điểm')?>: <strong><?php echo convert_number_to_words(get_field('gia_khoi_diem'));?> VND</strong></li>
					<li><?php  esc_html_e('Bước giá')?>: <strong><?php echo convert_number_to_words(get_field('buoc_gia'));?> VND</strong></li>					
                    <li><?php  esc_html_e('Thời gian bắt đầu')?>: <strong><?php $date = date_create(get_field('thoi_gian_bat_dau')); echo date_format( $date, 'H:i d/m/Y');?></strong></li>					
                    <li><?php  esc_html_e('Thời gian kết thúc')?>: <strong><?php $date = date_create(get_field('thoi_gian_ket_thuc')); echo date_format( $date, 'H:i d/m/Y');?></strong></li>
					<li>
						<?php  esc_html_e('Ghi chú')?>:						
                        <?php the_content()?>
					</li>
				</ul>
                
            <?php
            global $timeStart, $timeStop, $timeNow;        
            
            if($timeStart <= $timeNow && $timeStop > $timeNow) { // Neu thoi gian bat dau da toi                
                ?>
                
                 <?php $date = $timeStop;//date_create(get_field('thoi_gian_ket_thuc'));?>   
                <div class="msgTimeStart">Thời gian còn lại</div>             
                <div id="defaultCountdown"></div>         
                <?php
                if ( is_user_logged_in() ) {?>    
                              
                <?php } else{
                    ?>                 
                    
                <?php
                }
                
            } elseif ($timeStart > $timeNow) {                
            ?>
                <?php $date = $timeStart;//date_create(get_field('thoi_gian_bat_dau'));?>                
                <div class="msgTimeStart">Thời gian bắt đầu</div>
                <div id="defaultCountdown"></div>                
            <?php            
            } else{//Neu het thoi gian dau gia
                $sql = "SELECT username, user_id, money_auction  FROM history_auction WHERE auction_id = '".get_the_ID()."' AND isWin=1 LIMIT 0,1";
                $results = $wpdb->get_results($sql);
                
                ?>
                <div class=" msgLogin">
                <?php
                if(!empty($results)){
                    $fullname = get_user_meta($results[0]->user_id, 'fullname', true);   
                    $fullname = ucname($fullname);                                     
                    echo "Xin chúc mừng <strong class='textDone'>{$fullname}</strong>, với username <strong class='textDone'>{$results[0]->username}</strong> đã giành chiến thắng phiên đấu giá với số tiền đóng góp là <strong class='textDone'>".number_format($results[0]->money_auction)."</strong>";
                }else
                    echo __("Đã hết thời gian đấu giá, đang xác nhận người thắng cuộc");
                ?>
                </div>
                <?php
                
            }?>
            </div>    
		</div>
        <div class="Clear"></div>		
        <?php
        global $timeStart, $timeStop, $timeNow;        
        if($timeStart <= $timeNow && $timeStop > $timeNow) { // Neu thoi gian bat dau da toi
            ?>
    		<div class="AutionForm">
            	<h3><span><?php _e("Đấu giá")?></span></h3>
                <form action="" method="post" id="formDauGia">
    				<fieldset>
    					<legend><?php _e("Đăng nhập")?></legend>
    					<ul>
                            <li>
    							<p>
    								<label class="Reg" for="vrf"><?php _e("Giá hiện tại")?>:</label>								
    								<iframe style="border: none; height: 20px; overflow: hidden;" src="<?php echo get_bloginfo('wpurl').'/wp-content/plugins/realtime/auction/auction.html?type=0&id='.get_the_ID().'&giaht='.get_field('gia_khoi_diem');?>"></iframe>
    							</p>
    						</li>
                            <li>
    							<p>
    								<label class="Reg" for="vrf"><?php _e("Bước giá")?>:</label>								
    								<strong><?php echo convert_number_to_words(get_field('buoc_gia'));?> VND</strong>
    							</p>
    						</li>
                            <?php if ( is_user_logged_in() ) {?>
    						<li>
    							<p>
    								<label class="Reg" for="hinhThuc"><?php _e("Đấu giá với")?>: </label>
                                    <?php global $buocgia?>
    								<select id="hinhThuc" name="buoc_gia">									
                                        <option <?php echo ($buocgia ==1)? 'selected="selected"':''?> value="1"><?php _e("1 bước giá")?></option>
    									<option <?php echo ($buocgia ==2)? 'selected="selected"':''?> value="2"><?php _e("2 bước giá")?></option>
                                        <option <?php echo ($buocgia ==3)? 'selected="selected"':''?> value="3"><?php _e("3 bước giá")?></option>																		
    								</select>
    							</p>
    						</li>						
                            <li>
    							<p>
    								<label class="Reg" for="vrf"><?php _e("Nhập mã")?>:</label>                                
    								<img id="imgVrf" src="<?php global $captcha_file; echo $captcha_file; ?>" class="ImgVerify" alt="" title="">
    								<input type="text" name="captcha" class="Verify" id="vrf">
                                    <input type="hidden" id="captcha_prefix" name="captcha_prefix" value="<?php global $captcha_prefix; echo $captcha_prefix; ?>" />
    							</p>
    						</li>
                            <li class="error" >
    							<p>
    								<label class="Reg" for="vrf"></label>
                                    <span id="errorBox"></span>
    							</p>
    						</li>
    						<li class="SubmitBtns">
    							<p>
    								<input type="submit" value="<?php _e("ĐẤU GIÁ")?>" /> <img id="loading" src="<?php echo get_template_directory_uri(); ?>/images/loading.gif"/>
    							</p>
    						</li>
                            <?php } else{//Chưa đăng nhập
                                ?>
                                <li >
    							     <div class="msgLogin"><?php _e("Bạn chưa ")?><a id="loginLnk" href="#"><?php _e("đăng nhâp")?></a> <?php _e(" để tham gia đấu giá")?> </div>
    						      </li>
                                <?php
                            }?>
    					</ul>
    				</fieldset>
    			</form>
    		</div>
    		<div class="AutionList">
                <h3><span><?php _e("Danh sách người đấu giá")?></span></h3>
                <div >
                    <iframe style="border: none;" src="<?php echo get_bloginfo('wpurl').'/wp-content/plugins/realtime/auction/auction.html?type=1&id='.get_the_ID().'&giaht=0'; ?>"></iframe>
                </div>
    		</div>    	
            <?php } 
        ?>		
</div>
</div>
</div>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.countdown.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.countdown-vi.js"></script>
<script type="text/javascript">
$(function () {
	//var austDay = new Date();    
	austDay = new Date(<?php echo date('Y', $date)?>, <?php echo (date('m', $date)-1)?>, <?php echo date( 'd', $date)?>,<?php echo date('H', $date)?>, <?php echo date('i', $date)?>,<?php echo date('s', $date)?>);    
	$('#defaultCountdown').countdown({until: austDay,timezone: +7, serverSync:serverTime, onExpiry: liftOff});
    $.countdown.setDefaults($.countdown.regional['vi']);
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