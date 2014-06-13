<div class="containerPadding">
{if $characters|count > 0}
	<div class="container marginTop">
		<ol class="containerList doubleColumned characterList">
			{foreach from=$characters item=__character}
				{include file='characterListItem' application='gms' character=$__character}
			{/foreach}
		</ol>
	</div>
{else}
	<p class="info">{lang}gms.guild.noCharacters{/lang}</p>
{/if}
</div>