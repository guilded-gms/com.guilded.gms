<fieldset>
	<legend class="invisible">{lang}gms.character.image{/lang}</legend>

	<div class="characterProfileImage">
		<div class="framed"><span class="icon icon-picture" style="width: 180px; height: 180px"></span></div>
	</div>
</fieldset>

<fieldset>
	<legend>{lang}gms.character.information{/lang}</legend>

	<div>
		<dl class="plain inlineDataList">
			<dt>{lang}gms.character.option.level{/lang}</dt>
			<dd>{#$character->level}</dd>

			<dt>{lang}gms.character.option.classes{/lang}</dt>
			<dd>{implode from=$character->getClassList() glue=", " item=__class}{$__class->getTitle()}{/implode}</dd>

			<dt>{lang}gms.character.option.races{/lang}</dt>
			<dd>{implode from=$character->getRaceList() glue=", " item=__race}{$__race->getTitle()}{/implode}</dd>

			<dt>{lang}gms.character.option.roles{/lang}</dt>
			<dd>{implode from=$character->getRoleList() glue=", " item=__role}{$__role->getTitle()}{/implode}</dd>

			{event name='statistics'}
		</dl>
	</div>
</fieldset>

{event name='boxes'}