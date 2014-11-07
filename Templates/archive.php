{extends $layout}

{block content}

{if $posts}

	{if $type}

		<article>

			<header class="entry-header">
				<div class="wrapper">
					
					<h1 class="entry-title">
						<span>{__ 'Search result'}</span>
					</h1>
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

		</article>

		<div id="content" role="main">
			<div id="primary">

				{include snippets/content-loop-dir-search.php posts => $posts}

				{willPaginate}
				<nav class="paginate-links">
					{paginateLinks true}
				</nav>
				{/willPaginate}

			</div> <!-- /#primary -->
		</div>

	{else}

		<article id="post-{$post->id}" class="{$post->htmlClasses}">

			<header class="entry-header">
				<div class="wrapper">.
					
					<h1 class="entry-title">
						<span>
							{if $archive->isDay}
								{__ 'Daily Archives:'} <span>{date $posts[0]->date}</span>
							{elseif $archive->isMonth}
								{__ 'Monthly Archives:'} <span>{$posts[0]->date|date:'F Y'}</span>
							{elseif $archive->isYear}
								{__ 'Yearly Archives:'} <span>{$posts[0]->date|date:'Y'}</span>
							{else}
								{__ 'Blog Archives'}
							{/if}
						</span>
					</h1>.
					
				</div>
			</header>

		</article><!-- /#post-{$post->id} -->

		<div id="content" role="main">
			<div id="primary">
				{include snippets/content-nav.php location => 'nav-above'}

				{include snippets/content-loop.php posts => $posts}

				{include snippets/content-nav.php location => 'nav-below'}

			</div> <!-- /#primary -->
		</div>

	{/if}

	{ifset $themeOptions->advertising->showBox4}
	<div id="advertising-box-4" class="advertising-box wrapper-650">
	    {!$themeOptions->advertising->box4Content}
	</div>
	{/ifset}

{else}

	<div id="content" role="main">
		<div id="primary">
			{include snippets/nothing-found.php}
		</div> <!-- /#primary -->
	</div>

{/if}

{/block}

























