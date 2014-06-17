{include file='header' pageTitle='gms.acp.character.list'}

<header class="boxHeadline">
	<h1>{lang}gms.acp.character.list{/lang}</h1>
	
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
			<h2>{lang}gms.acp.character.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnCharacterID{if $sortField == 'characterID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=characterID&sortOrder={if $sortField == 'characterID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnCharacterName{if $sortField == 'name'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=name&sortOrder={if $sortField == 'name' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.name{/lang}</a></th>
					<th class="columnText columnUsername{if $sortField == 'username'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=username&sortOrder={if $sortField == 'username' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.user.username{/lang}</a></th>
                    <th class="columnText columnCharacterGuild{if $sortField == 'guildID'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=guildID&sortOrder={if $sortField == 'guildID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.character.option.guildID{/lang}</a></th>
					<th class="columnText columnCharacterLevel{if $sortField == 'level'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=level&sortOrder={if $sortField == 'level' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.character.option.level{/lang}</a></th>
                    <th class="columnText columnCharacterRace{if $sortField == 'characterRace'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=characterRace&sortOrder={if $sortField == 'characterRace' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.character.option.races{/lang}</a></th>
					<th class="columnText columnCharacterClass{if $sortField == 'characterClass'} active {@$sortOrder}{/if}"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=characterClass&sortOrder={if $sortField == 'characterClass' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}gms.character.option.classes{/lang}</a></th>
					<th class="columnDate columnCharacterTime{if $sortField == 'characterTime'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='CharacterList' application='gms'}pageNo={@$pageNo}&sortField=characterTime&sortOrder={if $sortField == 'characterTime' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.acp.cache.list.mtime{/lang}</a></th>
					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{content}
					{foreach from=$objects item=$object}
						<tr class="jsCharacterRow">
							<td class="columnIcon">
								<a href="{link controller='CharacterEdit' id=$object->characterID application='gms'}{/link}" name="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
								<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" name="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$object->characterID}" data-confirm-message="{lang}gms.acp.guild.character.delete.sure{/lang}"></span>
								
								{event name='rowButtons'}
							</td>
							<td class="columnID columnCharacterID">{@$object->characterID}</td>
							<td class="columnTitle columnCharacterName"><a href="{link controller='CharacterEdit' id=$object->characterID application='gms'}{/link}" name="{lang}gms.acp.character.edit{/lang}">{$object->getTitle()}</a></td>
							<td class="columnText columnUser"><a href="{link controller='UserEdit' id=$object->getUserProfile()->userID application='gms'}{/link}" name="{lang}wcf.acp.user.edit{/lang}">{@$object->username}</a></td>
                            <td class="columnText columnCharacterGuild">{@$object->getGame()->getImageTag(16)} <a href="{link controller='GuildEdit' id=$object->guildID application='gms'}{/link}" name="{lang}gms.acp.guild.edit{/lang}">{@$object->getGuild()}</a></td>							
                            <td class="columnText columnCharacterLevel">{#$object->level}</td>
                            <td class="columnText columnCharacterRace">{@$object->getPrimaryRace()->getImageTag(16)} {@$object->getPrimaryRace()->getTitle()}</td>
                            <td class="columnText columnCharacterClass">{@$object->getPrimaryClass()->getImageTag(16)} {@$object->getPrimaryClass()->getTitle()}</td>
							<td class="columnDate columnCharacterTime">{@$object->time|time}</td>

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