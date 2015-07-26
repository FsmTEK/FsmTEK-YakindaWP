<?php
/*
Plugin Name: Fsm Yakında Sayfası
Plugin URI: http://fsmtek.com
Description: Bu Pluginle Wp de Yakında Sayaçlı Yakında Sayfası Oluşturabilirsiniz
Author: Mehmet ÖZDEMiR
Author URI: https://github.com/FsmTEK/FsmTEK-YakindaWP
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Version: 1.0
*/

define( 'FSMTEK_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'FSMTEK_TEMPLATES_DIR',     FSMTEK_PLUGIN_DIR . trailingslashit( 'templates' ) );

$settings_data = get_option('fsmmaintenance_settings');
if($settings_data==true){
    define( 'TEMPLATE_PATH',     FSMTEK_TEMPLATES_DIR . trailingslashit( $settings_data['template'] ) );
    define( 'TEMPLATE_URL',     plugins_url('templates', __FILE__). '/'.$settings_data['template'] .'/' );
}

include_once(FSMTEK_PLUGIN_DIR.'settings.php');
include_once(FSMTEK_PLUGIN_DIR.'inc/functions.php');



?>