{include file='documentHeader'}

<head>
	<title>{if $__wcf->getPageMenu()->getLandingPage()->menuItem != 'gms.header.menu.index'}{lang}gms.header.menu.index{/lang} - {/if}{PAGE_TITLE|language}</title>
	
	{include file='headInclude'}

	<link rel="canonical" href="{link controller='Index' application="gms"}{/link}" />
</head>

<body id="tpl{$templateName|ucfirst}">

{if $__boxSidebar|isset && $__boxSidebar}
	{capture assign='sidebar'}
		<nav id="sidebarContent" class="sidebarContent">
			<ul>
				{@$__boxSidebar}
			</ul>
		</nav>
	{/capture}
{/if}

{include file='header'}

<header class="boxHeadline">
	{if $__wcf->getPageMenu()->getLandingPage()->menuItem == 'gms.header.menu.index'}
		<hgroup>
			<h1>{PAGE_TITLE|language}</h1>
			{hascontent}<h2>{content}{PAGE_DESCRIPTION|language}{/content}</h2>{/hascontent}
		</hgroup>
	{else}
		<hgroup>
			<h1>{lang}gms.header.menu.index{/lang}</h1>
		</hgroup>
	{/if}
</header>

{include file='userNotice'}

<section id="dashboard">
	{if $__boxContent|isset}{@$__boxContent}{/if}
</section>

{hascontent}
	<div class="container marginTop">
		<ul class="containerList infoBoxList">
			{content}
				{if GMS_INDEX_ENABLE_ONLINE_LIST}
					{include file='usersOnlineInfoBox'}
				{/if}

				{if GMS_INDEX_ENABLE_STATS}
					<li class="box32 statsInfoBox">
						<span class="icon icon32 icon-bar-chart"></span>

						<div>
							<div class="containerHeadline">
								<h3>{lang}gms.index.stats{/lang}</h3>
								<p>{lang}gms.index.stats.detail{/lang}</p>
							</div>
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