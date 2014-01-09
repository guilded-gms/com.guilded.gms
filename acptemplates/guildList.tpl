{include file='header' pageTitle='gms.acp.guild.list'}

{* @todo check if at least one guild isPublic, otherwise show warning *}
<script data-relocate="true">
	//<![CDATA[
	$(function() {
		new WCF.Action.Delete('gms\\data\\guild\\GuildAction', '.jsGuildRow');
		new WCF.Action.Toggle('gms\\data\\guild\\GuildAction', '.jsGuildRow');
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
	new WCF.Table.EmptyTableHandler($('#guildTableContainer'), 'jsGuildRow', options);
	//]]>
</script>

<header class="boxHeadline">
	<h1>{lang}gms.acp.guild.list{/lang}</h1>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="GuildList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='GuildAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.guild.add{/lang}</span></a></li>
			
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{hascontent}
	<div id="guildTableContainer" class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}gms.acp.guild.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID{if $sortField == 'guildID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='GuildList' application='gms'}pageNo={@$pageNo}&sortField=guildID&sortOrder={if $sortField == 'guildID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle{if $sortField == 'name'} active {@$sortOrder}{/if}"><a href="{link controller='GuildList' application='gms'}pageNo={@$pageNo}&sortField=name&sortOrder={if $sortField == 'name' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.title{/lang}</a></th>
					<th class="columnText columnGame{if $sortField == 'gameID'} active {@$sortOrder}{/if}"><a href="{link controller='GuildList' application='gms'}pageNo={@$pageNo}&sortField=gameID&sortOrder={if $sortField == 'gameID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.acp.guild.gameID{/lang}</a></th>

					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{content}
					{foreach from=$objects item=$object}
						<tr class="jsGuildRow">
							<td class="columnIcon">
								<span class="icon icon16 icon-{if !$object->isPublic}check-empty{else}check{/if} jsToggleButton jsTooltip pointer" title="{lang}wcf.global.button.{if !$object->isPublic}enable{else}disable{/if}{/lang}" data-object-id="{@$object->guildID}" data-disable-message="{lang}wcf.global.button.disable{/lang}" data-enable-message="{lang}wcf.global.button.enable{/lang}"></span>
								<a href="{link controller='GuildEdit' id=$object->guildID application='gms'}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
								<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$object->guildID}" data-confirm-message="{lang}gms.acp.guild.delete.sure{/lang}"></span>

								{event name='rowButtons'}
							</td>
							<td class="columnID">{@$object->guildID}</td>
							<td class="columnTitle"><a href="{link controller='GuildEdit' id=$object->guildID application='gms'}{/link}">{$object->getTitle()}</a></td>
							<td class="columnText columnGame">{$object->getGame()->getTitle()}</td>

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
				<li><a href="{link controller='GuildAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.guild.add{/lang}</span></a></li>
				
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{hascontentelse}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/hascontent}

{include file='footer'}