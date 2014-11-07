{ifset $displayType}{else}{var $displayType = 'grid'}{/ifset}

{if $displayType === 'list'}

	<ul class="items items-list-view{ifset $onecolumn} onecolumn{/ifset}">
	{foreach $posts as $item}
		{var $options = get_post_meta($item->ID, '_ait-dir-item', true)}
		<li class="item clearfix{ifset $item->packageClass} {$item->packageClass}{/ifset}{last} item-last{/last}{ifset $item->optionsDir['featured']} featured{/ifset}">
			<div class="item-content-wrapper clearfix left">
				{if $item->thumbnailDir}
				<div class="item-thumbnail left">
					<a href="{!$item->link}"><img src="{thumbnailResize $item->thumbnailDir, w => 84, h => 84}" alt="{__ 'Item thumbnail'}"></a>
				</div>
				{/if}
				<div class="item-description left">
					<h3 class="item-title"><a href="{!$item->link}">{$item->post_title}</a></h3>
					<p class="item-excerpt">{!$item->excerptDir}</p>
					<div class="item-meta">
						{ifset $options['address']}
						<div class="item-meta-information item-address left">{$options['address']}</div>
						{/ifset}

						{if !empty($options['web'])}
						<div class="item-meta-information item-website left"><a href="{aitAddHttp($options['web'])}">{$options['web']}</a></div>
						{/if}

						{ifset $options['email']}
						<div class="item-meta-information item-meta-information-last item-email left"><a href="mailto:{$options['email']}">{$options['email']}</a></div>
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
	{/foreach}
	</ul>

{else}

	{var $i = 0}
	{foreach $posts as $item}
	{first}<ul class="items items-grid-view clearfix{ifset $onecolumn} onecolumn{/ifset}">{/first}
	{var $i++}
		{var $options = get_post_meta($item->ID, '_ait-dir-item', true)}
		<li class="item clearfix sc-column {if $i == 3}sc-column-last {/if}one-third{if $i == 3}-last{/if}{ifset $item->packageClass} {$item->packageClass}{/ifset}{ifset $item->optionsDir['featured']} featured{/ifset}">

			{if $item->thumbnailDir}
			<div class="item-thumbnail">
				<a href="{!$item->link}"><img src="{thumbnailResize $item->thumbnailDir, w => 420, h => 200}" alt="{__ 'Item thumbnail'}"></a>
			</div>
			{/if}
			
			<h3 class="item-title"><a href="{!$item->link}">{$item->post_title}</a></h3>

			{ifset $options[address]}
			<div class="item-address-wrapper">
				<div class="item-address-pin"></div>
				<p class="item-address">
					{$options[address]}
				</p>
			</div>
			{/ifset}

			{ifset $themeOptions->rating->enableRating}
			<div class="item-rating rating-grey">
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
		{if $i == 3}<div class="clearfix"></div>{/if}
		{if $i == 3}
			{var $i = 0}
		{/if}
	{last}</ul>{/last}
	{/foreach}

{/if}