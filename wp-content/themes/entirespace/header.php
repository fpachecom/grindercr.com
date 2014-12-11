<?php 
    if(!class_exists('frame')) { 
        global $current_user;
        get_currentuserinfo(); 
        if ( is_user_logged_in() and current_user_can('manage_options')){
            require_once (TEMPLATEPATH . '/functions/placeholder/admin-placeholder-page.php'); 
            exit(); 
        } else {
            require_once (TEMPLATEPATH . '/functions/placeholder/user-placeholder-page.php'); 
            exit(); 
        }
    } 
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<html xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Foundation including -->
        <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory').'/functions/foundation/css/app.css'; ?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory').'/functions/foundation/css/foundation.css'; ?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory').'/functions/css/flexslider.css'; ?>" media="screen" />
       
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/foundation/js/foundation.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/foundation/js/jquery.foundation.mediaQueryToggle.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/foundation/js/jquery.foundation.orbit.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/foundation/js/modernizr.foundation.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/foundation/js/app.js'; ?>"></script>
        <!-- End Foundation including --> 
        
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/jquery.autocolumnlist.js'; ?>"></script>  
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/jquery.validate.js'; ?>"></script>  
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/jquery.flexslider-min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/jquery.touchSwipe.min.js'; ?>"></script> 
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/jquery.transit.min.js'; ?>"></script> 
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/jquery.cookie.js'; ?>"></script> 
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/jquery.carouFredSel-6.2.0-packed.js'; ?>"></script> 
        
        <?php if(get_option('espace_live_settings') == 'on'): ?>
            <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/livesettings/js/eye.js'; ?>"></script>
            <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/livesettings/js/utils.js'; ?>"></script>
            <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/livesettings/js/colorpicker.js'; ?>"></script>      
        <?php endif; ?>
        
        <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/js/entirespace.js'; ?>"></script> 
        
        <!-- IE Fix -->
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
        <![endif]-->
       
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
        
        <link rel="icon" href="<?php echo bloginfo('template_directory').'/favicon.ico'; ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo bloginfo('template_directory').'/favicon.ico'; ?>" type="image/x-icon">
        
        <?php wp_head(); ?>
        
        <?php if(get_option('espace_live_settings') != 'on'): ?>
            <?php if (get_option('espace_google_font_name') != '' && get_option('espace_google_font_name') != 'Select') { ?>
                    <link id="gFontName-css" rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", get_option('espace_google_font_name')); ?>&subset=latin,cyrillic-ext" />
            <?php } else { ?>
                    <link id="gFontName" href='' rel='stylesheet' type='text/css'>
            <?php } ?>
            <style type="text/css">
            <?php if (get_option('espace_google_font_name') != '' && get_option('espace_google_font_name') != 'Select') { ?>
                    h1, h2, h3<?php if(get_option('espace_google_font_tags') != '') echo ', '.get_option('espace_google_font_tags'); ?> { font-family: <?php echo get_option('espace_google_font_name'); ?>;}
            <?php } ?>
                
            <?php if (get_option('espace_content_font_name') != '' && get_option('espace_content_font_name') != 'Select') { ?>
                    body {font-family:<?php echo get_option('espace_content_font_name'); ?>;}
            <?php } ?>
                
            <?php if (get_option('espace_userbgimg') != '') { ?>
                    body {background:url(<?php echo get_option('espace_userbgimg'); ?>);}
            <?php } elseif (get_option('espace_bgimg') != '') { ?>
                    body {<?php echo get_option('espace_bgimg'); ?>}
            <?php } ?>
                
            <?php if (get_option('espace_bgcol') != '') { ?>
                   body {background-color:<?php echo get_option('espace_bgcol'); ?> !important;}
            <?php } ?>
            </style>
        <?php endif; ?>
        <?php echo get_option('espace_gcode'); ?>
	</head>
	<body <?php if (is_home()) {echo 'id="homepage"';} ?> class="frontend">
        
        <?php if(get_option('espace_live_settings') == 'on') require_once (TEMPLATEPATH . '/functions/livesettings/live-block.php'); ?>
		
        <?php if (is_single()): ?>
            <?php  
                $lang_arr = array ("ca_ES ", "cs_CZ", "da_DK", "eu_ES", "en_UD", "en_US", "es_CL", "es_ES", "es_VE", "fi_FI", "gl_ES", "cy_GB", "de_DE", "ck_US", "es_CO", "fb_FI", "hu_HU", "ja_JP", "nb_NO", "nl_NL", "pt_BR", "ro_RO", "en_PI", "es_LA", "fr_FR", "ko_KR", "pl_PL", "ru_RU", "sl_SI", "th_TH", "ku_TR", "zh_HK", "fb_LT", "es_MX", "it_IT", "pt_PT", "sv_SE", "zh_CN", "af_ZA", "hy_AM", "be_BY", "bs_BA ", "hr_HR", "en_GB", "nn_NO", "sk_SK", "zh_TW", "az_AZ", "bg_BG", "eo_EO", "fo_FO", "ka_GE", "gu_IN", "is_IS", "ga_IE", "tr_TR", "sq_AL", "nl_BE", "fr_CA", "hi_IN", "jv_ID", "kk_KZ", "lv_LV", "lt_LT", "mg_MG", "mt_MT", "bn_IN", "et_EE", "id_ID", "la_VA", "mk_MK ", "mr_IN", "ne_NP ", "rm_CH", "sr_RS", "sw_KE", "ta_IN", "el_GR", "kn_IN", "ms_MY", "pa_IN", "so_SO", "tt_RU", "ml_IN", "uz_UZ", "xh_ZA", "km_KH", "ar_AR", "li_NL", "mn_MN", "tl_PH", "uk_UA", "zu_ZA", "he_IL", "fa_IR", "yi_DE", "qu_PE", "se_NO", "tl_ST", "sa_IN", "te_IN", "tg_TJ", "sy_SY", "ay_BO", "vi_VN", "ur_PK", "gn_PY", "ps_AF");
                $curr_lang = S_WPLANG;
                if (in_array($curr_lang, $lang_arr) ) { $fb_lang = $curr_lang; }
                else {$fb_lang = "en_US";}
            ?>
            <!-- Facebook Like -->
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/<?php echo $fb_lang; ?>/all.js#xfbml=1&appId=232418303462329";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <?php endif; ?>  
        <div id="container" class="row">
			<div id="header" class="twelve">
				<div id="logo" class="six columns">
                    <?php if (get_option('espace_only_text') != 'on'): ?>
                        <div class="fleft2">
                            <a href="<?php bloginfo('url'); ?>">
                                <?php 
                                    if (get_option('espace_site_logo') != '') {
                                        $src = get_option('espace_site_logo');
                                    } else {
                                        $src = get_bloginfo('template_directory').'/img/logo.png';
                                    }
                                    
                                    if (get_option('espace_only_image') == 'on') {
                                        $alt = 'alt="'.get_bloginfo('name').' - '.get_bloginfo('description').'"';
                                    } else {
                                        $alt = '';
                                    }                            
                                ?>
                                <img id="logo-img" src="<?php echo $src; ?>" <?php echo $alt; ?> />
                            </a>
                        </div>
                    <?php else: ?>
                        <style type="text/css">
                            #shopslogan {padding-left:0;}
                        </style>
                    <?php endif; ?>
                    
                    <?php if (get_option('espace_only_image') != 'on'): ?>
                        <div id="shopname"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></div>
                        <div id="shopslogan"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('description'); ?></a></div>
                    <?php endif; ?>	               
				</div><!-- End Logo -->
				
                <?php 
                    global $current_user;
                    get_currentuserinfo();
                    if ( is_user_logged_in() ) {$loggedClass = "logged-user";} else {$loggedClass="";}
                ?>
                <div class="six columns header-widgets <?php echo $loggedClass; ?>">
                    <div class="fright">
                        <?php if ( is_user_logged_in() ) : ?>
                        <div id="user-menu" class="currency-widget">
                            <a class="user-link" href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getProfileHtml'))?>"><?php echo $current_user->user_login; ?><img src="<?php echo bloginfo('template_directory').'/img/darr.png'; ?>" /></a>
                            <ul class="user-menu-items">
                                <li><a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getAccountSummaryHtml')); ?>"><?php lang::_e('My Account'); ?></a></li>
                                <li><a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getOrdersList')); ?>"><?php lang::_e('My Orders'); ?></a></li>
                                <li><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php lang::_e('Log Out'); ?></a></li>
                            </ul>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ( is_active_sidebar( 'currency' ) ) : ?>
                        <div class="currency-widget">
                            <?php dynamic_sidebar( 'currency' ); ?>
                        </div><!-- End Currency Widget -->
                        <?php endif; ?>
                        
                        <?php if ( is_active_sidebar( 'cart' ) ) : ?>
                        <div class="cart-widget">
                            <?php dynamic_sidebar( 'cart' ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div id="search-and-register" <?php if(get_option('espace_user_buttons') == 'on') echo 'class="alone"'; ?> >                        
                        <form action="<?php bloginfo('url'); ?>" id="search">
                            <input type="text" name="s" id="s" placeholder="<?php lang::_e('Search something...'); ?>" />
                            <input type="submit" value="" />
                        </form>
                        <?php if(get_option('espace_user_buttons') != 'on'): ?>
                        <div id="user-block">
                            <?php if ( is_user_logged_in() ) : ?>
                            <?php else: ?>
                            <a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getLoginForm'))?>" class="button"><?php lang::_e('Login'); ?></a>
                            <a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getRegisterForm'))?>" class="button blue-button"><?php lang::_e('Register'); ?></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div><!-- End Search and Register -->
                </div>
			</div><!-- End Header -->
            <div class="clear"></div>