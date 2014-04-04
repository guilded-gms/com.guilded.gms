{include file='header' pageTitle='gms.acp.guild.recruitment.tender.list'}

<header class="boxHeadline">
	<h1>{lang}gms.acp.guild.recruitment.tender.list{/lang}</h1>
	
	<script type="text/javascript">
		//<![CDATA[
		$(function() {
			new WCF.Action.Delete('wcf\\data\\guild\recruitment\tender\\GuildRecruitmentTenderAction', '.jsGuildRecruitmentTenderRow');
		});
		//]]>
	</script>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="GuildRecruitmentTenderList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='GuildRecruitmentTenderAdd'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.guild.recruitment.tender.add{/lang}</span></a></li>
			
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{hascontent}
	<div class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}gms.acp.guild.recruitment.tender.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnGuildRecruitmentTenderID{if $sortField == 'tenderID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='GuildRecruitmentTenderList'}pageNo={@$pageNo}&sortField=tenderID&sortOrder={if $sortField == 'tenderID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnGuildRecruitmentTenderTitle{if $sortField == 'title'} active {@$sortOrder}{/if}"><a href="{link controller='GuildRecruitmentTenderList'}pageNo={@$pageNo}&sortField=title&sortOrder={if $sortField == 'title' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.title{/lang}</a></th>
					
					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{content}
					{foreach from=$objects item=$object}
						<tr class="jsGuildRecruitmentTenderRow">
							<td class="columnIcon">
								<a href="{link controller='GuildRecruitmentTenderEdit' id=$object->tenderID}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
								<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$object->tenderID}" data-confirm-message="{lang}gms.acp.guild.recruitment.tender.delete.sure{/lang}"></span>
								
								{event name='rowButtons'}
							</td>
							<td class="columnID columnGuildRecruitmentTenderID">{@$object->tenderID}</td>
							<td class="columnTitle columnGuildRecruitmentTenderTitle"><a href="{link controller='GuildRecruitmentTenderEdit' id=$object->tenderID}{/link}" title="{lang}gms.acp.guild.recruitment.tender.edit{/lang}">{$object->getTitle()|language}</a></td>
							
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
				<li><a href="{link controller='GuildRecruitmentTenderAdd'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.acp.guild.recruitment.tender.add{/lang}</span></a></li>
				
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{hascontentelse}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/hascontent}

{include file='footer'}