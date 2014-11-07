{if $post->willCommentsPaginate}
<nav id="comment-nav-{$location}">

	{capture $prev} {__ '&larr; Older Comments'} {/capture}
	{capture $next} {__ 'Newer Comments &rarr;'} {/capture}

	<div class="nav-previous">{prevCommentsLink $prev}</div>
	<div class="nav-next">{nextCommentsLink $next}</div>
</nav>
{/if}