{extends $layout}

{block content}

{if $posts}

<article>

	<header class="entry-header">
		<div class="wrapper">

			<h1 class="entry-title">
				 {__ 'Author Archives:'}
	            <span class="vcard">
	                <a class="url fn n" href="{$author->postsUrl}" title="{$author->name}" rel="me">{$author->name}</a>
	            </span>
			</h1>
	        <span class="breadcrumbs">{breadcrumbs}</span>

		</div>
	</header>

</article>

<div id="content" role="main">
	<div id="primary">

		{include snippets/content-nav.php location => 'nav-above'}

		{include snippets/content-loop.php posts => $posts}

		{include snippets/content-nav.php location => 'nav-below'}

		{if strlen($author->bio) !== 0}
		<div class="author-archive-meta clearfix">
			<div id="author-avatar" class="left">{!$author->avatar(60)}</div>
			<div id="author-description" class="clearfix">
				<div class="author-name">{_x 'About', 'about author'} {$author->name}</div>
				<div class="bio">{$author->bio}</div>
			</div>
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
{/if}

	</div> <!-- /#primary -->
</div>
{/block}