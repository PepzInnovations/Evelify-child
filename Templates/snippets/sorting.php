{ifset $themeOptions->directory->showSortingControl}

<div class="dir-sorting clearfix">
	
	<!-- <div class="label">{_ "Showing"} {$GLOBALS['wp_query']->post_count} {_ "from"} {$GLOBALS['wp_query']->found_posts} {_ "Items"}</div> -->

	<form>

		{var $params = array()} 
		{parse_str($_SERVER['QUERY_STRING'],$params)}
		
		{foreach $params as $key => $param}
		{if ($key != "pagination") && ($key != "orderby") && ($key != "order")}
		<input type="hidden" id="sorting-{$key}" name="{$key}" value="{$param}">
		{/if}
		{/foreach}

		<div class="count">
			<label for="pagination">{_ "Count:"}</label>
			<select name="pagination" id="sorting-pagination">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="20">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</div>

		<div class="sortby">
			<label for="orderby">{_ "Sort by:"}</label>
			<select name="orderby" id="sorting-sortby">
				<option value="post_date">{_ "Date"}</option>
				<option value="post_title">{_ "Title"}</option>
				{ifset $themeOptions->rating->enableRating}
				<option value="rating">{_ "Rating"}</option>
				{/ifset}
				<option value="comment_count">{_ "Comment count"}</option>
				<option value="packages">{_ "Packages"}</option>
			</select>
		</div>

		<div class="sort">
			<label for="order">{_ "Sort:"}</label>
			<select name="order" id="sorting-sort">
				<option value="ASC">&and;</option>
				<option value="DESC">&or;</option>
			</select>
		</div>

	</form>

</div>

<script>
jQuery(document).ready(function($) {
	
	var sorting = $('.dir-sorting'),
		form = sorting.find('form'),
		count = sorting.find('#sorting-pagination'),
		sortby = sorting.find('#sorting-sortby'),
		sort = sorting.find('#sorting-sort');

	var firstPageLink = "{!get_pagenum_link(1,false)}";

	var values = { };
		values.count = {get_query_var('posts_per_page')};
		values.sortby = "{if !empty($_GET['orderby'])}{!$_GET['orderby']}{elseif isset($themeOptions->directory->defaultOrderby)}{!$themeOptions->directory->defaultOrderby}{else}date{/if}";
		values.sort = "{if !empty($_GET['order'])}{!$_GET['order']}{elseif isset($themeOptions->directory->defaultOrder)}{!$themeOptions->directory->defaultOrder}{else}DESC{/if}";
		
	// if select don't have value
	if (count.find("option[value='"+values.count+"']").length == 0) {
		count.prepend('<option value="'+values.count+'">'+values.count+'</option>');
	}
	count.val(values.count);
	sortby.val(values.sortby);
	sort.val(values.sort);

	count.change(function(event) {
		form.attr("action",firstPageLink);
		form.submit();
	});
	sortby.change(function(event) {
		form.removeAttr('action');
		form.submit();
	});
	sort.change(function(event) {
		form.removeAttr('action');
		form.submit();
	});

});
</script>

{/ifset}

