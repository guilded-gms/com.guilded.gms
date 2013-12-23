<ol class="containerList">
	{foreach from=$events item=event}
		<li>
			<div class="box48">
				<a href="{link controller='Event' object=$event application='gms'}{/link}" title="{$event->getTitle()}">{$event->getTitle()}</a>
			</div>
		</li>
	{/foreach}
</ol>