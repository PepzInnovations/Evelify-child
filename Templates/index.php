{extends $layout}

{block content}

{if $posts}
	
	{if $type}

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

	<div id="content" class="onecolumn" role="main">
		<div id="primary">
			{include snippets/content-loop-dir-search.php posts => $posts}

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
		</div> <!-- /#primary -->
	{else}

		{if !$isIndexPage}

		<header class="entry-header">
			<div class="wrapper">

				<h1 class="entry-title">
					<a href="{$post->permalink}" title="{__ 'Permalink to'} {$post->title}" rel="bookmark">{$post->title}</a>
				</h1>
				<span class="breadcrumbs">{breadcrumbs}</span>
				
			</div>
		</header>
			
			{* {if $post->thumbnailSrc}
			<a href="{!$post->thumbnailSrc}">
				<div class="entry-thumbnail"><img src="{thumbnailResize $post->thumbnailSrc, w => 140, h => 200}" alt=""></div>
			</a>
			{/if} *}		
		{/if}

		<div id="content" role="main">
			<div id="primary">

				<article {if !$isIndexPage}id="post-{$post->id}" class="{$post->htmlClasses}"{else}id="post-loop"{/if}>
					
					{if !$isIndexPage}
					<div class="entry-content">
						{!$post->content}
					</div>
					{/if}

					{include snippets/content-nav.php location => 'nav-above'}

					{include snippets/content-loop.php posts => $posts}

					{include snippets/content-nav.php location => 'nav-below'}

				</article><!-- /#post -->	
				
				{ifset $themeOptions->advertising->showBox4}
				<div id="advertising-box-4" class="advertising-box wrapper-650">
				    {!$themeOptions->advertising->box4Content}
				</div>
				{/ifset}

			</div> <!-- /#primary -->

	{/if}

{else}
	<div id="content" role="main">
		<div id="primary">
			{include snippets/nothing-found.php}
		</div> <!-- /#primary -->

{/if}

{if !$type}
{isActiveSidebar sidebar-1}
<div id="secondary" class="widget-area" role="complementary">
	{dynamicSidebar sidebar-1}
</div>
{/isActiveSidebar}
{/if}

</div> <!-- /#content -->
{/block}