{ifset $registerErrors}
<div id="ait-dir-register-notifications" class="error">
	<div class="message wrapper">
	{!$registerErrors}
	<div class="close"></div>
	</div>
</div>
{/ifset}

{ifset $registerMessages}
<div id="ait-dir-register-notifications" class="info">
	<div class="message wrapper">
	{!$registerMessages}
	<div class="close"></div>
	</div>
</div>
{/ifset}

{ifset $themeOptions->advertising->showBox1}
<div id="advertising-box-1" class="advertising-box">
	<div class="wrapper">
		<div>{!$themeOptions->advertising->box1Content}</div>
	 </div>
</div>
{/ifset}

<div class="topbar"></div>

<header id="branding" role="banner" class="{if function_exists(icl_get_languages) && icl_get_languages('skip_missing=0')}wpml-active {else}wpml-inactive {/if}{ifset $themeOptions->general->registerMenuItem}register-active {else}register-inactive {/ifset}{ifset $themeOptions->general->loginMenuItem}login-active {else}login-inactive {/ifset}site-header">
	<div class="wrapper header-holder">
		<div id="logo" class="left">
			{if !empty($themeOptions->general->logo_img)}
			<a class="trademark" href="{$homeUrl}">
				<img src="{linkTo $themeOptions->general->logo_img}" alt="{$themeOptions->general->logo_text}" />
			</a>
			{else}
			<a href="{$homeUrl}">
				<span>{$themeOptions->general->logo_text}</span>
			</a>
			{/if}
		</div>
		
		<div class="menu-container right{if !is_admin()} clearfix{/if}">
			
		<div class="other-buttons">
			
			{if (!is_admin()) && function_exists(icl_get_languages)}
			{if icl_get_languages('skip_missing=0')}
			<!-- WPML plugin required -->
			<div class="lang-wpml clearfix right">
				<div class="wpml-switch clearfix">
					<div class="lang-button">
						{foreach icl_get_languages('skip_missing=0') as $lang}
							{if $lang['active'] == 1}{$lang['language_code']}{/if}
						{/foreach}
						<ul id="language-bubble" class="lang-bubble bubble clearfix">
							{foreach icl_get_languages('skip_missing=0') as $lang}
								{if $lang['active'] != 1}
									<li class="lang {if $lang['active'] == 1}active{/if} left"><a href="{$lang['url']}">{$lang['language_code']}</a></li>
								{/if}
							{/foreach}
						</ul>
					</div>
				</div> <!-- /.language-button -->
			</div>
			<div class="wpml-replace clearfix right">

			</div>
			{/if}
			{/if}
			
			{if is_admin()}
				<!-- EASY ADMIN MENU -->
				{var $screen = get_current_screen()}
				{var $subscriber = in_array('subscriber', $GLOBALS['current_user']->roles)}

				{if !$subscriber}
					<a href="{!admin_url('edit.php?post_type=ait-dir-item')}" class="items button{if (($screen->base == 'edit' && $screen->post_type == 'ait-dir-item') || ($screen->base == 'post' && $screen->post_type == 'ait-dir-item'))} button-primary{/if}">
						{__ 'My Advertenties'}
					</a>
					{if isset($themeOptions->rating->enableRating) and !isset($themeOptions->rating->disallowDirectoryUsers) }
					<a href="{!admin_url('edit.php?post_type=ait-rating')}" class="ratings button{if ($screen->base == 'edit' && $screen->post_type == 'ait-rating')} button-primary{/if}">
						{__ 'Ratings'}
					</a>
					{/if}
				{/if}
				<a href="{!admin_url('profile.php')}" class="account button{if ($screen->base == 'profile')} button-primary{/if}">
					{__ 'Profile'}
				</a>
				<a href="{home_url()}" class="view-site button">
					{__ 'View site'}
				</a>
			{/if}

			{ifset $themeOptions->general->loginMenuItem}
				{if is_user_logged_in()}
					<a href="{!wp_logout_url(home_url())}" class="{if is_admin()}login button{else}menu-login menu-logout clearfix right{/if}">{__ "Logout"}</a>
					{if !is_admin()}
					<a href="{!admin_url()}" class="menu-login menu-admin clearfix right">{__ "Dashboard"}</a>
					{/if}
				{else}
					<a href="{! wp_registration_url()}" class="{if is_admin()}login button{else}menu-login not-logged clearfix right{/if}">{__ "Register"}</a>
					<a href="{!wp_login_url()}" class="{if is_admin()}login button{else}menu-login not-logged clearfix right{/if}">{__ "Login"}</a>
					<div style="display: none;">
						<div id="dir-login-form-popup">
							{wp_login_form( array( 'form_id' => 'ait-dir-login-popup' ) )}
						</div>
					</div>
				{/if}
			{/ifset}

		</div>

			{if !is_admin()}
			<div class="menu-content defaultContentWidth clearfix right">
				<nav id="access" role="navigation">
					<span class="menubut bigbut">{__ 'Main Menu'}</span>
					{menu 'theme_location' => 'primary-menu', 'fallback_cb' => 'default_page_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu' }
				</nav><!-- #access -->
			</div>
			{/if}

		</div>

	</div>
</header><!-- #branding -->