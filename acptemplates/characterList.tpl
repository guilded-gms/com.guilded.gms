{include file='header' pageTitle='gms.acp.guild.character.list'}

<header class="boxHeadline">
	<h1>{lang}gms.acp.menu.link.gms.character.list{/lang}</h1>
	
	<script type="text/javascript">
		//<![CDATA[
		$(function() {
			new WCF.Action.Delete('wcf\\data\\guild\character\\CharacterAction', '.jsCharacterRow');
		});
		//]]>
	</script>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="CharacterList" application='gms' link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='CharacterAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.character.add{/lang}</span></a></li>
			
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{hascontent}
	<div class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}gms.acp.menu.link.gms.character.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnCharacterID{if $sortField == 'characterID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='CharacterList'}pageNo={@$pageNo}&sortField=rankID&sortOrder={if $sortField == 'characterID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnCharacterName{if $sortField == 'name'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList'}pageNo={@$pageNo}&sortField=name&sortOrder={if $sortField == 'name' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.name{/lang}</a></th>
					<th class="columnID columnCharacterGuild{if $sortField == 'guildID'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList'}pageNo={@$pageNo}&sortField=guildID&sortOrder={if $sortField == 'guildID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.character.option.guildID{/lang}</a></th>
					<th class="columnTitle columnCharacterGame{if $sortField == 'gameID'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList'}pageNo={@$pageNo}&sortField=gameID&sortOrder={if $sortField == 'gameID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.acp.guild.gameID{/lang}</a></th>
					<th class="columnID columnCharacterRace{if $sortField == 'characterRace'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList'}pageNo={@$pageNo}&sortField=characterRace&sortOrder={if $sortField == 'characterRace' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.character.option.races{/lang}</a></th>
					<th class="columnID columnCharacterClass{if $sortField == 'characterClass'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='CharacterList'}pageNo={@$pageNo}&sortField=characterClass&sortOrder={if $sortField == 'characterClass' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.character.option.classes{/lang}</a></th>

					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{content}
					{foreach from=$objects item=$object}
						<tr class="jsCharacterRow">
							<td class="columnIcon">
								<a href="{link controller='CharacterEdit' id=$object->characterID}{/link}" name="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
								<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" name="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$object->characterID}" data-confirm-message="{lang}gms.acp.guild.character.delete.sure{/lang}"></span>
								
								{event name='rowButtons'}
							</td>
							<td class="columnID columnCharacterID">{@$object->characterID}</td>
							<td class="columnTitle columnCharacterName"><a href="{link controller='CharacterEdit' id=$object->characterID}{/link}" name="{lang}gms.acp.character.edit{/lang}">{$object->getTitle()|language}</a></td>
							<td class="columnID columnCharacterGuild"><a href="{link controller='GuildEdit' id=$object->guildID}{/link}" name="{lang}gms.acp.guild.edit{/lang}">{@$object->getGuild()}</a></td>							
                            <td class="columnTitle columnCharacterGame">{@$object->getGame()->getTitle()}</td>
                            <td class="columnID columnCharacterRace">{@$object->getPrimaryRace()->getTitle()}</td>
                            <td class="columnID columnCharacterClass">{@$object->getPrimaryClass()->getTitle()}</td>

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
				<li><a href="{link controller='CharacterAdd' application='gms'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.character.add{/lang}</span></a></li>
				
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{hascontentelse}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/hascontent}

{include file='footer'}