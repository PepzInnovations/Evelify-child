		<footer id="colophon" class="page-footer mainpage" role="contentinfo">
			
			{isActiveSidebar footer-widgets}
			<div id="supplementary" class="widgets wrapper">
				
				<div id="footer-widgets" class="footer-widgets widget-area" role="complementary">
					{dynamicSidebar footer-widgets}
				</div>

			</div>
			{/isActiveSidebar}

			{include 'snippets/branding-footer.php'}

		</footer>

	</div><!-- #page -->

	{footer}

	{if isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")}
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', {$themeOptions->general->ga_code}]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	{/if}

</body>
</html>