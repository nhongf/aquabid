<?php
/*
Template Name: profile
*/
require_once(ABSPATH . WPINC . '/registration.php');
global $wpdb, $user_ID;
function updateUserMetaRegister($user_id, $userdata){
	foreach($userdata as $key=>$value){
	update_usermeta($user_id, $key, $value);
	}
}
if(!function_exists('wsl_get_user_linked_account_by_user_id')){
function wsl_get_user_linked_account_by_user_id( $user_id )
{
	global $wpdb;

	$sql = "SELECT * FROM `{$wpdb->prefix}wslusersprofiles` where user_id = '$user_id'";
	$rs  = $wpdb->get_results( $sql );

	return $rs;
}
}
//Check whether the user is already logged in
if ($user_ID) {
    global $current_user;
    get_currentuserinfo();    
	if($_POST){
		//We shall SQL escape all inputs
        $userdata = array();
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
        
        $msg = "";
		if(empty($username)) {
			$msg .= "<p class='msgLine' id='msg_username'>Chưa nhập tên đăng nhập</p>";			
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
		}
        if($userdata['group'] ==1){
        /*  if(empty($userdata['fullname2'])) {
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
		  }  
          }*/
        }
        if(!empty($msg)){
            echo json_encode(array(0, $msg));            
            exit();
        }
        /*
		$random_password = wp_generate_password( 12, false );
		$status = wp_create_user( $username, $random_password, $email );
		if ( is_wp_error($status) ){
			$msg = "<p class='msgLine' id='msg_email'>Tên đăng nhập hoặc email này đã tồn tại.</p>";
            echo json_encode(array(0, $msg));
           // echo $msg;
            exit();
        } else {*/
            updateUserMetaRegister($user_ID, $userdata);    
		/*	$from = get_option('admin_email');
	                $headers = 'From: '.$from . "\r\n";
	                $subject = "Đăng ký thành viên thành công";
	                $msg = "Chào $fullname.\n Chúc mừng bạn đã đăng ký thành viên thành công tại website http:\\donateforadate.com.
   \nThông tin tài khoản của bạn\nTên đăng nhập: $username\nMật khẩu: $random_password \n\nTrân trọng!";
	                wp_mail( $email, $subject, $msg, $headers );
                    */
			$msg = "Thông tin của bạn đã được thay đổi";
            echo json_encode(array(1, $msg));
            //echo $msg;
            exit();
	//	}

		exit();

    } else {
    get_header();
?>
<?php while ( have_posts() ) { the_post(); 
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
                                <p class="RegDescription"><?php the_content(); ?></p>
								<div class="Form RegForm">
                                <div class="StaticMain"> 
                                    <?php if(get_option('users_can_register')) {
                                        $linked_accounts = wsl_get_user_linked_account_by_user_id( $user_ID );
                                        
										$link = $linked_accounts[0];                                        
                                        ?>
								         <form method="post" action="<?php echo home_url( '/tai-khoan' )?>">
                                                    <?php if(isset($_GET['msg'])){
                                                        ?>
                                                        <div style="color: red; font-weight: bold; margin-bottom:15px">Bạn vui lòng nhập đầy đủ thông tin để tiếp tục tham gia chương trình</div>
                                                        <?php
                                                    }
                                                    ?>                                                    
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
																	<input type="text" readonly="" value="<?php echo $current_user->user_login?>" class="Birthday" id="uname" name="username">
																</p>
															</li>
															<li>
																<p>
																	<label for="uname" class="Reg">Họ tên (<span class="Require">*</span>): </label>
																	<input type="text" value="<?php $name=get_usermeta($user_ID,'fullname'); echo (!empty($name))?$name:$link->fistname.' '.$link->lastname ;?>" id="uname" name="fullname">
																</p>
															</li>
															<li>
																<p>
																	<label for="ubirth" class="Reg">Ngày tháng năm sinh: </label>
																	<input type="text"  value="<?php $birthday=get_usermeta($user_ID,'birthday'); echo (!empty($birthday))?$birthday:$link->birthmonth.'/'.$link->birthday.'/'.$link->birthyear;?>" id="ubirth" name="birthday" class="Birthday" /><a title="Từ ngày" href="#ubirth" class="CalIcon">Từ ngày</a>
																</p>
															</li>
															<li>
																<p>
																	<label for="uname" class="Reg">Chứng minh nhân dân: </label>
																	<input type="text" value="<?php echo get_usermeta($user_ID,'cmnd');?>" id="uname" name="cmnd">
																</p>
															</li>
															<li>
																<p>
																	<label for="uname" class="Reg">Địa chỉ thường trú: </label>
																	<input type="text" value="<?php $address=get_usermeta($user_ID,'thuongtru'); echo (!empty($address))?$address:$link->address;?>" id="uname" name="thuongtru">
																</p>
															</li>
															<li>
																<p>
																	<label for="utel" class="Reg">Số điện thoại (<span class="Require">*</span>): </label>
																	<input type="text" value="<?php $phone=get_usermeta($user_ID,'phone'); echo (!empty($phone))? $phone:$link->phone ;?>" id="utel" class="Birthday" name="phone" />
																</p>
															</li>
															<li>
																<p>
																	<label for="utel" class="Reg">Email (<span class="Require">*</span>): </label>
																	<input type="text" id="utel" value="<?php echo $current_user->user_email?>" readonly="" name="email" />
																</p>
															</li>
															<li>
																<p>
																	<label class="Reg">Giới tính:</label>
																</p>
																<ul class="Radio">
																	<li>
																		<input value="1" name="sex" <?php echo (get_usermeta($user_ID,'sex') ==1)?'checked="checked"':'';?> type="radio" class="Nor"  id="mal"  name="gent">
																	Nam </li>
																	<li>
																		<input value="0" name="sex"  <?php echo (get_usermeta($user_ID,'sex') ==0)?'checked="checked"':'';?> type="radio" class="Nor" id="fem"  name="gent">
																	Nữ </li>
																	<li>
																		<input value="3" name="sex"  <?php echo (get_usermeta($user_ID,'sex') ==3)?'checked="checked"':'';?> type="radio" class="Nor" id="fem"  name="gent">
																	Khác </li>
																</ul>
															</li>
                                                            <li>
																<p>
																	<label class="Reg">Đăng ký nhóm:</label>
																</p>                                                                
																<ul class="Radio">
																	<li>
																		<input value="1" type="radio" class="Nor"  <?php echo (get_usermeta($user_ID,'group') ==1)?'checked="checked"':'';?> id="reggroup-yes" name="reggroup">
																	<label for="reggroup-yes">Có</label> </li>
																	<li>
																		<input value="0" type="radio" class="Nor" <?php echo (get_usermeta($user_ID,'group') ==0)?'checked="checked"':'';?> id="reggroup-no"  name="reggroup">
																	<label for="reggroup-no">Không</label> </li>
																</ul>
															</li>
														<!--	<li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Họ và tên người thứ 2 (<span class="Require">*</span>): </label>
																	<input type="text" id="utel" value="<?php echo get_usermeta($user_ID,'fullname2');?>" name="fullname2" />
																</p>
															</li>
                                                            <li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Tuổi người thứ 2 (<span class="Require">*</span>): </label>
																	<input type="text" id="utel" value="<?php echo get_usermeta($user_ID,'tuoi2');?>" class="Birthday" name="tuoi2" />
																</p>
															</li>
															<li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Họ và tên người thứ 3: </label>
																	<input type="text" id="utel" value="<?php echo get_usermeta($user_ID,'fullname3');?>" name="fullname3"/>
																</p>
															</li>
                                                            <li class="RegGroup">
																<p>
																	<label for="utel" class="Reg">Tuổi người thứ 3: </label>
																	<input type="text" id="utel" value="<?php echo get_usermeta($user_ID,'tuoi3');?>" class="Birthday" name="tuoi3" />
																</p>
															</li>-->
                                                                                                                        
															<li class="SubmitBtns">
																<p>
																	<input type="submit" value="Cập nhật" class="BtnSubmit"> <img id="loading" src="<?php echo get_template_directory_uri(); ?>/images/loading.gif"/>
																</p>
															</li>
														</ul>
													</fieldset>
                                                    <input hidden="hidden" id="linkRedirect" value="<?php echo home_url('/thong-bao-tai-khoan')?>" /> 
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
    
 } //end of if($_post)
}
else {
     while ( have_posts() ) { the_post(); 
    $feature_image_id = get_post_thumbnail_id($id); 
    $feature_image_meta = wp_get_attachment_image_src($feature_image_id, '32') ;
    get_header();
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
                                <p class="RegDescription"></p>
								<div class="Form RegForm">
                                <div class="StaticMain"> 
                                    <span class="RequestInfo">Bạn chưa đăng nhập hệ thống, vui lòng</span> <a id="loginLnk" href="#">đăng nhập</a> <span class="TextOr">hoặc</span> <a href="<?php echo home_url( '/dang-ky' )?>">đăng ký</a>
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
    <?php
}}
get_footer();