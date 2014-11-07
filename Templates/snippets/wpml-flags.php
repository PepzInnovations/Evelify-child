<!-- WPML plugin required -->
{if function_exists(icl_get_languages)}
{if icl_get_languages('skip_missing=0')}
<div class="wpml-switch right">
    <div class="language-button">
        <span class="language-title">
        {foreach icl_get_languages('skip_missing=0') as $lang}
            {if $lang['active'] == 1}{$lang['translated_name']}{/if}
        {/foreach}
        </span> <!-- /.language-title -->
    </div>
        <ul id="language-bubble" class="bubble clearfix">
            <li class="arrow">&nbsp;</li>
            <li class="holder">&nbsp;</li>
            {foreach icl_get_languages('skip_missing=0') as $lang}                            
            <li class="lang"><a href="{$lang['url']}"><img src="{$lang['country_flag_url']}" class="lang" alt="lang" />{$lang['translated_name']}</a></li>
            {/foreach}
        </ul>
</div> <!-- /.language-button -->
{/if}
{/if}