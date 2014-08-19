<div class="box48 marginTop">
	<a class="framed characterLink" href="{link controller='Character' object=$character application='gms'}{/link}" data-character-id="{@$character->characterID}">{@$character->getGame()->getImageTag(48)}</a>

	<div class="boxHeadline">
		<h3><a href="{link controller='Character' object=$character application='gms'}{/link}" class="characterLink" data-character-id="{@$character->characterID}">{@$character->getTitledName()}</a></h3>

		<div class="characterInformation">
			{include file='characterInformation' application='gms' object=$character}
		</div>
	</div>
</div>