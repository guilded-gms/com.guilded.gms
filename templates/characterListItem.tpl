<li>
	<div class="box48 framed">
		{@$character->getPrimaryClass()->getImageTag()}

		<div>
			<div class="containerHeadline">
				<h3><a href="{link controller='Character' object=$character application='gms'}{/link}" title="{$character->getTitle()}">{@$character->getTitle()}</a></h3>
				{if $character->getRank()}<span class="badge badgeUpdate">{@$character->getRank()->getTitle()}</span>{/if}
			</div>

			<div class="details characterInformation">
				{include file='characterInformation' application='gms'}
			</div>
		</div>
	</div>
</li>