<?php
/*
Template Name: resetpass
*/
require_once(ABSPATH . WPINC . '/registration.php');
global $wpdb;
function check_password_reset_key($key, $login) {
	global $wpdb;

	$key = preg_replace('/[^a-z0-9]/i', '', $key);

	if ( empty( $key ) || !is_string( $key ) )
		return new WP_Error('invalid_key', __('Invalid key'));

	if ( empty($login) || !is_string($login) )
		return new WP_Error('invalid_key', __('Invalid key'));

	$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $key, $login));

	if ( empty( $user ) )
		return new WP_Error('invalid_key', __('Invalid key'));

	return $user;
}
//Check whether the user is already logged in
$user = check_password_reset_key($_GET['key'], $_GET['login']);
if (!is_wp_error($user)){    
	if($_POST){
		//We shall SQL escape all inputs        	
        $newPass = $wpdb->escape($_REQUEST['newpass']);
        $passConfig = $wpdb->escape($_REQUEST['newpassconfig']);        
        $msg = "";		
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
            }else{
                wp_set_password($newPass, $user->ID);
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
								         <form method="post" action="<?php the_permalink()?>?key=<?php echo $_GET['key']?>&login=<?php echo $_GET['login']?>">
                                                    <div id="errorMsgBox" class="ResetPass"></div>
													<fieldset>
														<ul>
                                                        <li>
																<p class="RequireNote">
																	(<span class="Require">*</span>) Thông tin bắt buộc nhập
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
                                                    <input hidden="hidden" id="linkRedirect" value="<?php echo home_url('/doi-mat-khau')?>" /> 
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
                                <p class="RegDescription"></p>
								<div class="Form RegForm">
                                <div class="StaticMain"> 
                                    <?php echo __("Key xác nhận hoặc tài khoản của bạn không đúng. Vui lòng kiểm tra lại email")?>
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