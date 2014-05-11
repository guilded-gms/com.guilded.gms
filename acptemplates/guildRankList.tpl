{include file='header' pageTitle='gms.acp.guild.rank.list'}

<header class="boxHeadline">
	<h1>{lang}gms.acp.guild.rank.list{/lang}</h1>
	
	<script type="text/javascript">
		//<![CDATA[
		$(function() {
			new WCF.Action.Delete('wcf\\data\\guild\rank\\GuildRankAction', '.jsGuildRankRow');
		});
		//]]>
	</script>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="GuildRankList" application='gms' link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='GuildRankAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.guild.rank.add{/lang}</span></a></li>
			
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{hascontent}
	<div class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}gms.acp.guild.rank.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnGuildRankID{if $sortField == 'rankID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='GuildRankList'}pageNo={@$pageNo}&sortField=rankID&sortOrder={if $sortField == 'rankID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnGuildRankTitle{if $sortField == 'name'} active {@$sortOrder}{/if}"><a href="{link controller='GuildRankList'}pageNo={@$pageNo}&sortField=name&sortOrder={if $sortField == 'name' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.name{/lang}</a></th>
					<th class="columnTitle columnGuildRankGuild{if $sortField == 'guildID'} active {@$sortOrder}{/if}"><a href="{link controller='GuildRankList'}pageNo={@$pageNo}&sortField=guildID&sortOrder={if $sortField == 'guildID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.acp.guild.rank.guildID{/lang}</a></th>

					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{content}
					{foreach from=$objects item=$object}
						<tr class="jsGuildRankRow">
							<td class="columnIcon">
								<a href="{link controller='GuildRankEdit' id=$object->rankID}{/link}" name="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
								<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" name="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$object->rankID}" data-confirm-message="{lang}gms.acp.guild.rank.delete.sure{/lang}"></span>
								
								{event name='rowButtons'}
							</td>
							<td class="columnID columnGuildRankID">{@$object->rankID}</td>
							<td class="columnTitle columnGuildRankTitle"><a href="{link controller='GuildRankEdit' id=$object->rankID}{/link}" name="{lang}gms.acp.guild.rank.edit{/lang}">{$object->getTitle()|language}</a></td>
							<td class="columnTitle columnGuildRankGuild"><a href="{link controller='GuildEdit' id=$object->guildID}{/link}" name="{lang}gms.acp.guild.edit{/lang}">{$object->getGuild()->getTitle()}</a></td>

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
				<li><a href="{link controller='GuildRankAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.guild.rank.add{/lang}</span></a></li>
				
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{hascontentelse}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/hascontent}

{include file='footer'}