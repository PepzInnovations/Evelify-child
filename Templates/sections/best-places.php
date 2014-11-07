{if !empty($items)}
<div class="section-best-places">
    <div class="wrapper">
         <h3 class="section-title">{_ "The Best Places"}</h3>
        <div class="best-places-wrap">
        	{if !empty($post->options('sections')->section2Type)}
        		{var $displayType = $post->options('sections')->section2Type}
        	{else}
        		{var $displayType = 'grid'}
        	{/if}
            {include '../snippets/content-loop-dir-search.php' displayType => $displayType, posts => $items, hideSorting => true, onecolumn => true}   
        </div>
    </div>
</div>
{/if}