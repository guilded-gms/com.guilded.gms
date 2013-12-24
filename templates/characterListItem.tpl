<li>
	<div class="box48">
		<div class="containerHeadline">
			<h3><a href="{link controller='Character' object=$character application='gms'}{/link}" title="{$character->name}">{@$character->name}{*{@$character->getPrimaryClass()->getImageTag(48)}*}</a></h3>
			{if $character->getRank()}<span class="badge badgeUpdate">{@$character->getRank()->getTitle()}</span>{/if}
		</div>

		<div class="details characterInformation">
			{include file='characterInformation' application='gms'}
		</div>
	</div>
</li>