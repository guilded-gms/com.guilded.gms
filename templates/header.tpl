<a id="top"></a>
<!-- HEADER -->
<header id="pageHeader" class="pageHeader">
	<div>
		{hascontent}
			<!-- top menu -->
			<nav id="topMenu" class="topMenu">
				<div>
					<ul>
						{content}{event name='topMenu'}{/content}
					</ul>
				</div>
			</nav>
			<!-- /top menu -->
		{/hascontent}
		
		<!-- logo -->
		<div id="logo" class="logo">
			<!-- clickable area -->
			<a href="{link controller='Index'}{/link}">
				<h1>Dummy App Alpha 1</h1>
				{*<img src="{@RELATIVE_APP_DIR}images/DummyAppLogo.svg" width="256" height="64" alt="Dummy App Logo" title="Dummy App Alpha 1" />*}
			</a>
			<!-- /clickable area -->
			
			<!-- search area -->
			{event name='searchArea'}
			<!-- /search area -->
		</div>
		<!-- /logo -->
		
		<!-- main menu -->
		{include file='mainMenu'}
		<!-- /main menu -->
		
		<!-- header navigation -->
		<nav class="headerNavigation">
			<div>
				<ul>
					<li id="toBottomLink" class="toBottomLink"><a href="#bottom" title="{lang}wcf.global.scrollDown{/lang}" class="balloonTooltip"><img src="{icon size='S'}toBottom{/icon}" alt="" /> <span class="invisible">{lang}wcf.global.scrollDown{/lang}</span></a></li>
					{event name='headerNavigation'}
				</ul>
			</div>
		</nav>
		<!-- /header navigation -->
	</div>
</header>
<!-- /HEADER -->

<!-- MAIN -->
<div id="main" class="main{if $sidebarDirection|isset} {@$sidebarDirection}{/if}">
	<div>
		{if $sidebar|isset}
			<aside class="sidebar">
				{@$sidebar}
			</aside>
		{/if}
				
		<!-- CONTENT -->
		<section id="content" class="content">
			
			{include file='breadcrumbs' sandbox=false}
			