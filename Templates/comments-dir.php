{if $post->hasOpenComments}
{ifset $themeOptions->advertising->showBox3}
<div id="advertising-box-3" class="advertising-box wrapper-650">
    {!$themeOptions->advertising->box3Content}
</div>
{/ifset}
{/if}
{if $post->comments}
	{ifset $closeable}
	<div class="closeable">
		<div class="open-button item {if $defaultState == 'opened'}comments-opened{else}comments-closed{/if}">
			<span class="close-comments-text" {if $defaultState == 'opened'}{else}style="display: none;"{/if}>{__ "Close Comments"}</span>
			<span class="show-comments-text" {if $defaultState == 'opened'}style="display: none;"{/if}>{__ "Show Comments"}</span>
		</div>
	{/ifset}
{/if}

<div id="comments">
{if !$post->isPasswordRequired}

{if $post->comments}

		<h2 id="comments-title">
			{commentTitle $post->title, $post->commentsCount, 'One thought on', 'Thoughts on'}
		</h2>

		{include snippets/comments-pagination.php, location => 'above'}

		{listComments comments => $post->comments}
			{if $comment->type == 'pingback' or $comment->type == 'trackback'}
			<li class="post pingback">
				<p>
				Pingback
				{!$comment->author->link}
				{editCommentLink $comment->id}
				</p>
			{else}

			{* this is start tag, but end tag is missing in this template, it is included in {/listComments} macro. Weird. I know. *}
			<li class="{$comment->classes}">

				<article id="comment-{$comment->id}" class="comment">
					
					<div class="comment-content clearfix">
						<div class="comment-avatar left">{!$comment->author->avatar}</div>
						{if !$comment->approved}
							<em class="comment-awaiting-moderation">{__ 'Your comment is awaiting moderation.'}</em><br>
						{else}
							{!$comment->content}
						{/if}
					</div>

					<div class="comment-meta clearfix">
						<div class="meta-info author vcard left"><cite class="fn">{!$comment->author->nameWithLink}</cite></div>
						<div class="meta-info date left"><a href="{$comment->url}" class="comment-date"><time pubdate datetime="{$comment->date|date:'c'}">{date $comment->date} {_x 'at', 'comment publish time'} {date $comment->date, 'time'}</time></a></div>

						<div class="meta-controls reply right">{commentReplyLink 'Reply', $comment->args, $comment->depth, $comment->id}</div>
						<div class="meta-controls edit right">{editCommentLink $comment->id}</div>
					</div>

				</article>
			{/if}
	{/listComments}

	{include snippets/comments-pagination.php, location => 'below'}

{elseif !$post->hasOpenComments && $post->type != 'page' && $post->hasSupportFor('comments')}

	<p class="nocomments">{__ 'Comments are closed.'}</p>

{/if}

{* translations for parameters *}

{capture $reviewNoun}{_x 'Comment', 'noun'}{/capture}
{capture $reviewLoggedIn}{!__ 'You must be <a href="%s">logged in</a> to post a comment.'|printf: wp_login_url(apply_filters('the_permalink', get_permalink()))}{/capture}
{capture $reviewLeave}{__ 'Leave a Comment'}{/capture}
{capture $reviewReplyTo}{__ 'Leave a Comment to %s'}{/capture}
{capture $reviewCancel}{__ 'Cancel Comment'}{/capture}
{capture $reviewPost}{__ 'Post Comment'}{/capture}

{commentForm
	comment_field => '<p class="comment-form-comment"><label for="comment">' . $reviewNoun . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	must_log_in => '<p class="must-log-in">' .  $reviewLoggedIn . '</p>',
	title_reply => $reviewLeave,
	title_reply_to => $reviewReplyTo,
	cancel_reply_link => $reviewCancel,
	label_submit => $reviewPost
}

{else}
	<p class="nopassword">{__ 'This post is password protected. Enter the password to view any comments.'}</p>
{/if}
</div><!-- #comments -->

{if isset($closeable) && ($post->hasOpenComments)}
</div> 			<!-- /.closeable -->
{/if}