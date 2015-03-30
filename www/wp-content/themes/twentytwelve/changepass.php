<?php
/*
Template Name: changpass
*/
require_once(ABSPATH . WPINC . '/registration.php');
global $wpdb, $user_ID;
function updateUserMetaRegister($user_id, $userdata){
	foreach($userdata as $key=>$value){
	update_usermeta($user_id, $key, $value);
	}
}
//Check whether the user is already logged in
if ($user_ID) {
    global $current_user;
    get_currentuserinfo();    
	if($_POST){
		//We shall SQL escape all inputs
        $userdata = array();
		$pass = $wpdb->escape($_REQUEST['oldpass']);
        $newPass = $wpdb->escape($_REQUEST['newpass']);
        $passConfig = $wpdb->escape($_REQUEST['newpassconfig']);
        
        $msg = "";
		if(empty($pass)) {
			$msg .= "<p class='msgLine' id='msg_oldpass'>Chưa nhập mật khẩu cũ</p>";			
		}
        if(empty($newPass)) {
			$msg .= "<p class='msgLine' id='msg_newpass'>Chưa nhập mật khẩu mới</p>";			
		}
        if(empty($passConfig)) {
			$msg .= "<p class='msgLine' id='msg_newpassconfig'>Chưa nhập mật khẩu xác nhận</p>";			
		}
        
        if(!empty($msg)){
            echo json_encode(array(0, $msg));            
            exit();
        } else{            
            if($passConfig != $newPass) {
			    $msg .= "<p class='msgLine' id='msg_newpassconfig'>Mật khẩu xác nhận không hợp lệ</p>";	
                echo json_encode(array(0, $msg));            
                exit();		
            }elseif(!wp_check_password($pass, $current_user->user_pass, $user_ID)){
                $msg .= "<p class='msgLine' id='msg_oldpass'>Mật khẩu cũ không chính xác</p>";	
                echo json_encode(array(0, $msg));            
                exit(); 
            }else{
                wp_set_password( $newPass, $user_ID);
                $msg = "Mật khẩu của bạn đã được thay đổi";	
                echo json_encode(array(1, $msg));     
                exit();
            }  
        }
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
                                    <?php if(get_option('users_can_register')) { ?>
								         <form method="post" action="<?php echo home_url( '/doi-mat-khau' )?>">
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
																	<label for="uname" class="Reg">Mật khẩu cũ (<span class="Require">*</span>): </label>
																	<input type="password"  id="uname" name="oldpass">
																</p>
															</li>
															<li>
																<p>
																	<label for="uname" class="Reg">Mật khẩu mới (<span class="Require">*</span>): </label>
																	<input type="password" value="" id="uname" name="newpass">
																</p>
															</li>
															<li>
																<p>
																	<label for="ubirth" class="Reg">Xác nhận mật khẩu mới (<span class="Require">*</span>): </label>
																	<input type="password"  value=""  name="newpassconfig" />
																</p>
															</li>															                                                            
															<li class="SubmitBtns">
																<p>
																	<input type="submit" value="Cập nhật" class="BtnSubmit"> <img id="loading" src="<?php echo get_template_directory_uri(); ?>/images/loading.gif"/>
																</p>
															</li>
														</ul>
													</fieldset>
                                                    <input hidden="hidden" id="linkRedirect" value="<?php echo home_url('/thong-bao-doi-mat-khau')?>" /> 
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
    get_header();
    while ( have_posts() ) { the_post(); 
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
    }
}
get_footer();