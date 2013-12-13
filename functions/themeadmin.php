<?php
	
add_action('admin_menu', 'themeidea_admin_menu');

function themeidea_admin_menu() {
	add_theme_page(__( '友情提示', 'themeidea' ), __( '友情提示', 'themeidea' ), 'edit_themes', basename(__FILE__), 'themeidea_settings_page');
	add_action( 'admin_init', 'register_themeidea_settings' );
}

function register_themeidea_settings() {
	register_setting( 'themeidea-settings-group', 'themeidea_options' );
}

function themeidea_settings_page() {
if ( isset($_REQUEST['updated']) ) echo '<div id="message" class="updated fade"><p><strong> settings saved.</strong></p></div>';
if( 'reset' == isset($_REQUEST['reset']) ) {
	delete_option('themeidea_options');
	echo '<div id="message" class="updated fade"><p><strong> settings reset.</strong></p></div>';
}
?>
<style type="text/css">
@charset "utf-8";
.clearfix{clear:both}
.themeidea_nodisplay{display:none}
.wrap{margin:0 0 50px 10px}
.themeidea_option_wrap{margin:0; width:1920px; font-size:13px; font-family: "Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; border-left:1px solid #eee; border-bottom:1px solid #eee; border-right:1px solid #eee; background:#fff; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;overflow:hidden;float:left;}
.themeidea_option_section{width:850px; height:50px; background:#eee}
.themeidea_option_section h2{margin:0 0 0 30px; font-size:15px; font-family:"Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; color:#777; font-style:normal}
.themeidea_option{width:850px; display:block; border-top:1px solid #eee}
.themeidea_option .cbbox_checked{}
.themeidea_option_l{float:left; width:150px}
.themeidea_option_l label{margin:20px 0 20px 20px; width:150px; display:block; font-size:13px}
.themeidea_option_m{float:left; width:450px; margin:20px 0 20px 0}
.themeidea_option_m input{font-size:13px; font-family: "Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; color:#777}
.themeidea_option_m .radio_options{margin:0 20px 0 5px; position:relative}
.themeidea_option_m input[type="text"], .themeidea_option_m select{width:430px; font-size:13px; font-family: "Century Gothic", "Lucida Grande", Helvetica, Arial, 微软雅黑; padding:4px; color:#333; line-height:1em; background:#f3f3f3}
.themeidea_option_m input:focus, .themeidea_option_m textarea:focus{background:#fff}
.themeidea_option_m textarea{width:430px; height:60px; font-size:12px; padding:4px; color:#333; line-height:1.5em; background:#f3f3f3}
.themeidea_option_r{float:left; width:220px}
.themeidea_option_r small{margin:20px 0 20px 20px; width:200px; display:block; font-size:12px; color:#777}
#themeidea_nav_list{margin:30px 0 0 0;}
#themeidea_nav_list ul.themeidea_tabs_js{margin:0 0 0 10px; padding:0; width:850px; list-style:none}
#themeidea_nav_list ul.themeidea_tabs_js li{float:left; margin:0 4px 0 20px; padding:5px; border-left:1px solid #EEEEEE; border-top:1px solid #EEEEEE; border-right:1px solid #EEEEEE; cursor:pointer;border-top-left-radius:5px 5px;border-top-right-radius:5px 5px;}
#themeidea_nav_list ul.themeidea_tabs_js li.selected{background:#EEE; border-left:1px solid #f9f9f9; border-top:1px solid #f9f9f9; border-right:1px solid #f9f9f9;border-top-left-radius:5px 5px;border-top-right-radius:5px 5px;}
#themeidea_nav_list .themeidea_inside{margin:0}
#themeidea_nav_list .themeidea_inside ul{padding:0; list-style:none}
.themeidea_helppage{padding:20px 25px 20px 25px; width:800px; display:block; border-top:1px solid #eee}
.themeidea_helppage p{font-size:13px}
.themeidea_submit_form{float:left; margin:20px 0 0 0; display:block}
.themeidea_reset_form{float:left; margin:20px 0 0 20px; display:block}
#themeidea_admin_ie_warning_disable{float:right; color:#777; cursor:pointer}
#themeidea_admin_ie_warning_disable:hover{color:#333}
.none{display:none}
fieldset{width:80%; margin:15px 0 10px 74px; padding:10px 0 20px 20px; border:1px solid #EEE}
fieldset legend{ cursor:pointer;  font-size:13px;  color:#FFF; background:#2683AE; border-color:#EEE; -moz-box-shadow:0 0 5px #EEE; -webkit-box-shadow:0 0 5px #EEE; box-shadow:0 0 5px #EEE; padding:2px 15px 4px 15px; -webkit-border-radius:30px; -moz-border-radius:30px; border-radius:30px; -webkit-box-shadow:1px 1px 1px rgba(0,0,0,.29),inset 1px 1px 1px rgba(255,255,255,.44); -moz-box-shadow:1px 1px 1px rgba(0,0,0,.29),inset 1px 1px 1px rgba(255,255,255,.44); box-shadow:1px 1px 1px rgba(0,0,0,.29),inset 1px 1px 1px rgba(255,255,255,.44)}
.ads a{text-decoration: none;color:#268bb8;}
.ads a:hover{color:#d62d00;}
.ads {color:#9a9a9a}
</style>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div><h2>ISHARE STUDIO</h2><br>

<div class="clearfix"></div>
</div><!-- .wrap -->
<?php } ?>