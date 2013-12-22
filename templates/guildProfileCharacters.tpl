{if $characters}
	<div class="container marginTop">
		<ol class="containerList doubleColumned characterList">
			{foreach from=$characters item=character}
				{include file='characterListItem'}
			{/foreach}
		</ol>
	</div>
{else}
	<p class="info">{lang}wcf.guild.noCharacters{/lang}</p>
{/if}