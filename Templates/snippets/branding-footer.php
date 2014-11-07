<div id="site-generator" class="wrapper">
	<div id="footer-text">
		{!$themeOptions->general->footer_text}
	</div>
	{if !is_admin()}
	{menu 'theme_location' => 'footer-menu', 'fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu', 'depth' => 1 }
	{/if}
</div>