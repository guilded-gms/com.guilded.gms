<div class="containerPadding">
	{if $games|count > 0}
		<div class="container containerPadding marginTop">
			{foreach from=$games item=game}
				{hascontent}
					<header class="boxHeadline">
						<h1>{$game->getTitle()}</h1>
					</header>

					<div class="container marginTop shadow">
						<ol class="containerList characterList doubleColumned">
							{foreach from=$characters item=character}
								{if $character->gameID == $game->gameID}
									{content}
										{include file='characterListItem' application='gms'}
									{/content}
								{/if}
							{/foreach}
						</ol>
					</div>
				{/hascontent}
			{/foreach}
		</div>
	{else}
		<p class="info">{lang}wcf.global.noItems{/lang}</p>
	{/if}
</div>