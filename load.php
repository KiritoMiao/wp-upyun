<?php 
/*
Plugin Name: 又拍云存储插件 via HTTPS
Version: 1.2.3
Plugin URI: https://ixh.me
Description: 又拍云储存插件， 在后台中上传附件时，自动将附件上传到又拍云提供海内外多节点CDN加速服务； 本地服务器与又拍云空间所有附件一键上传/下载;(基于 Cuelog[https://www.cuelog.com] 创建的版本修改）
Author: Kirito
Author URI: https://ixh.me
*/

if(is_admin()){
	define('UPYUN_IS_WIN',strstr(PHP_OS, 'WIN') ? 1 : 0 );
	register_uninstall_hook( __FILE__, 'remove_upyun' );
	add_filter ( 'plugin_action_links', 'upyun_setting_link', 10, 2 );
	include_once ('upyun.class.php');
}
include ('UpyunClond.class.php');
new UpYunCloud();
//删除插件
function remove_upyun(){
	$exist_option = get_option('upyun_option');
	if(isset($exist_option)){
		delete_option('upyun_option');
	}
}
//设置按钮
function upyun_setting_link($links, $file){
	$plugin = plugin_basename(__FILE__);
	if ( $file == $plugin ) {
		$setting_link = sprintf( '<a href="%s">%s</a>', admin_url('options-general.php').'?page=set_upyun_option', '设置' );
		array_unshift( $links, $setting_link );
	}
	return $links;
}
?>
