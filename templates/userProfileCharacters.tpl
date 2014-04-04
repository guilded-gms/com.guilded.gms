{if $games|count > 0}
	<div class="containerPadding">
		{foreach from=$games item=game}
			<header class="boxHeadline">
				<h1>{$game->getTitle()}</h1>
			</header>

			<div class="container marginTop shadow">
				<ol class="containerList characterList doubleColumned">
					{foreach from=$characters item=__character}
						{if $__character->gameID == $game->gameID}
							{include file='characterListItem' application='gms' character=$__character}
						{/if}
					{/foreach}
				</ol>
			</div>
		{/foreach}
	</div>
{else}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}