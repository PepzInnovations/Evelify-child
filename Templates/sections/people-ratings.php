{if !empty($items)}
<div class="section-people-ratings">
	<div class="wrapper">
		<h3 class="section-title">{_ "People Saying"}</h3>
		<div class="people-ratings">
			<div n:foreach="$items as $item" class="person-rating" data-by="{$item->post_title}" data-for="{$item->for->post_title}" data-for-link="{get_permalink($item->for->ID)}" style="display: none;">
				<div class="rating-bubble">
					<div class="content">{$item->post_content}</div>
					<div class="stars clearfix">
						{for $j = 1; $j <= $item->rating['max']; $j++}
						<span class="star{if $j <= $item->rating['val']} active{/if}{if $j == $item->rating['max']} last{/if}"></span>
						{/for}
					</div>
				</div>
				<div class="rating-meta-info">
					<span class="by">{$item->post_title}</span>
					{_ "at"}
					<a href="{get_permalink($item->for->ID)}" class="at">{$item->for->post_title}</a>
				</div>
			</div>
			<div class="section-controls">
				<div class="prev"><div class="prev-img"></div></div>
				<div class="next"><div class="next-img"></div></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var sec = $('.section-people-ratings'),
		ratings = sec.find('.person-rating'),
		controls = sec.find('.section-controls'),
		current = 0,
		count = ratings.length,
		animated = false,
		speed = 400;

	ratings.eq(current).show();

	controls.find('.prev').click(function(event) {
		if (!animated) {
			animated = true;
			if (current > 0) {
				ratings.eq(current).fadeOut(speed, function() {
					current -= 1;
					ratings.eq(current).fadeIn(speed, function() {
						animated = false;
					});
				});
			} else {
				ratings.eq(current).fadeOut(speed, function() {
					current = count - 1;
					ratings.eq(current).fadeIn(speed, function() {
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
				ratings.eq(current).fadeOut(speed, function() {
					current += 1;
					ratings.eq(current).fadeIn(speed, function() {
						animated = false;
					});
				});
			} else {
				ratings.eq(current).fadeOut(speed, function() {
					current = 0;
					ratings.eq(current).fadeIn(speed, function() {
						animated = false;
					});
				});
			}
		}
	});
});
</script>
{/if}