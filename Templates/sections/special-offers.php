{if !empty($items)}
<div class="section-special-offers special-offer-holder">
	<div class="wrapper">
		<div n:foreach="$items as $offer" class="special-offer" style="display: none;">
				<div class="image{if empty($offer->options['specialImage'])} no-image{/if}">
					{if !empty($offer->options['specialImage'])}
						<a href="{$offer->link}"><img src="{thumbnailResize $offer->options['specialImage'], w => 450, h => 270}"></a>
					{/if}
					<div class="price">{$offer->options['specialPrice']}</div>
				</div>
				<div class="text">
					<h3 class="title"><a href="{$offer->link}">{$offer->options['specialTitle']}</a></h3>
					<div class="at">{__ "at"} <a href="{$offer->link}">{!$offer->post_title}</a></div>
					<div class="content">{!$offer->options['specialContent']}</div>
				</div>
		</div>
		<div class="section-controls">
			<div class="prev"><div class="prev-img"></div></div>
			<div class="next"><div class="next-img"></div></div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var sec = $('.section-special-offers'),
		offers = sec.find('.special-offer'),
		controls = sec.find('.section-controls'),
		current = 0,
		count = offers.length,
		animated = false,
		speed = 400;

	offers.eq(current).show();

	controls.find('.prev').click(function(event) {
		if (!animated) {
			animated = true;
			if (current > 0) {
				offers.eq(current).fadeOut(speed, function() {
					current -= 1;
					offers.eq(current).fadeIn(speed, function() {
						animated = false;
					});
				});
			} else {
				offers.eq(current).fadeOut(speed, function() {
					current = count - 1;
					offers.eq(current).fadeIn(speed, function() {
						animated = false;
					});
				});
			}
		}
	});

	controls.find('.next').click(function(event) {
		if (!animated) {
			animated = true;
			if (current < (count - 1)) {
				offers.eq(current).fadeOut(speed, function() {
					current += 1;
					offers.eq(current).fadeIn(speed, function() {
						animated = false;
					});
				});
			} else {
				offers.eq(current).fadeOut(speed, function() {
					current = 0;
					offers.eq(current).fadeIn(speed, function() {
						animated = false;
					});
				});
			}
		}
	});
});
</script>
{/if}