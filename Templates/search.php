{extends $layout}

{block content}

<header class="entry-header search-header">
	<div class="wrapper">
		<h1 class="entry-title"><span>{__ 'Search Results for:'} <strong>{!$site->searchQuery}</strong></span></h1>
		<div class="clearfix">
			<div class="breadcrumbs left clearfix">{breadcrumbs}</div>
			{if $type}
			<div class="right">
				{include 'snippets/sorting.php'}
			</div>
			{/if}
		</div>
	</div>
</header>

<div id="content" role="main">
	<div id="primary">

		{if $posts}
			

			{if $type}
				
				{include snippets/content-loop-dir-search.php posts => $posts}

			{else}

				{include snippets/content-loop.php posts => $posts}

			{/if}

			{willPaginate}
			<nav class="paginate-links">
				{paginateLinks true}
			</nav>
			{/willPaginate}

			{ifset $themeOptions->advertising->showBox4}
			<div id="advertising-box-4" class="advertising-box wrapper-650">
			    {!$themeOptions->advertising->box4Content}
			</div>
			{/ifset}

		{else}

			{include snippets/nothing-found.php}

		{/if}

	</div> <!-- /#primary -->
</div>

{/block}