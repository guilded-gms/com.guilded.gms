{if $characters}
	<div class="container marginTop">
		<ol class="containerList doubleColumned characterList">
			{foreach from=$characters item=character}
				{include file='characterListItem' application='gms'}
			{/foreach}
		</ol>
	</div>
{else}
	<p class="info">{lang}gms.guild.noCharacters{/lang}</p>
{/if}