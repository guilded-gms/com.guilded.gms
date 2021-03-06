{hascontent}
	<fieldset>
		<legend class="invisible">{lang}gms.guild.emblem{/lang}</legend>

		<div class="guildProfileImage framed">
			{content}{@$guild->getImageTag(180)}{/content}
		</div>
	</fieldset>
{/hascontent}

<fieldset>
	<legend>{lang}gms.guild.information{/lang}</legend>

	<div>
		<dl class="plain statsDataList">
			<dt><a href="{link controller='Guild' object=$guild application='gms'}#characters{/link}">{lang}gms.guild.characters{/lang}</a></dt>
			<dd>{#$guild->getCharacters()|count}</dd>

			{event name='statistics'}
		</dl>
	</div>
</fieldset>

{if $__boxSidebar|isset && $__boxSidebar}
	{@$__boxSidebar}
{/if}

{event name='boxes'}