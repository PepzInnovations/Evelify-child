{extends $layout}

{block content}

<div class="subcats-holder{if !isset($post->content)} no-margin{/if}{ifset $themeOptions->directory->showTopCategories} categories-active{else} categories-inactive{/ifset}{ifset $themeOptions->directory->showTopLocations} locations-active{else} locations-inactive{/ifset}">
	{ifset $themeOptions->directory->showTopCategories}
	<div class="category-subcategories categories onecolumn clearfix">
		<div class="wrapper">
			{if !empty($themeOptions->directory->topCategoriesTitle)}
			<h2>{!$themeOptions->directory->topCategoriesTitle}</h2>
			{/if}
			{var $i = 0}
			{foreach $subcategories as $category}
			{var $i++}
			{first}<ul class="subcategories">{/first}
				<li class="category sc-column {if $i == 4}sc-column-last {/if}one-fourth{if $i == 4}-last{/if}{if $i%2 == 0} responsive-last{/if}">
					<div class="category-wrap-table">
						<div class="category-wrap-row">
							<div class="heading">
								<div class="icon" style="background: url('{thumbnailResize $category->icon, w => 48, h => 48}') no-repeat center top;"></div>
								<h3><a href="{!$category->link}">{!$category->name}</a></h3>
							</div>
							<div class="description">
								{!$category->excerpt}
							</div>
						</div>
					</div>
				</li>
				{if $i == 4}
				<li class="clearfix"></li>
					{var $i = 0}
				{/if}
			{last}</ul>{/last}
			{/foreach}
		</div>
	</div>
	{/ifset}

	{ifset $themeOptions->directory->showTopLocations}
	<div class="category-subcategories locations onecolumn clearfix">
		<div class="wrapper">
			{if !empty($themeOptions->directory->topLocationsTitle)}
			<h2 class="subcategories-title">{!$themeOptions->directory->topLocationsTitle}</h2>
			{/if}
			{var $i = 0}
			{foreach $sublocations as $location}
			{var $i++}
			{first}<ul class="subcategories">{/first}
				<li class="category sc-column {if $i == 4}sc-column-last {/if}one-fourth{if $i == 4}-last{/if}{if $i%2 == 0} responsive-last{/if}">
					<div class="category-wrap-table">
						<div class="category-wrap-row">
							<div class="heading">
								<div class="icon" style="background: url('{thumbnailResize $location->icon, w => 48, h => 48}') no-repeat center top;"></div>
								<h3><a href="{!$location->link}">{!$location->name}</a></h3>
							</div>
							<div class="description">
								{!$location->excerpt}
							</div>
						</div>
					</div>
				</li>
				{if $i == 4}
				<li class="clearfix"></li>
					{var $i = 0}
				{/if}
			{last}</ul>{/last}
			{/foreach}
		</div>
	</div>
	{/ifset}
</div>

{if $post->content}
<div id="content" role="main">
	<div id="primary">

		<article id="post-{$post->id}" class="{$post->htmlClasses}">
			
			
			{if $themeOptions->directory->dirHomepageAltContent}
			<div class="alternative-content">
				{!$themeOptions->directory->dirHomepageAltContent}
			</div>
			{/if}
			
			{if $post->thumbnailSrc}
			<a href="{!$post->thumbnailSrc}">
				<div class="entry-thumbnail"><img src="{thumbnailResize $post->thumbnailSrc, w => 140, h => 200}" alt=""></div>
			</a>
			{/if}

			<div class="entry-content">
				{!$post->content}
			</div>

		</article><!-- /#post-{$post->id} -->

		{ifset $themeOptions->advertising->showBox4}
		<div id="advertising-box-4" class="advertising-box wrapper-650">
		    {!$themeOptions->advertising->box4Content}
		</div>
		{/ifset}

	</div>

	{isActiveSidebar sidebar-home}
	<div id="secondary" class="widget-area" role="complementary">
		{dynamicSidebar sidebar-home}
	</div>
	{/isActiveSidebar}

</div>
{/if}

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