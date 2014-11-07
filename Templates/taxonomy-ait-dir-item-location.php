{extends $layout}

{block content}

<header class="entry-header">
	<div class="wrapper">

		<h1 class="entry-title">{$term->name}</h1>

		<div class="category-breadcrumb left clearfix">
			<span class="here">{__ 'You are here:'}</span>
			<span class="home"><a href="{!$homeUrl}">{__ 'Home'}</a>&nbsp;&nbsp;&gt;</span>
			{foreach $ancestors as $anc}
			{first}<span class="ancestors">{/first}
				<a href="{!$anc->link}">{!$anc->name}</a>&nbsp;&nbsp;&gt;
			{last}</span>{/last}
			{/foreach}
			<span class="name"><a href="{!$term->link}">{!$term->name}</a></span>
		</div>

		<div class="right">
			{include 'snippets/sorting.php'}
		</div>
		
		{if count($subcategories) > 0}
		<div class="category-subcategories clearfix">
			{var $i = 0}
			{foreach $subcategories as $location}
			{var $i++}
			{first}<ul class="subcategories wrapper">{/first}
				<li class="category sc-column {if $i == 4}sc-column-last {/if}one-fourth{if $i == 4}-last{/if}{if $i%2 == 0} responsive-last{/if}">
					<div class="category-wrap-table">
						<div class="category-wrap-row">
							<div class="heading">
								<div class="icon" style="background: url('{thumbnailResize $location->icon, w => 48, h => 48 }') no-repeat center top;"></div>
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
		{/if}
		
	</div>
</header>


<div id="content" role="main">
<div id="primary">

<article id="post-item-category">

	<div class="entry-content">
		{!$term->description}
	</div>

	<div class="category-items clearfix">		

		<ul n:inner-foreach="$posts as $item" class="items items-list-view">
			<li class="item clearfix{ifset $item->packageClass} {$item->packageClass}{/ifset}{last} item-last{/last}{ifset $item->optionsDir['featured']} featured{/ifset}">
				{var $options = get_post_meta($item->id, '_ait-dir-item', true)}
				<div class="item-content-wrapper clearfix left">
					{if $item->thumbnailDir}
					<div class="item-thumbnail left">
						<a href="{!$item->link}"><img src="{thumbnailResize $item->thumbnailDir, w => 84, h => 84}" alt="{__ 'Item thumbnail'}"></a>
					</div>
					{/if}
					<div class="item-description left">
						<h3 class="item-title"><a href="{!$item->link}">{$item->title}</a></h3>
						<p class="item-excerpt">{!$item->excerptDir}</p>
						<div class="item-meta">
							{ifset $options['address']}
							<div class="item-meta-information item-address left">{$options['address']}</div>
							{/ifset}

							{if !empty($options['web'])}
							<div class="item-meta-information item-address left"><a href="{aitAddHttp($options['web'])}">{$options['web']}</a></div>
							{/if}

							{ifset $options['email']}
							<div class="item-meta-information item-meta-information-last item-address left"><a href="mailto:{$options['email']}">{$options['email']}</a></div>
							{/ifset}
						</div>
					</div>
				</div>

				{ifset $themeOptions->rating->enableRating}
				<div class="item-rating rating-grey right">
					{if $item->rating}
					<div class="item-stars clearfix">
						{for $j = 1; $j <= $item->rating['max']; $j++}
						<span class="star{if $j <= $item->rating['val']} active{/if}{if $j == $item->rating['max']} last{/if}"></span>
						{/for}
					</div>
					{else}
					<div class="item-no-rating">{__ "No rating yet."}</div>
					{/if}
				</div>
				{/ifset}
			</li>
		</ul>
	</div>
	
	{willPaginate}
	<nav class="paginate-links">
		{paginateLinks true}
	</nav>
{/willPaginate}

</article><!-- /#post-item-category -->

{ifset $themeOptions->advertising->showBox4}
<div id="advertising-box-4" class="advertising-box">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}

</div> <!-- /#primary -->
</div>
{/block}