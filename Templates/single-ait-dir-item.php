{extends $layout}

{block content}
<div id="content" role="main">
<div id="primary">

<article id="post-{$post->id}" class="{$post->htmlClasses}">

	<div class="item-detail-top clearfix">

		{if $post->thumbnailSrc}
		<div class="item-detail-thumbnail left">
			<img src="{thumbnailResize $post->thumbnailSrc, w => 270, h => 130}" alt="{__ 'Item image'}">
		</div>
		{/if}

		<header class="item-detail-header{if $post->thumbnailSrc} left{/if}">
			<h1 class="entry-title">{$post->title}</h1>

			<div class="item-detail-breadcrumb breadcrumbs clearfix">
				<span class="home"><a href="{!$homeUrl}">{__ 'Home'}</a>&nbsp;&nbsp;</span>
				{foreach $ancestors as $anc}
					{first}<span class="ancestors">{/first}
					<a href="{!$anc->link}">{!$anc->name}</a>&nbsp;&nbsp;&gt;
					{last}</span>{/last}
				{/foreach}
				{ifset $term}<span class="name"><a href="{!$term->link}">{!$term->name}</a></span>{/ifset}
				<span class="title"> &gt;&nbsp;&nbsp;{$post->title}</span>
			</div>

			{if $rating}
			<span class="item-detail-rating">
				{for $i = 1; $i <= $rating['max']; $i++}
				<span class="star big{if $i <= $rating['val']} active{/if}"></span>
				{/for}
			</span>
			{/if}
		</header>

	</div>


	<div class="item-detail-info clearfix">
		
		{if (!empty($options['address'])) || (!empty($options['gpsLatitude'])) || (!empty($options['telephone'])) || (!empty($options['email'])) || (!empty($options['web']))}
		<div class="sc-column one-third">
			<dl class="item-detail-contact">
				
				{if (!empty($options['address']))}
			    <dt class="item-detail-info-term">{__ 'Address:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['address']}</dd>
			    {/if}
			     
			    {if (!empty($options['gpsLatitude']))}        
			    <dt class="item-detail-info-term">{__ 'GPS:'}</dt>
			    <dd class="item-detail-info-desc">{$options['gpsLatitude']}, {$options['gpsLongitude']}</dd>
			    {/if}
			    
			    {if (!empty($options['telephone']))}
			    <dt class="item-detail-info-term">{__ 'Telephone:'}</dt>
			    <dd class="item-detail-info-desc">{$options['telephone']}</dd>
			    {/if}
			    
			    {if (!empty($options['email']))}         
			    <dt class="item-detail-info-term">{__ 'Email:'} </dt>
			    <dd class="item-detail-info-desc"><a href="mailto:{!$options['email']}">{!$options['email']}</a></dd>
			    {/if}

			    {if (!empty($options['web']))} 
			    <dt class="item-detail-info-term">{__ 'Web:'} </dt>
			    <dd class="item-detail-info-desc"><a href="{!$options['web']}">{!$options['web']}</a></dd>
			    {/if}
			    
			</dl>
			{/if}
			<ul class="item-social-icons clearfix" n:inner-for="$i = 1; $i <= 6; $i++">
				<li class="item-social-icon left" n:if="!empty($options['socialImg' . $i]) && !empty($options['socialLink' . $i])">
					<a href="{$options['socialLink' . $i]}" class="block"><img src="{$options['socialImg' . $i]}" alt="ico{$i}" class="block"></a>
				</li>			
			</ul>
		</div>

		<div class="sc-column sc-column-last two-third-last">
			{if (!empty($options['hoursMonday'])) || (!empty($options['hoursTuesday'])) || (!empty($options['hoursWednesday'])) || (!empty($options['hoursThursday'])) || (!empty($options['hoursFriday'])) || (!empty($options['hoursSaturday'])) || (!empty($options['hoursSunday']))}     
			<dl class="item-detail-hours left">
				
				<dt class="item-detail-hours-title">{__ 'Hours Open: '}</dt> 
				
				{if (!empty($options['hoursMonday']))}
			    <dt class="item-detail-info-term">{__ 'Monday:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['hoursMonday']}</dd>
			    {/if}
			    
			    {if (!empty($options['hoursTuesday']))}
			    <dt class="item-detail-info-term">{__ 'Tuesday:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['hoursTuesday']}</dd>
			    {/if}
			    
			    {if (!empty($options['hoursWednesday']))}
			    <dt class="item-detail-info-term">{__ 'Wednesday:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['hoursWednesday']}</dd>
			    {/if}
			    
			    {if (!empty($options['hoursThursday']))}
			    <dt class="item-detail-info-term">{__ 'Thursday:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['hoursThursday']}</dd>
			    {/if}
			    
			    {if (!empty($options['hoursFriday']))}
			    <dt class="item-detail-info-term">{__ 'Friday:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['hoursFriday']}</dd>
			    {/if}

			    {if (!empty($options['hoursSaturday']))}
			    <dt class="item-detail-info-term">{__ 'Saturday:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['hoursSaturday']}</dd>
			    {/if}
			    
			    {if (!empty($options['hoursSunday']))}
			    <dt class="item-detail-info-term">{__ 'Sunday:'}</dt>
			    <dd class="item-detail-info-desc">{!$options['hoursSunday']}</dd>
			    {/if}
			    
			</dl>
			{/if}

			{if isset($options['emailContactOwner']) && (!empty($options['email']))}
			<a id="contact-owner-button" class="contact-owner button" href="#contact-owner-form-popup">{_ "Contact owner"}</a>
			<!-- contact owner form -->
			<div id="contact-owner-form-popup" style="display: none;">
				<div id="contact-owner-form" data-email="{$options['email']}">
					
					<h3>{_ "Contact Owner"}</h3>

					<div class="input name">
						<input type="text" class="cowner-name" name="cowner-name" value="" placeholder="{_ 'Your name'}">
					</div>
					<div class="input email">
						<input type="text" class="cowner-email" name="cowner-email" value="" placeholder="{_ 'Your email'}">
					</div>
					<div class="input subject">
						<input type="text" class="cowner-subject" name="cowner-subject" value="" placeholder="{_ 'Subject'}">
					</div>
					<div class="input message">
						<textarea class="cowner-message" name="cowner-message" cols="30" rows="4" placeholder="{_ 'Your message'}"></textarea>
					</div>
					<button class="contact-owner-send">{_ "Send message"}</button>
					
					<div class="messages">
						<div class="success" style="display: none;">{_ "Your message has been successfully sent"}</div>
						<div class="error validator" style="display: none;">{_ "Please fill out email, subject and message"}</div>
						<div class="error server" style="display: none;"></div>
					</div>

				</div>
			</div>
			{/if}

			{if (isset($themeOptions->directory->enableClaimListing)) && (!$hasAlreadyOwner)}
			<a id="claim-listing-button" class="claim-listing-button" href="#claim-listing-form-popup">{_ "Own this business?"}</a>
			<!-- claim listing form -->
			<div id="claim-listing-form-popup" style="display:none;">
				<div id="claim-listing-form" data-item-id="{$post->id}">

					<h3>{_ "Enter your claim"}</h3>

					<div class="input name">
						<input type="text" class="claim-name" name="claim-name" value="" placeholder="{_ 'Your name'}">
					</div>
					<div class="input email">
						<input type="text" class="claim-email" name="claim-email" value="" placeholder="{_ 'Your email'}">
					</div>
					<div class="input number">
						<input type="text" class="claim-number" name="claim-number" value="" placeholder="{_ 'Your phone number'}">
					</div>
					<div class="input username">
						<input type="text" class="claim-username" name="claim-username" value="" placeholder="{_ 'Username'}">
					</div>
					<div class="input message">
						<textarea class="claim-message" name="claim-message" cols="30" rows="4" placeholder="{_ 'Your claim message'}"></textarea>
					</div>
					<button class="claim-listing-send">{_ "Submit"}</button>
					
					<div class="messages">
						<div class="success" style="display: none;">{_ "Your claim has been successfully sent"}</div>
						<div class="error validator" style="display: none;">{_ "Please fill out inputs!"}</div>
						<div class="error server" style="display: none;"></div>
					</div>

				</div>
			</div>
			{/if}
			
			{if isset($options['gpsLatitude'], $options['gpsLongitude']) && !(empty($options['gpsLatitude']) && empty($options['gpsLongitude']))}
			<div class="itemDirections">
			</div>
			<input type="text" style="display:none" id="address-input"/>
			{/if}

		</div>

	</div>
	
	<div class="customFieldBf clearfix">
	</div>

	{ifset $options['galleryEnable']}
	<div class="item-gallery">
		
		{var $firstImage}
		{for $i = 1; $i <= 20; $i++}
			{if empty($firstImage) && (!empty($options['gallery'.$i]))}
			{var $firstImage = $options['gallery'.$i]}
			{/if}
		{/for}

		{if !empty($firstImage)}
		
		{ifset $fullwidth}
		<img class="item-gallery-large fullwidth" src="{thumbnailResize $firstImage, w => 977, h => 550}" alt="{__ 'Item image'}">
		{else}
		<img class="item-gallery-large" src="{thumbnailResize $firstImage, w => 718, h => 400}" alt="{__ 'Item image'}">
		{/ifset}
		
		<ul class="item-gallery-thumbnails">
			{for $i = 1; $i <= 20; $i++}
				{if !empty($options['gallery'.$i])}
				<li class="image image-{$i}" data-large-url="{ifset $fullwidth}{thumbnailResize $options['gallery'.$i], w => 977, h => 550}{else}{thumbnailResize $options['gallery'.$i], w => 718, h => 400}{/ifset}">
					<img src="{thumbnailResize $options['gallery'.$i], w => 96, h => 55}" alt="{__ 'Gallery image'}">
				</li>
				{/if}
			{/for}
		</ul>
		{/if}
		
	</div>
	{/ifset}
	
	<div class="entry-content clearfix">		
		{!$post->content}
	</div>
	
	{if isset($options['gpsLatitude'], $options['gpsLongitude']) && !(empty($options['gpsLatitude']) && empty($options['gpsLongitude']))}
	<input type="hidden" name="directionsLat"  id="directionsLat" value="{$options['gpsLatitude']}"/>
	<input type="hidden" name="directionsLong" id="directionsLong" value="{$options['gpsLongitude']}"/>
	
	<div id="dir-directions">
		<div id="mapcontainer" class="clearfix"></div>
		<div id="map-directions" class="clearfix" style="display:none;overflow:scroll"></div>
	</div>
	{/if}

	{ifset $themeOptions->directory->showShareButtons}
	<div class="item-detail-share clearfix">
		<!-- facebook -->
		<div class="item-detail-social fb">
			<iframe src="//www.facebook.com/plugins/like.php?href={$post->permalink}&amp;send=false&amp;layout=button_count&amp;width=113&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:113px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<!-- twitter -->
		<div class="item-detail-social tw">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="{$post->permalink}" data-text="{$themeOptions->directory->shareText}" data-lang="en">Tweet</a>
			<script>!function(d,s,id){ var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){ js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<!-- google plus -->
		<!-- Place this tag where you want the +1 button to render. -->
		<div class="item-detail-social gp">
			<div class="g-plusone"></div>
			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>

	</div>
	{/ifset}

</article><!-- /#post-{$post->id} -->


{ifset $themeOptions->advertising->showBox4}
<div id="advertising-box-4" class="advertising-box wrapper-650">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}
</div> <!-- /#primary -->


{isActiveSidebar sidebar-item}
<div id="secondary" class="widget-area" role="complementary">
	{dynamicSidebar sidebar-item}
</div>
{/isActiveSidebar}

</div>

{if isset($options['gpsLatitude'], $options['gpsLongitude']) && !(empty($options['gpsLatitude']) && empty($options['gpsLongitude']))}
<div class="wrapper item-map clearfix">
</div>
{/if}

{if (!empty($options['alternativeContent']))}
<div class="item-detail-alternative-content wrapper onecolumn">
	{!do_shortcode($options['alternativeContent'])}
</div>
{/if}

{ifset $options['specialActive']}
<div class="special-offer-holder">
	<div class="wrapper">
		<div class="image{if empty($options['specialImage'])} no-image{/if}">
			{if !empty($options['specialImage'])}
				<img src="{thumbnailResize $options['specialImage'], w => 450, h => 270}">
			{/if}
			<div class="price">{$options['specialPrice']}</div>
		</div>
		<div class="text">
			<h3 class="title">{$options['specialTitle']}</h3>
			<div class="content">{!$options['specialContent']}</div>
		</div>
	</div>
</div>
{/ifset}

{ifset $themeOptions->rating->enableRating}
<div class="ait-rating-system-holder">
	{!getAitRatingElement($post->id)}
</div>
{/ifset}

<div class="comments-holder">
	{include comments-dir.php, closeable => (isset($themeOptions->general->closeComments)) ? true : false, defaultState => $themeOptions->general->defaultPosition}
</div>

{/block}