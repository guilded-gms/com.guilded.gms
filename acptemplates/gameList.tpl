{include file='header' pageTitle='gms.acp.game.list'}

<script data-relocate="true">
	//<![CDATA[
	$(function() {
		new WCF.Action.Delete('gms\\data\\game\\GameAction', '.jsGameRow');
		new WCF.Action.Toggle('gms\\data\\game\\GameAction', '.jsGameRow');
	});

	var options = { };
	{if $pages > 1}
		options.refreshPage = true;
		{if $pages == $pageNo}
			options.updatePageNumber = -1;
		{/if}
	{else}
		options.emptyMessage = '{lang}wcf.global.noItems{/lang}';
	{/if}
	new WCF.Table.EmptyTableHandler($('#gameTableContainer'), 'jsGameRow', options);
	//]]>
</script>

<header class="boxHeadline">
	<h1>{lang}gms.acp.game.list{/lang}</h1>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="GameList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='GameAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.game.add{/lang}</span></a></li>
			
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{hascontent}
	<div id="gameTableContainer" class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}gms.acp.game.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnGameID{if $sortField == 'gameID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='GameList' application='gms'}pageNo={@$pageNo}&sortField=gameID&sortOrder={if $sortField == 'gameID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnGameTitle{if $sortField == 'title'} active {@$sortOrder}{/if}"><a href="{link controller='GameList' application='gms'}pageNo={@$pageNo}&sortField=title&sortOrder={if $sortField == 'title' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.title{/lang}</a></th>
					<th class="columnTitle columnPackageVersion">{lang}gms.acp.game.version{/lang}</th>

					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{content}
					{foreach from=$objects item=$game}
						<tr class="jsGameRow">
							<td class="columnIcon">
								<span class="icon icon16 icon-{if !$game->isEnabled}check-empty{else}check{/if} jsToggleButton jsTooltip pointer" title="{lang}wcf.global.button.{if !$game->isEnabled}enable{else}disable{/if}{/lang}" data-object-id="{@$game->gameID}" data-disable-message="{lang}wcf.global.button.disable{/lang}" data-enable-message="{lang}wcf.global.button.enable{/lang}"></span>
								<a href="{link controller='GameEdit' id=$game->gameID application='gms'}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
								<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$game->gameID}" data-confirm-message="{lang title=$game->title}gms.acp.game.delete.sure{/lang}"></span>
								
								{event name='rowButtons'}
							</td>
							<td class="columnID columnGameID">{@$game->gameID}</td>
							<td class="columnTitle columnGameTitle"><a href="{link controller='GameEdit' id=$game->gameID application='gms'}{/link}" title="{lang}gms.acp.game.edit{/lang}">{$game->getTitle()|language}</a></td>
							<td class="columnTitle columnPackageVersion">{$game->getPackage()->packageVersion}</td>

							{event name='columns'}
						</tr>
					{/foreach}
				{/content}
			</tbody>
		</table>
		
	</div>
	
	<div class="contentNavigation">
		{@$pagesLinks}
		
		<nav>
			<ul>
				<li><a href="{link controller='GameAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.game.add{/lang}</span></a></li>
				
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{hascontentelse}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/hascontent}

{include file='footer'}