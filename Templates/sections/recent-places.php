{if !empty($items)}
<div class="section-recent-places">
	<div class="wrapper">
		<h3 class="section-title">{_ "Recent Places"}</h3>
		<div class="recent-places-wrap">
			{if !empty($post->options('sections')->section3Type)}
        		{var $displayType = $post->options('sections')->section3Type}
        	{else}
        		{var $displayType = 'list'}
        	{/if}
			{include '../snippets/content-loop-dir-search.php' displayType => $displayType, posts => $items, hideSorting => true, onecolumn => true}   
		</div>
	</div>
</div>
{/if}