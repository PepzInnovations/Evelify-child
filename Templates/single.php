{extends $layout}

{block content}

<header class="entry-header">
	<div class="wrapper">
		<h1 class="entry-title">
			<a href="{$post->permalink}" title="{__ 'Permalink to'} {$post->title}" rel="bookmark">{$post->title}</a>
		</h1>
		<span class="breadcrumbs">{breadcrumbs}</span>
	</div>	
</header>

<div id="content" role="main" class="single-blog-post">
	<div id="primary">

		<article id="post-{$post->id}" class="{$post->htmlClasses}">

				{if $post->thumbnailSrc != false }
				<a href="{$post->thumbnailSrc}">
				<div class="entry-thumbnail">
					{var $imgWidth = 980}
					{isActiveSidebar post-sidebar} {var $imgWidth = 650} {/isActiveSidebar}
					<img src="{thumbnailResize $post->thumbnailSrc, w => $imgWidth, h => 400}" class="block" alt="" />
				</div>
				</a>
				{/if}


				<div class="entry-meta post-footer clearfix">
					<a href="{dayLink $post->date}" class="date meta-info" title="{date $post->date}" rel="bookmark">{date $post->date}</a>
					<a class="url fn n ln author meta-info" href="{$post->author->postsUrl}" title="View all posts by {$post->author->name}" rel="author">{$post->author->name}</a>
					<span n:if="$post->type == 'post' && $post->categories" class="categories meta-info">{!$post->categories}</span>
					<span n:if="$post->tags" class="tags meta-info">{!$post->tags}</span>
					<span class="comments meta-info">{$post->commentsCount}</span>
				</div><!-- /.entry-meta -->
				
				<div class="post-content entry-content">
					{!$post->content}
				</div>


				{if strlen($post->author->bio) !== 0}
				<aside class="author-archive-meta clearfix">
					<div id="author-avatar" class="left">{!$post->author->avatar(60)}</div>
					<div id="author-description" class="clearfix">
						<div class="author-name">{_x '', 'about author'} {$post->author->name}</div>
						<div class="bio">{$post->author->bio}</div>
					</div>
				</aside>
				{/if}


		</article><!-- /#post-{$post->id} -->

		{include comments.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

		{ifset $themeOptions->advertising->showBox4}
		<div id="advertising-box-4" class="advertising-box wrapper-650">
		    {!$themeOptions->advertising->box4Content}
		</div>
		{/ifset}

	</div> <!-- /#primary -->

	{isActiveSidebar sidebar-1}
	<div id="secondary" class="widget-area" role="complementary">
		{dynamicSidebar sidebar-1}
	</div>
	{/isActiveSidebar}

</div>
{/block}