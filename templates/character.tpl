{include file='documentHeader'}
<head>
	<title>{$character->getTitle()} - {lang}gms.character.characters{/lang} - {PAGE_TITLE|language}</title>

	{include file='headInclude'}

	<script data-relocate="true">
		//<![CDATA[
		$(function() {
			WCF.Language.addObject({
				'wcf.message.share': '{lang}wcf.message.share{/lang}',
				'wcf.message.share.facebook': '{lang}wcf.message.share.facebook{/lang}',
				'wcf.message.share.google': '{lang}wcf.message.share.google{/lang}',
				'wcf.message.share.permalink': '{lang}wcf.message.share.permalink{/lang}',
				'wcf.message.share.permalink.bbcode': '{lang}wcf.message.share.permalink.bbcode{/lang}',
				'wcf.message.share.permalink.html': '{lang}wcf.message.share.permalink.html{/lang}',
				'wcf.message.share.reddit': '{lang}wcf.message.share.reddit{/lang}',
				'wcf.message.share.twitter': '{lang}wcf.message.share.twitter{/lang}'
			});

			new GMS.Character.Profile.TabMenu({@$character->characterID}); {* @todo implement this *}

			WCF.TabMenu.init();

			new WCF.Message.Share.Content();

			{event name='javascriptInit'}
		});
		//]]>
	</script>
</head>

<body id="tpl{$templateName|ucfirst}">

{include file='characterSidebar' application='gms' assign='sidebar'}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline characterProfileHeadline characterProfile">
	<h1><a href="{link controller='Character' object=$character application='gms'}{/link}">{$character->getTitle()}</a></h1>

	<p>{if $character->getGuild() !== null}<a href="{link controller='Guild' object=$character->getGuild()}{/link}">{$character->getGuild()->getTitle()}</a> - {/if}{@$character->getGame()->getTitle()}</p>

	<nav class="jsMobileNavigation buttonGroupNavigation">
		<ul class="buttonGroup">{*
			*}{if $character->canEdit()}<li><a class="button" href="{link controller='CharacterEdit' id=$character->characterID application='gms'}{/link}" title="{lang}gms.character.edit{/lang}"><span class="icon icon16 icon-pencil"></span> <span>{lang}wcf.global.button.edit{/lang}</span></a></li>{/if}{*
			*}{event name='buttons'}{*
		*}</ul>
	</nav>

	{event name='headlineData'}
</header>

{include file='userNotice'}

<div class="contentNavigation">
	{hascontent}
		<nav>
			<ul>
				{content}
				{event name='contentNavigationButtons'}
				{/content}
			</ul>
		</nav>
	{/hascontent}
</div>

<section id="characterProfileContent" class="marginTop tabMenuContainer" data-active="{$characterProfileMenu->getActiveMenuItem()->getIdentifier()}">
	{assign var='menuItems' value=$characterProfileMenu->getAccessibleMenuItems($character->getDecoratedObject())}
	{if $menuItems|count > 1}
		<nav class="tabMenu">
			<ul>
				{foreach from=$menuItems item=menuItem}
					<li><a href="{$__wcf->getAnchor($menuItem->getIdentifier())}">{lang}gms.character.profile.menu.{@$menuItem->menuItem}{/lang}{if $menuItem->getContentManager()->getNumberOfItems($entry->getDecoratedObject())} <span class="badge badgeUpdate">{#$menuItem->getContentManager()->getNumberOfItems($character->getDecoratedObject())}</span>{/if}</a></li>
				{/foreach}
			</ul>
		</nav>
	{/if}

	{foreach from=$menuItems item=menuItem}
		<div id="{$menuItem->getIdentifier()}" class="container tabMenuContent" data-menu-item="{$menuItem->menuItem}">
			{if $menuItem === $characterProfileMenu->getActiveMenuItem()}
				{@$profileContent}
			{/if}
		</div>
	{/foreach}
</section>

{hascontent}
	<div class="container marginTop">
		<ul class="containerList infoBoxList">
			{content}
			{if ENABLE_SHARE_BUTTONS}
				<li class="box32 jsOnly shareInfoBox">
					<a href="{link controller='Character' object=$character->getDecoratedObject() appendSession=false application='gms'}{/link}" class="jsTooltip jsButtonShare" title="{lang}wcf.message.share{/lang}" data-link-title="{$character->getTitle()}"><span class="icon icon32 icon-link"></span></a>

					<div>
						<div class="containerHeadline">
							<h3>{lang}wcf.message.share{/lang}</h3>
						</div>

						{include file='shareButtons'}
					</div>
				</li>
			{/if}

			{event name='infoBoxes'}
			{/content}
		</ul>
	</div>
{/hascontent}

{include file='footer'}

</body>
</html>