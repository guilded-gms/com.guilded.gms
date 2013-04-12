{include file='documentHeader'}

<head>
	<title>{if $__wcf->getPageMenu()->getLandingPage()->menuItem != 'gms.header.menu.index'}{lang}gms.header.menu.index{/lang} - {/if}{PAGE_TITLE|language}</title>
	
	{include file='headInclude' sandbox=false}
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

<div class="container marginTop shadow">
	<ul class="containerList">
		{if INDEX_ENABLE_ONLINE_LIST && $usersOnlineList->stats[total]}
			<li class="box24">
				<img src="" alt="" class="icon24" /> <!-- @todo user icon -->
				<div>
					<hgroup class="containerHeadline">
						<h1><a href="{link controller='UsersOnlineList'}{/link}">{lang}wcf.user.usersOnline{/lang}</a> <span class="badge">{#$usersOnlineList->stats[total]}</span></h1>
						<h2>{lang}wcf.user.usersOnline.detail{/lang} {lang}gms.index.usersOnline.record{/lang}</h2>
					</hgroup>
					<ul class="dataList">
						{foreach from=$usersOnlineList->getObjects() item=userOnline}
							<li><a href="{link controller='User' object=$userOnline->getDecoratedObject()}{/link}" class="userLink" data-user-id="{@$userOnline->userID}">{@$userOnline->getFormattedUsername()}</a></li>
						{/foreach}
					</ul>
					{if INDEX_ENABLE_USERS_ONLINE_LEGEND && $usersOnlineList->getUsersOnlineMarkings()|count}
						<p>{lang}wcf.user.usersOnline.marking.legend{/lang}:</p>
						<ul class="dataList">
							{foreach from=$usersOnlineList->getUsersOnlineMarkings() item=usersOnlineMarking}
								<li>{@$usersOnlineMarking}</li>
							{/foreach}
						</ul>
					{/if}
				</div>
			</li>
		{/if}
		{if INDEX_ENABLE_STATS}
			<li class="box24">
				<img src="" alt="" class="icon24" /> <!-- @todo chartVertical -->
				<div>
					<hgroup class="containerHeadline">
						<h1>{lang}gms.global.statistics{/lang}</h1>
						<h2>{lang}gms.global.statistics.description{/lang}</h2>
					</hgroup>
				</div>
			</li>
		{/if}
	</ul>
</div>

{include file='footer'}

</body>
</html>