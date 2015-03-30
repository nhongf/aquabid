<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 $current_page_id = $wp_query->post->ID;
 if ( is_user_logged_in() ) {    
    $fullname = get_usermeta($user_ID,'fullname');
    
    if(empty($fullname) && $current_page_id != '342'){
        wp_redirect( home_url('/tai-khoan?msg=1') ); exit;
    }
 }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.ico" type="image/x-icon"/>
<title><?php wp_title('|',true,'right'); ?>
<?php bloginfo('name'); ?></title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" />
<link type="text/css" rel="stylesheet" href="http://img.zing.vn/eventgame/intro/general/css/mainsite.css" />
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/content-new.css" />
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/list-event.css" />
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/list-guests.css" />
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/redmond/jquery-ui-1.10.2.custom.css" />
<script type="text/javascript" src="http://img.zing.vn/eventgame/intro/general/js/mainsite.js"></script>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28196578-27']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php wp_head(); ?>
<style type="text/css" media="screen">
	html { margin-top: 0px !important; }
	* html body { margin-top:0px !important; }
</style>
</head> 
<body>
    	<div class="OuterWrapper">
            <div class="HeaderWrapper">
            	<div class="Wrapper">
                    <div class="Logo"><h1><a onclick="_gaq.push(['_trackEvent','Logo', 'Link', 'Homepage']);" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="DONATE FOR A DATE">DONATE FOR A DATE</a></h1></div>
                    <div class="TopSearchBox">
                    	<div class="CurvedLeft">&nbsp;</div>
                    	<div class="Wrapper">
                            <div class="SecMenu">
                                <ul>
                                <?php
                                    if ( is_user_logged_in() ) {
                                    global $current_user;
                                    get_currentuserinfo();
                                    echo '<li><span>Chào: '.$current_user->display_name.'</span> <a id="loginLnk" class="UtilityUser" href="javascript:">Tài khoản</a></li>';                                                                        
                                    } else {
                                    ?>                                                                                                          
                                    <li onclick="_gaq.push(['_trackEvent','TopNavigation', 'Dang nhap', 'MainSite']);" class="DangNhap"><a id="loginLnk" href="javascript:" title="Đăng nhập"><span class="Bullet">&nbsp;</span><span>Đăng nhập</span></a></li>
                                    <?php if ( get_option('users_can_register') ) : ?>
                                    <li onclick="_gaq.push(['_trackEvent','TopNavigation', 'Dang ky', 'MainSite']);" class="DangKy"><a href="<?php echo home_url( '/dang-ky' )?>" title="Đăng ký"><span class="Bullet">&nbsp;</span><span>Đăng ký</span></a></li>
                                    <?php endif; ?>
                                    <?php }?>
                                    
								</ul>
							</div>
                            <div class="FormSearch">
                                <form id="searchform" action="<?php bloginfo('home'); ?>/" method="get" class="">
                                    <input name="s" id="top_KeyWord" type="text" class="BgTextbox SuggestKeyword TextInputReplace" value="Nhập thông tin tìm kiếm" name="Keyword" id="top_KeyWord" autocomplete="off" />
                                    <input type="hidden" name="CateCode" id="CateCode" value="" />
                                    <input type="submit" id="searchsubmit"  class="SearchBtn" value="Tìm kiếm" title="Tìm kiếm" name="search"/>
								</form>
							</div>
						</div>
                    	<div class="CurvedRight">&nbsp;</div>
					</div>
                    <div class="MainMenu">
                    	<ul>
                            <?php
                            $current_page_id = $wp_query->post->ID;
                            $post_type = $wp_query->post->post_type;
                            $category = the_category_ID(false);
                            ?>
                        	<li class="<?php echo (is_home())?'Hilite':''?>"><a onclick="_gaq.push(['_trackEvent','Navigation', 'Trang chu', 'MainSite']);" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Trang chủ"><span>Trang chủ</span></a></li>
                            <li class="SepLine"></li>
                        	<li class="<?php echo ($current_page_id ==2)?'Hilite':''?>"><a onclick="_gaq.push(['_trackEvent','Navigation', 'Gioi thieu', 'MainSite']);" href="<?php echo home_url( '/gioi-thieu' )?>" title="Giới thiệu"><span>Giới thiệu</span></a></li>
                            <li class="SepLine"></li>
                        	<li class="<?php echo ($current_page_id ==24)?'Hilite':''?>"><a onclick="_gaq.push(['_trackEvent','Navigation', 'The le', 'MainSite']);" href="<?php echo home_url( '/the-le' )?>" title="Thể lệ"><span>Thể lệ</span></a></li>
                            <li class="SepLine"></li>
                        	<li class=" <?php echo (($current_page_id ==33 || $category == 7 ) && !is_home())?'Hilite':''?>"><a onclick="_gaq.push(['_trackEvent','Navigation', 'Phien dau gia', 'MainSite']);" href="<?php echo home_url( '/phien-dau-gia' )?>" title="Phiên đấu giá"><span>Phiên đấu giá</span></a></li>
                            <li class="SepLine"></li>
                        	<li class=" <?php echo ($current_page_id ==30 || $category == 6)?'Hilite':''?>"><a onclick="_gaq.push(['_trackEvent','Navigation', 'Khach moi', 'MainSite']);" href="<?php echo home_url( '/khach-moi' )?>" title="Khách mời"><span>Khách mời</span></a></li>
                            <li class="SepLine"></li>
                        	<li class=" <?php echo ($current_page_id ==6)?'Hilite':''?>"><a onclick="_gaq.push(['_trackEvent','Navigation', 'Dong gop', 'MainSite']);" href="<?php echo home_url( '/dong-gop' )?>" title="Đóng góp"><span>Đóng góp</span></a></li>
                            <li class="SepLine"></li>
                        	<li class="<?php echo ((($current_page_id ==629 || $current_page_id ==632 || $current_page_id ==70 || $post_type =='post') && $category != 6 && $category != 7) && !is_search() && !is_home())?'Hilite':''?>"><a onclick="_gaq.push(['_trackEvent','Navigation', 'Tin tuc', 'MainSite']);" href="<?php echo home_url( '/tin-tuc/' )?>" title="Tin tức"><span>Tin tức</span></a></li>
                             <li class="SepLine"></li>
                            <li class="<?php echo ($current_page_id ==8)?'Hilite':''?>" onclick="_gaq.push(['_trackEvent','TopNavigation', 'Lien he', 'MainSite']);" class="LienHe"><a href="<?php echo home_url( '/lien-he' )?>" title="Liên hệ"><span>Liên hệ</span></a></li>
						</ul>
                        
					</div>
				</div>
			</div>