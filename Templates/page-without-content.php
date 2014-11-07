{extends $layout}
<div id="content" role="main">
<div id="primary">
{block content}
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