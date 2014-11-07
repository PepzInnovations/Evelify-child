{getHeader}

{var $fullwidth = true}

{if isset($sidebarType) && $sidebarType == 'home'}
	{if is_active_sidebar('sidebar-home')}
		{var $fullwidth = false}
	{/if}
{elseif isset($sidebarType) && $sidebarType == 'item'}
	{if is_active_sidebar('sidebar-item')}
		{var $fullwidth = false}
	{/if}
{elseif isset($sidebarType) && $sidebarType == 'sidebar-1'}
	{if is_active_sidebar('sidebar-1')}
		{var $fullwidth = false}
	{/if}
{else}
	{var $fullwidth = true}
{/if}

<div id="main" class="mainpage{if $fullwidth} onecolumn{/if}">
	<div id="wrapper-row">

		{ifset $themeOptions->advertising->showBox2}
        <div id="advertising-box-2" class="advertising-box">
            <div class="wrapper-650">
            	{!$themeOptions->advertising->box2Content}
            </div>
        </div>
        {/ifset}
		
		{include #content, fullwidth => $fullwidth}

	</div>

</div> <!-- /#main -->

{getFooter}