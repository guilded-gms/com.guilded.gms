{include file='documentHeader'}

<head>
	<title>{lang}wcf.character.profile{/lang} - {lang}wcf.character.characters{/lang} - {PAGE_TITLE|language}</title>
	{include file='headInclude'}

	{event name='javascriptInclude'}
	<script type="text/javascript">
		//<![CDATA[
		$(function() {		
			new WCF.Character.Profile.TabMenu({@$character->characterID});
			
			WCF.TabMenu.init();
						
			{event name='javascriptInit'}
		});
		//]]>
	</script>	
</head>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{capture assign='sidebar'}
	{include file='characterSidebar'}
{/capture}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline userHeadline">
	<hgroup>
		<h1>{@$character->getTitle()}</h1>
	</hgroup>
	
	<ul class="dataList">
		<li>{$character->characterID}</li>
	</ul>
</header>

{include file='userNotice'}

<section id="profileContent" class="marginTop tabMenuContainer" data-active="{$__wcf->getCharacterProfileMenu()->getActiveMenuItem()->getIdentifier()}">
	<nav class="tabMenu">
		<ul>
			{foreach from=$__wcf->getCharacterProfileMenu()->getMenuItems() item=menuItem}
				<li><a href="{$__wcf->getAnchor($menuItem->getIdentifier())}" title="{lang}{@$menuItem->menuItem}{/lang}">{lang}wcf.character.profile.menu.{@$menuItem->menuItem}{/lang}</a></li>
			{/foreach}
		</ul>
	</nav>
	
	{foreach from=$__wcf->getCharacterProfileMenu()->getMenuItems() item=menuItem}
		<div id="{$menuItem->getIdentifier()}" class="container tabMenuContent" data-menu-item="{$menuItem->menuItem}">
			{if $menuItem === $__wcf->getCharacterProfileMenu()->getActiveMenuItem()}
				{@$profileContent}
			{/if}
		</div>
	{/foreach}
</section>

{include file='footer'}

</body>
</html>