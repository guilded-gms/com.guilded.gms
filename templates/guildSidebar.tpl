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
			<dt><a href="{link controller='Guild' object=$guild}#members{/link}">{lang}gms.guild.characters{/lang}</a></dt>
			<dd>{#$guild->getCharacters()|count}</dd>

			{event name='statistics'}
		</dl>
	</div>
</fieldset>

{* @todo validate html *}
{if $__boxSidebar|isset && $__boxSidebar}
	{@$__boxSidebar}
{/if}

{event name='boxes'}