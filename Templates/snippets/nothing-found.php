<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><span>{__ 'Nothing Found'}</span></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		{ifset $type}
			<p>{__ 'Apologies, but no results were found for the request.'}</p>
		{else}
			<p>{__ 'Apologies, but no results were found for the request. Perhaps searching will help find a related post.'}</p>
			<div class="clearfix">
				{include search-form.php}
			</div>
		{/ifset}		
	</div><!-- .entry-content -->
</article><!-- #post-0 -->