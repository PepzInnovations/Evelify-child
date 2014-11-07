{var $fullwidth = false}
{if isset($sidebarType) && $sidebarType == 'home'}
	{if !is_active_sidebar('sidebar-home')}
		{var $fullwidth = true}
	{/if}
{elseif isset($sidebarType) && $sidebarType == 'item'}
	{if !is_active_sidebar('sidebar-item')}
		{var $fullwidth = true}
	{/if}
{else}
	{if !is_active_sidebar('sidebar-1')}
		{var $fullwidth = true}
	{/if}
{/if}

{foreach $posts as $post}
	<article id="post-{$post->id}" class="{$post->htmlClasses} clearfix">		

		<div class="entry clearfix">

			<h2 class="entry-title"><a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a></h2>

			<div class="entry-container clearfix">

				<div n:if="$post->thumbnailSrc != false" class="entry-thumbnail right">
					<a href="{$post->permalink}" class="block">
						<img src="{thumbnailResize $post->thumbnailSrc, w => 340, h => 160}" class="block" alt=""/>
					</a>
				</div>
				
				{if $site->isSearch}
					<div class="entry-content loop-content">{!$post->excerpt}</div>
				{else}
					<div class="entry-content loop-content">{!$post->content("", 0)}</div>
				{/if}

			</div> <!-- / .entry-container -->

			<div class="entry-meta clearfix right">
				<a href="{dayLink $post->date}" class="date meta-info" title="{date $post->date}" rel="bookmark">{date $post->date}</a>
				<a class="url fn n ln author meta-info" href="{$post->author->postsUrl}" title="View all posts by {$post->author->name}" rel="author">{$post->author->name}</a>
				<span n:if="$post->type == 'post' && $post->categories" class="categories meta-info">{!$post->categories}</span>
				<span class="comments meta-info">{$post->commentsCount}</span>
			</div>

		</div> <!-- / .entry -->

	</article>
{/foreach}
