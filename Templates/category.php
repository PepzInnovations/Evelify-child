{extends $layout}

{block content}

{if $posts}
	
<article id="post-{$post->id}" class="{$post->htmlClasses}">

		<header class="entry-header">
			<div class="wrapper">

				<h1 class="entry-title">
					{__ 'Category Archives:'} <span>{$category->title}</span>
				</h1>
				<span class="breadcrumbs">{breadcrumbs}</span>
				
			</div>
		</header>

		{if strlen($category->description) !== 0}
		<div class="entry-content">
			{!$category->description}
		</div>
		{/if}
		
</article><!-- /#post-{$post->id} -->	

<div id="content" role="main">
	<div id="primary">

		{include snippets/content-nav.php location => 'nav-above'}

		{include snippets/content-loop.php posts => $posts}

		{include snippets/content-nav.php location => 'nav-below'}

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
</div> <!-- /#content -->
{/block}