{willPaginate}
	<nav id="{$location}">
		{capture $prev}{!__ '%s Newer posts' |printf: '<span class="meta-nav">&larr;</span>'}{/capture}
		{capture $next}{!__ '%s Older posts' |printf: '<span class="meta-nav">&rarr;</span>'}{/capture}

		<div class="nav-previous">{prevPostsLink $prev}</div>
		<div class="nav-next">{nextPostsLink $next}</div>
	</nav>
{/willPaginate}
