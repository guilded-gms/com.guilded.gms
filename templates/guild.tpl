{include file='documentHeader'}

<head>
	<title>{lang}wcf.guild.profile{/lang} - {lang}wcf.guild.guilds{/lang} - {PAGE_TITLE|language}</title>
	{include file='headInclude'}

	{event name='javascriptInclude'}
	<script type="text/javascript">
		//<![CDATA[
		$(function() {		
			new WCF.Guild.Profile.TabMenu({@$guild->guildID});
			
			WCF.TabMenu.init();
						
			{event name='javascriptInit'}
		});
		//]]>
	</script>	
</head>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{capture assign='sidebar'}
	{include file='guildSidebar'}
{/capture}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline userHeadline">
	<hgroup>
		<h1>{@$guild->getTitle()}</h1>
	</hgroup>
	
	<ul class="dataList">
		<li>{$guild->guildID}</li>
	</ul>
</header>

{include file='userNotice'}

<section id="profileContent" class="marginTop tabMenuContainer" data-active="{$__wcf->getGuildProfileMenu()->getActiveMenuItem()->getIdentifier()}">
	<nav class="tabMenu">
		<ul>
			{foreach from=$__wcf->getGuildProfileMenu()->getMenuItems() item=menuItem}
				<li><a href="{$__wcf->getAnchor($menuItem->getIdentifier())}" title="{lang}{@$menuItem->menuItem}{/lang}">{lang}wcf.guild.profile.menu.{@$menuItem->menuItem}{/lang}</a></li>
			{/foreach}
		</ul>
	</nav>
	
	{foreach from=$__wcf->getGuildProfileMenu()->getMenuItems() item=menuItem}
		<div id="{$menuItem->getIdentifier()}" class="container tabMenuContent" data-menu-item="{$menuItem->menuItem}">
			{if $menuItem === $__wcf->getGuildProfileMenu()->getActiveMenuItem()}
				{@$profileContent}
			{/if}
		</div>
	{/foreach}
</section>

{include file='footer'}

</body>
</html>