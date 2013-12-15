{include file='header' pageTitle='wcf.acp.game.list'}

<header class="boxHeadline">
	<h1>{lang}wcf.acp.game.list{/lang}</h1>
	
	<script type="text/javascript">
		//<![CDATA[
		$(function() {
			new WCF.Action.Delete('wcf\\data\\game\\GameAction', '.jsGameRow');
		});
		//]]>
	</script>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="GameList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='GameAdd'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}wcf.acp.game.add{/lang}</span></a></li>
			
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{hascontent}
	<div class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}wcf.acp.game.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnGameID{if $sortField == 'gameID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='GameList'}pageNo={@$pageNo}&sortField=gameID&sortOrder={if $sortField == 'gameID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnGameTitle{if $sortField == 'title'} active {@$sortOrder}{/if}"><a href="{link controller='GameList'}pageNo={@$pageNo}&sortField=title&sortOrder={if $sortField == 'title' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.title{/lang}</a></th>
					
					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{content}
					{foreach from=$objects item=$object}
						<tr class="jsGameRow">
							<td class="columnIcon">
								<a href="{link controller='GameEdit' id=$object->gameID}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
								<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$object->gameID}" data-confirm-message="{lang}wcf.acp.game.delete.sure{/lang}"></span>
								
								{event name='rowButtons'}
							</td>
							<td class="columnID columnGameID">{@$object->gameID}</td>
							<td class="columnTitle columnGameTitle"><a href="{link controller='GameEdit' id=$object->gameID}{/link}" title="{lang}wcf.acp.game.edit{/lang}">{$object->getTitle()|language}</a></td>
							
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
				<li><a href="{link controller='GameAdd'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}wcf.acp.game.add{/lang}</span></a></li>
				
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{hascontentelse}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/hascontent}

{include file='footer'}