<?php
/*
Template Name: register
*/
require_once(ABSPATH . WPINC . '/registration.php');
global $wpdb, $user_ID;
function updateUserMetaRegister($user_id, $userdata){
	foreach($userdata as $key=>$value){
	update_usermeta($user_id, $key, $value);
	}
}

//Check whether the user is already logged in
if (!$user_ID) {
    $captcha = new ReallySimpleCaptcha();
    $captcha_word = $captcha -> generate_random_word(); //generate a random string with letters
    $captcha_prefix = mt_rand(); //random number
    $captcha_image = $captcha -> generate_image($captcha_prefix, $captcha_word); //generate the image file. it returns the file name
    $captcha_file = rtrim(get_bloginfo('wpurl'), '/') . '/wp-content/plugins/really-simple-captcha/tmp/' . $captcha_image; //construct the absolute URL of the captcha image
    
	if($_POST){
		//We shall SQL escape all inputs
		$username = $wpdb->escape($_REQUEST['username']);
        $userdata['fullname'] = $wpdb->escape($_REQUEST['fullname']);
        $userdata['birthday'] = $wpdb->escape($_REQUEST['birthday']);
        $userdata['cmnd'] = $wpdb->escape($_REQUEST['cmnd']);
        $userdata['thuongtru'] = $wpdb->escape($_REQUEST['thuongtru']);
        $userdata['phone'] = $wpdb->escape($_REQUEST['phone']);
        $email = $wpdb->escape($_REQUEST['email']);
        $userdata['sex'] = $wpdb->escape($_REQUEST['sex']);
        $userdata['group'] = $wpdb->escape($_REQUEST['reggroup']);
        $userdata['fullname2'] = $wpdb->escape($_REQUEST['fullname2']);
        $userdata['tuoi2'] = $wpdb->escape($_REQUEST['tuoi2']);
        $userdata['fullname3'] = $wpdb->escape($_REQUEST['fullname3']);
        $userdata['tuoi3'] = $wpdb->escape($_REQUEST['tuoi3']);
		$policy = $wpdb->escape($_REQUEST['policy']);
        
        $msg = "";
		if(empty($username)) {
			$msg .= "<p class='msgLine' id='msg_username'>Chưa nhập tên đăng nhập</p>";			
		}elseif(!validate_username($username)){
		   $msg .= "<p class='msgLine' id='msg_username'>Tên đăng nhập chỉ chấp nhận chữ cái, số hoặc các ký tự . _ -</p>";
		} elseif(strlen($username)<3){
		  $msg .= "<p class='msgLine' id='msg_username'>Tên đăng phải từ 3 ký tự</p>";
		} elseif(strlen($username)>15){
		  $msg .= "<p class='msgLine' id='msg_username'>Tên đăng phải ít hơn 15 ký tự</p>";
		}elseif(username_exists($username)){
            $msg .= "<p class='msgLine' id='msg_username'>Tên đăng nhập này đã tồn tại.</p>";            
        }
        
        if(empty($userdata['fullname'])) {
			$msg .= "<p class='msgLine' id='msg_fullname'>Chưa nhập họ và tên</p>";			
		}
        /*if(empty($userdata['birthday'])) {
			$msg .= "<p class='msgLine' id='msg_birthday'>Chưa nhập ngày sinh</p>";			
		}
        if(empty($userdata['cmnd'])) {
			$msg .= "<p class='msgLine' id='msg_cmnd'>Chưa nhập số chứng mình nhân dân</p>";			
		}elseif(!preg_match("/^[0-9\-\+]{9}$/", $userdata['cmnd'])){
		     $msg .= "<p class='msgLine' id='msg_cmnd'>Số CMND là số và có 9 chữ số</p>";
		}
        
        if(empty($userdata['thuongtru'])) {
			$msg .= "<p class='msgLine' id='msg_thuongtru'>Chưa nhập địa chỉ thường trú</p>";			
		}*/
        if(empty($userdata['phone'])) {
			$msg .= "<p class='msgLine' id='msg_phone'>Chưa nhập điện thoại</p>";			
		}elseif(!preg_match("/^[0-9\-\+]{9,11}$/", $userdata['phone'])){
		     $msg .= "<p class='msgLine' id='msg_phone'>Bạn chưa nhập đúng số điện thoại</p>";
		}
        if(empty($email)) {
			$msg .= "<p class='msgLine' id='msg_email'>Chưa nhập địa chỉ email</p>";			
		}elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) {
			$msg .= "<p class='msgLine' id='msg_email'>Email nhập không chính xác</p>";			
		}elseif (email_exists($email)){
            $msg .= "<p class='msgLine' id='msg_email'>Email này đã được sử dụng.</p>";           
        }
		if (empty($policy)){
            $msg .= "<p class='msgLine' id='msg_policy'>Bạn chưa đồng ý với các thể lệ của chương trình.</p>";           
        }
        
        if($userdata['group'] ==1){
         /* if(empty($userdata['fullname2'])) {
			$msg .= "<p class='msgLine' id='msg_fullname2'>Chưa nhập họ tên người thứ 2</p>";			
		  } 
          if(empty($userdata['tuoi2'])) {
			$msg .= "<p class='msgLine' id='msg_tuoi2'>Chưa nhập tuổi người thứ 2</p>";			
		  }elseif(!preg_match("/^[0-9\-\+]{1,3}$/", $userdata['tuoi2']) || $userdata['tuoi2'] < 0 || $userdata['tuoi2'] > 110){
		      $msg .= "<p class='msgLine' id='msg_tuoi2'>Tuổi người thứ 2 không hợp lệ</p>";
		  }  
          if(!empty($userdata['fullname3'])) {		
              if(empty($userdata['tuoi3'])) {
			     $msg .= "<p class='msgLine' id='msg_tuoi3'>Chưa nhập tuổi người thứ 3</p>";			
		      }elseif(!preg_match("/^[0-9\-\+]{1,3}$/", $userdata['tuoi3']) || $userdata['tuoi3'] < 0 || $userdata['tuoi3'] > 110){
		      $msg .= "<p class='msgLine' id='msg_tuoi3'>Tuổi người thứ 3 không hợp lệ</p>";
		  }else{
		      $userdata['tuoi3'] = '';
		  }  
          }*/
        }
               
        if(!empty($msg)){
            echo json_encode(array(0, $msg));            
            exit();
        } elseif (empty($_POST['captcha'])) {
           $msg = __("<p class='msgLine' id='msg_captcha'>Chưa nhập mã bảo vệ<p>"); //the captcha has been proven as correct
           echo json_encode(array(3, $msg, $captcha_file, $captcha_prefix));
           exit();    
        } elseif (!$captcha -> check($_POST['captcha_prefix'], $_POST['captcha'])) {
            $msg = __("<p class='msgLine' id='msg_captcha'>Mã bảo vệ không chính xác</p>"); //the captcha has been proven as correct
            echo json_encode(array(3, $msg, $captcha_file, $captcha_prefix));    
            exit();
        }
        global $phpmailer;
        require_once ABSPATH . WPINC . '/class-phpmailer.php';
    	require_once ABSPATH . WPINC . '/class-smtp.php';
    	$phpmailer = new PHPMailer();
		    $random_password = wp_generate_password( 12, false );
            $userid = wp_create_user( $username, $random_password, $email );
            updateUserMetaRegister($userid, $userdata);    
			$from = get_option('admin_email');
	                $headers = 'From: '.$from . "\r\n";
                    $headers .= 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    
	                $subject = "[Donate for a date 2013] Đăng ký thành viên thành công";
	                $msg .= "Chào <strong>".$userdata['fullname'].'</strong>';
                    $msg .= "<br/>Chúc mừng bạn đã đăng ký thành viên thành công tại website donateforadate.com.";
                    $msg .= "<br/>Dưới đây là thông tin tài khoản đăng nhập website của bạn:";
                    $msg .= "<br/><br/>Tên đăng nhập: $username<br/>Mật khẩu: $random_password";
                    $msg .= "<br/><br/>Để đảm bảo xác thực thông tin cho chương trình, BTC sẽ tiến hành kiểm duyệt thông tin của bạn. 
                             <br/>+ Sau 2 tiếng đồng hồ kể từ lúc đăng ký,  Nếu BTC nhận thấy thông tin mà bạn cung cấp không chính xác, BTC sẽ xóa tài khoản của bạn mà không cần xác nhận lại.
                             <br/>+ Nếu thông tin chính xác, xác nhận của BTC sẽ đươc gửi đến email của bạn và bạn có thể tham gia đấu giá kể từ lúc này.
                             ";
                    $msg .= "<br/><br/>Để đảm bảo an toàn bạn vui lòng đổi mật khẩu sau khi đăng nhập tại: http://donateforadate.com/doi-mat-khau";                    
                    $msg .= "<br/>Để thay đổi thông tin tài khoản, vui lòng truy cập http://donateforadate.com/tai-khoan<br/>";
                    $msg .= "<br/>Trân trọng!<br/>";
                    $msg .= "----------------------------<br/>";
                    $msg .= "Operation Smile Vietnam<br/>";
                    $msg .= "Địa chỉ: Tầng 5, Hùng Vương Plaza, 126 Hùng Vương, Quận 5, Thành phố Hồ Chí Minh<br/>";
                    $msg .= "SĐT: (84) 8 2222 1008 Fax: (84) 8 2222 1004<br/>";
                    $msg .= "Trần Quang Nhật – Business Development<br/>";
                    $msg .= "Website: www.operationsmile.org.vn<br/>";
                    $msg .= "Hotline: 0904 88 5555";
	                wp_mail( $email, $subject, $msg, $headers );
			$msg = "Chúc mừng bạn đã đăng ký thành công, thông tin mật khẩu đăng nhập đã được gửi đến địa chỉ email của bạn, vui lòng kiểm tra email mà bạn mới đăng ký nếu bạn không nhận được mail thì hãy kiểm tra thư mục Spam";
            echo json_encode(array(1, $msg));
            //echo $msg;
            exit();
		

} else {
get_header(); ?>
<?php while ( have_posts() ) { the_post(); 
$feature_image_id = get_post_thumbnail_id($id); 
$feature_image_meta = wp_get_attachment_image_src($feature_image_id, '32')  
?>
<div class="Content InnerWrapper">
            	<div class="Wrapper">
                	<div class="MainContent">
                    	<div class="Content">
                        	<div class="HeaderImg">
                            	<a href="#" title="<?php the_title(); ?>">
								<img title="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo $feature_image_meta[0]?>" width="960" height="200" />
								<span class="Mask">&nbsp;</span>
                                </a>
							</div>
							<div id="static">
                            	<div class="StaticTopPanel">
                                    <h2 class="TitleMain"><?php the_title(); ?></h2>
                                    <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
								</div>
								<div class="StaticOuter">                                
                                <div class="StaticInner">
                                <p class="RegDescription"><?php the_content(); ?></p>
								<div class="Form RegForm">
                                <div class="StaticMain"> 
                                    <?php if(get_option('users_can_register')) { ?>
								         <form method="post" action="<?php echo home_url( '/dang-ky' )?>">
                                                    <div id="errorMsgBox"></div>
													<fieldset>
														<ul>
                                                        <li>
																<p class="RequireNote">
																	(<span class="Require">*</span>) Thông tin bắt buộc nhập
																</p>
															</li>
                                                            <li>
																<p>
																	<label for="uname" class="Reg">Tên đăng nhập (<span class="Require">*</span>): </label>
																	<input type="text" class="Birthday" id="uname" name="username">
																</p>
															</li>
															<li>
																<p>
																	<label for="uname" class="Reg">Họ tên (<span class="Require">*</span>): </label>
																	<input type="text" id="uname" name="fullname">
																</p>
															</li>
															<li>
																<p>
																	<label for="ubirth" class="Reg">Ngày tháng năm sinh: </label>
																	<input type="text"  id="ubirth" name="birthday" class="Birthday" /><a title="Từ ngày" href="#ubirth" class="CalIcon">Từ ngày</a>
																</p>
															</li>
															<li>
																<p>
																	<label for="uname" class="Reg">Chứng minh nhân dân: </label>
																	<input type="text" id="uname" name="cmnd">
																</p>
															</li>
															<li>
																<p>
																	<label for="uname" class="Reg">Địa chỉ thường trú: </label>
																	<input type="text" id="uname" name="thuongtru">
																</p>
															</li>
															<li>
																<p>
																	<label for="utel" class="Reg">Số điện thoại (<span class="Require">*</span>): </label>
																	<input type="text" id="utel" class="Birthday" name="phone" />
																</p>
															</li>
															<li>
																<p>
																	<label for="utel" class="Reg">Email (<span class="Require">*</span>): </label>
																	<input type="text" id="utel" name="email" />
																</p>
															</li>
															<li>
																<p>
																	<label class="Reg">Giới tính:</label>
																</p>
																<ul class="Radio">
																	<li>
																		<input value="1" name="sex" type="radio" class="Nor" checked="checked" id="mal" value="" name="gent">
																	Nam </li>
																	<li>
																		<input value="0" name="sex" type="radio" class="Nor" id="fem" value="" name="gent">
																	Nữ </li>
																	<li>
																		<input value="3" name="sex" type="radio" class="Nor" id="fem" value="" name="gent">
																	Khác </li>
																</ul>
															</li>
                                                            <li>
																<p>
																	<label class="Reg">Đăng ký nhóm:</label>
																</p>
																<ul class="Radio">
																	<li>
																		<input value="1" type="radio" class="Nor" id="reggroup-yes" value="" name="reggroup">
																	<label for="reggroup-yes">Có</label> </li>
																	<li>
																		<input value="0" checked="checked" type="radio" class="Nor" id="reggroup-no" value="" name="reggroup">
																	<label for="reggroup-no">Không</label> </li>
																</ul>
															</li>
                                                            <!--
															<li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Họ và tên người thứ 2 (<span class="Require">*</span>): </label>
																	<input type="text" id="utel" name="fullname2" />
																</p>
															</li>
                                                            <li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Tuổi người thứ 2 (<span class="Require">*</span>): </label>
																	<input type="text" id="utel" class="Birthday" name="tuoi2" />
																</p>
															</li>
															<li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Họ và tên người thứ 3: </label>
																	<input type="text" id="utel" name="fullname3"/>
																</p>
															</li>
                                                            <li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Tuổi người thứ 3: </label>
																	<input type="text" id="utel" class="Birthday" name="tuoi3" />
																</p>
															</li>	
                                                            <li>-->
                                                            <span id="msgBox"></span>
                                							<p>
                                								<label class="Reg" for="vrf"><?php _e("Nhập mã")?>:</label>                                
                                								<img id="imgVrf" src="<?php global $captcha_file; echo $captcha_file; ?>" class="ImgVerify" alt="" title="">
                                								<input type="text" name="captcha" class="Verify" id="vrf">
                                                                <input type="hidden" id="captcha_prefix" name="captcha_prefix" value="<?php global $captcha_prefix; echo $captcha_prefix; ?>" />
                                							</p>
                                						    </li>	
                                                            <li class="">
																<p>
																	<label class="Reg"><!----></label>
																	<input type="checkbox" name="policy"  value="1"> Tôi đồng ý với các <a target="_blank" href="<?php echo home_url( '/the-le' )?>">thể lệ</a> của chương trình
																</p>
															</li>														
															<li class="SubmitBtns">
																<p>
																	<input type="submit" value="Đăng ký" class="BtnSubmit"> <img id="loading" src="<?php echo get_template_directory_uri(); ?>/images/loading.gif"/>
																</p>
															</li>
														</ul>
													</fieldset>
                                                    <input hidden="hidden" id="linkRedirect" value="<?php echo home_url('/dang-ky-thanh-cong')?>" /> 
								        </form>
                                       <?php } else echo "Hiện tại chức năng này chưa hoạt động. Bạn vui lòng quay lại sau...";?>
                                </div>								
								</div>
                                </div>
                                </div>
							</div>
						</div>
						<div class="Clear"></div>
					</div>
				</div>
			</div>
    <?php }
?>
<?php
    get_footer();
 } //end of if($_post)
}
else {
	wp_redirect( home_url() ); exit;
}