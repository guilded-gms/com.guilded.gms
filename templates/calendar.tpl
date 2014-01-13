{include file='documentHeader'}

<head>
	<title>{lang title=$object->getTitle()}gms.calendar.title{/lang} - {PAGE_TITLE|language}</title>
	
	{include file='headInclude'}

	<link rel="canonical" href="{link controller='Calendar'}{/link}" />
</head>

<body id="tpl{$templateName|ucfirst}">

{if $__boxSidebar|isset && $__boxSidebar}
	{capture assign='sidebar'}
		{@$__boxSidebar}
	{/capture}
{/if}

{include file='header' sidebarOrientation='right'}

<header class="boxHeadline">
	<h1>{lang}gms.calendar.title{/lang}</h1>
</header>

{include file='userNotice'}

<div class="contentNavigation">
	{hascontent}
	<nav>
		<ul>
			{content}
				{event name='contentNavigationButtonsTop'}
			{/content}
		</ul>
	</nav>
	{/hascontent}
</div>

<section class="marginTop tabMenuContainer" data-active="{$calendarMenu->getActiveMenuItem()->getIdentifier()}">
	{assign var='menuItems' value=$calendarMenu->getMenuItems()}
	{if $menuItems|count > 1}
		<nav class="tabMenu">
			<ul>
				{foreach from=$menuItems item=menuItem}
					<li><a href="{$__wcf->getAnchor($menuItem->getIdentifier())}">{lang}gms.calendar.menu.{@$menuItem->menuItem}{/lang}</a></li>
				{/foreach}
			</ul>
		</nav>
	{/if}

	{foreach from=$menuItems item=menuItem}
		<div id="{$menuItem->getIdentifier()}" class="container tabMenuContent" data-menu-item="{$menuItem->menuItem}">
			{@$menuItem->getContent()}
		</div>
	{/foreach}
</section>

<div class="contentNavigation">
	{hascontent}
		<nav>
			<ul>
				{content}
					{event name='contentNavigationButtonsBottom'}
				{/content}
			</ul>
		</nav>
	{/hascontent}
</div>

{include file='footer'}

</body>
</html>