{extends $layout}

{block content}

<header class="entry-header">
	<div class="wrapper">

		<h1 class="entry-title">{!$term->name}</h1>

		<div class="clearfix">
			<div class="category-breadcrumb clearfix">
				<span class="here">{__ 'You are here:'}</span>
				<span class="home"><a href="{!$homeUrl}">{__ 'Home'}</a>&nbsp;&nbsp;&gt;</span>
				{foreach $ancestors as $anc}
				{first}<span class="ancestors">{/first}
					<a href="{!$anc->link}">{!$anc->name}</a>&nbsp;&nbsp;&gt;
				{last}</span>{/last}
				{/foreach}
				<span class="name"><a href="{!$term->link}">{!$term->name}</a></span>
			</div>

			{include 'snippets/sorting.php'}
		</div>
		
		{if count($subcategories) > 0}
		<div class="category-subcategories whiteBg clearfix">
			{var $i = 0}
			{foreach $subcategories as $category}
			{var $i++}
			{first}<ul class="subcategories">{/first}
				<li class="category sc-column {if $i == 4}sc-column-last {/if}one-fourth{if $i == 4}-last{/if}{if $i%2 == 0} responsive-last{/if}">
					<div class="category-wrap-table">
						<div class="category-wrap-row">
														<div class="heading">
								<div class="icon" style="background: url('{thumbnailResize $category->icon, w => 48, h => 48 }') no-repeat center top;"></div>
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
		{/if}

	</div>
</header>

<div id="content" role="main">
<div id="primary">

<article id="post-item-category">

	<div class="entry-content">
		{!$term->description}
	</div>

	<div class="category-items items clearfix">

		<ul n:foreach="$posts as $item" class="items items-list-view">			
			<li class="item clearfix{ifset $item->packageClass} {$item->packageClass}{/ifset}{last} item-last{/last}{ifset $item->optionsDir['featured']} featured{/ifset}">
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
							{var $optionsDir = $item->optionsDir}
							{ifset $optionsDir['address']}
							<div class="item-meta-information item-address left">{$optionsDir['address']}</div>
							{/ifset}

							{if !empty($optionsDir['web'])}
							<div class="item-meta-information item-address left"><a href="{aitAddHttp($optionsDir['web'])}">{$optionsDir['web']}</a></div>
							{/if}

							{ifset $optionsDir['email']}
							<div class="item-meta-information item-meta-information-last item-address left"><a href="mailto:{$optionsDir['email']}">{$optionsDir['email']}</a></div>
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
<div id="advertising-box-4" class="advertising-box wrapper-650">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}

</div> <!-- /#primary -->
</div>
{/block}