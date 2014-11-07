{ifset $themeOptions->socialIcons->displayIcons}
    {ifset $themeOptions->socialIcons->icons}
    <ul class="social-icons right clearfix">
        {foreach $themeOptions->socialIcons->icons as $icon}
        <li class="left"><a href="{if !empty($icon->link)}{$icon->link}{else}#{/if}"><img src="{$icon->iconUrl}" height="24" width="24" alt="{$icon->title}" title="{$icon->title}"></a></li>
        {/foreach}
    </ul>
    {/ifset}
{/ifset}