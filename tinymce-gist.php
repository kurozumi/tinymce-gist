<?php
/**
 * Plugin Name: TinyMCE Gist
 * Version: 0.1-alpha
 * Description: PLUGIN DESCRIPTION HERE
 * Author: kurozumi
 * Author URI: http://a-zumi.net
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: tinymce-gist
 * Domain Path: /languages
 * @package Tinymce-gist
 */

if (is_admin())
{
	$tinymce_gist = new TinyMCEGist;
	$tinymce_gist->register();
}

class TinyMCEGist
{
	public function register()
	{
		add_action("plugins_loaded", array($this, "plugins_loaded"));
	}

	public function plugins_loaded()
	{
		add_action("admin_init", array($this, "admin_init"));
	}

	public function admin_init()
	{
		// ビジュアルエディタにボタン追加
		add_filter("mce_buttons", array($this, "mce_buttons"));
		
		// ビジュアルエディタに追加したボタン用のjsを登録
		add_filter("mce_external_plugins", array($this, "mce_external_plugins"));
	}
	
	public function mce_buttons($buttons)
	{
		array_push($buttons, "tinymce_gist");
		return $buttons;
	}

	public function mce_external_plugins($plugins)
	{
		$plugins["tinymce_gist"] = plugins_url("/plugin.js", __FILE__);
		return $plugins;
	}
}