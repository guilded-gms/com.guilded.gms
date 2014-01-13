<li>
	<div class="box48 framed">
		{@$character->getPrimaryClass()->getImageTag()}

		<div>
			<div class="containerHeadline">
				<h3><a href="{link controller='Character' object=$character application='gms'}{/link}" title="{$character->getTitledName()}">{@$character->getTitle()}</a></h3>
				{if $character->getRank()}<span class="badge badgeUpdate">{@$character->getRank()->getTitle()}</span>{/if}
			</div>

			<div class="details characterInformation">
				{include file='characterInformation' application='gms'}
			</div>

			{if $character->canEdit() || $character->canDelete()}
				<small>{if $character->canEdit()}<a href="{link controller='CharacterEdit' object=$character application='gms'}{/link}" title="{lang}wcf.global.button.edit{/lang}">{lang}wcf.global.button.edit{/lang}</a>{/if}{if $character->canDelete()} - <span title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$character->characterID}" data-confirm-message="{lang}gms.character.delete.sure{/lang}">{lang}wcf.global.button.delete{/lang}</span>{/if}</small>
			{/if}
		</div>
	</div>
</li>