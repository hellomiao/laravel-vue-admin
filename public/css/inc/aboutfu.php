<?php

function akina_add_admin_menu_page(){
		add_menu_page('aboutfu', '关于FUZZZ', 'edit_themes', 'akina_admin_page_root', 'akina_admin_page', 'dashicons-flag', 100);
	}
  
function akina_admin_page(){   
    echo '<div class="theme-about">
	<div class="fu-img">
	<img src="http://7xwpo4.com1.z0.glb.clouddn.com/fubg.jpg">
	</div>
	<div class="fu-info">
	<p>Hi！我是FUZZZ，我是一个后期合成师，当然设计也是我的常用技能，我学代码只是为了兴趣，只是单纯的让自己的设计得以实现。</p>
	<p>当然首先感谢您使用Akina主题，这是我的第一款主题，也是比较稚嫩的，如有问题请大家及时和我联系，本主题免费，我会长期维护下去，当然以我的技术并不能保证
	每个问题都可以解决，谢谢体谅。</p>
	<p>最后，很高兴认识大家~</p>
	</div>
	<div class="fu-she">
	<span class="qq"><img src="http://7xwpo4.com1.z0.glb.clouddn.com/qqinfo.png"></span>
	<span class="wechat"><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wechatinfo.png"></span>
	<span class="akina"><a href="http://www.akina.pw"><img src="http://7xwpo4.com1.z0.glb.clouddn.com/akina3.png"></a></span>
	</div>
	<div class="fufooter-info">
	<span class="copyright-fu">Design By : <a href="http://www.akina.pw">Fuzzz</a> </span>
	</div>
	
	</div>';   
}   
add_action('admin_menu', 'akina_add_admin_menu_page');  

/**
	 *  Enque admin styles for akina and page
	 *  
	 */
	function akina_admin_enqueue_style(){
		wp_register_style('akina_admin_css', get_template_directory_uri() . '/inc/css/admin.css', false);
		wp_enqueue_style('akina_admin_css');
	}
	add_action('admin_enqueue_scripts', 'akina_admin_enqueue_style');
 




