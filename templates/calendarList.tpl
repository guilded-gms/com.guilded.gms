<ol class="containerList">
	{foreach from=$eventDates item=__event}
		<li>
			<div class="box48">
				<a href="{link controller='Event' object=$__event application='gms'}{/link}" title="{$__event->getTitle()}">{@$__event->getTitle()}</a>
			</div>
		</li>
	{/foreach}
</ol>