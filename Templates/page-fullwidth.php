{extends $layout}

{block content}

<header class="entry-header">
	<div class="wrapper">

		<h1 class="entry-title">
			<a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a>
		</h1>
		<span class="breadcrumbs">{breadcrumbs}</span>



		{*  <div class="entry-meta">
				<span class="sep">{__ 'Posted on'} </span>
				<a href="{dayLink $post->date}" title="{date $post->date}" rel="bookmark">
					<time class="entry-date" datetime="{date $post->date}" pubdate="">{date $post->date}</time>
				</a>
				<span class="by-author">
					<span class="sep"> {__ 'by'} </span>
					<span class="author vcard">
						<a class="url fn n" href="{$post->author->postsUrl}" title="{__ 'View all posts by'} {$post->author->name}" rel="author"> {$post->author->name}</a>
					</span>
				</span>
			</div>

			<div class="comments-link">
				<a href="{!$post->permalink}#comments" title="{__ 'Comment on'} {$post->title}">{$post->commentsCount}</a>
			</div> *}



	</div>
</header>


<div id="content" role="main">
	<div id="primary">

		<article id="post-{$post->id}" class="{$post->htmlClasses}">
			
			{if $post->thumbnailSrc}
			<a href="{!$post->thumbnailSrc}">
				<div class="entry-thumbnail"><img src="{thumbnailResize $post->thumbnailSrc, w => 940, h => 250}" alt=""></div>
			</a>
			{/if}

			<div class="entry-content">
				{!$post->content}
			</div>

		</article><!-- /#post-{$post->id} -->

		{include comments.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

		{ifset $themeOptions->advertising->showBox4}
		<div id="advertising-box-4" class="advertising-box wrapper-650">
		    {!$themeOptions->advertising->box4Content}
		</div>
		{/ifset}

	</div> <!-- /#primary -->
</div>

{foreach $secOrder as $sec}
	{if ($sec == 'specialOffers') && isset($post->options('sections')->section1Show)}
		{include 'sections/special-offers.php' items => $specialOffers}
	{/if}
	{if ($sec == 'bestPlaces') && isset($post->options('sections')->section2Show)}
		{include 'sections/best-places.php' items => $bestPlaces}
	{/if}
	{if ($sec == 'recentPlaces') && isset($post->options('sections')->section3Show)}
		{include 'sections/recent-places.php' items => $recentPlaces}
	{/if}
	{if ($sec == 'peopleRatings') && isset($post->options('sections')->section4Show)}
		{include 'sections/people-ratings.php' items => $peopleRatings}
	{/if}
{/foreach}

{/block}