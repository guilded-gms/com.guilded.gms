<fieldset>
	<legend class="invisible">{lang}gms.guild.emblem{/lang}</legend>

	<div class="guildProfileEmblem">
		<div class="framed"><span class="icon icon-picture" style="width: 180px; height: 180px"></span></div>
	</div>
</fieldset>

<fieldset>
	<legend>{lang}gms.guild.information{/lang}</legend>

	<div>
		<dl class="plain inlineDataList">
			<dt>{lang}gms.guild.characters{/lang}</dt>
			<dd>{#$guild->getCharacters()|count}</dd> {* @todo link to members tab *}

			{event name='statistics'}
		</dl>
	</div>
</fieldset>

{event name='boxes'}