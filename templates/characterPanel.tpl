{if $__wcf->user->userID}
	<!-- character menu -->
	<li id="characterMenu" class="dropdown">
		<a class="dropdownToggle" data-toggle="characterMenu">{if $__wcf->getCharacterHandler()->getPrimaryCharacter()}{$__wcf->getCharacterHandler()->getPrimaryCharacter()->characterName}{else}{lang}wcf.character.noPrimary{/lang}{/if}</a>
		<ul class="dropdownMenu">
			{foreach from=$__wcf->getCharacterHandler()->getCharacters() item=$character}
				<li>
					<a href="{link controller='Character'}{/link}" class="box48">
						<div>{@$character->getGame()->getImageTag(48)}</div>
						
						<hgroup class="containerHeadline">
							<h1>{$character->characterName}</h1>
							{include file='characterInformation' object=$character}
						</hgroup>
					</a>
				</li>
			{/foreach}
			<li class="dropdownDivider"></li>
			<li><a href="{link controller='CharacterAdd'}t={@SECURITY_TOKEN}{/link}">{lang}wcf.character.add{/lang}</a></li>
		</ul>
	</li>
{/if}