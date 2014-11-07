<nav id="{$location}">
	{capture $prev}{!__ '%s Previous' |printf: '<span class="meta-nav">&larr;</span>'}{/capture}
	{capture $next}{!__ '%s Next' |printf: '<span class="meta-nav">&rarr;</span>'}{/capture}

	<div class="nav-previous">{prevPostLink $prev}</div>
	<div class="nav-next">{nextPostLink $next}</div>
</nav>