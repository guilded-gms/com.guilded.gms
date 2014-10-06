{* @todo list events of current day, by start time *}
<ol class="containerList">
	{foreach from=$currentDay->getEventDates() item=__event}
		<li>
			<div class="box48">
				<a href="{link controller='EventDate' object=$__event application='gms'}{/link}" title="{$__event->getTitle()}">{@$__event->getTitle()}</a>
			</div>
		</li>
	{/foreach}
</ol>