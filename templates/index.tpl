{include file='documentHeader'}

<head>
	<title>{lang}gms.header.menu.index{/lang} - {PAGE_TITLE|language}</title>
	
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

<header class="box48 boxHeadline">
	<img src="{icon size='L'}home1{/icon}" alt="" class="icon48" />
	<hgroup>
		<h1>{PAGE_TITLE|language}</h1>
		{hascontent}<h2>{content}{PAGE_DESCRIPTION|language}{/content}</h2>{/hascontent}
	</hgroup>
</header>

{include file='userNotice'}

<section id="dashboard">
	{if $__boxContent|isset}{@$__boxContent}{/if}
</section>

<div class="container marginTop shadow">
	<ul class="containerList">
		{if INDEX_ENABLE_ONLINE_LIST && $usersOnlineList->stats[total]}
			<li class="box24">
				<img src="{icon}users{/icon}" alt="" class="icon24" />
				<div>
					<hgroup class="containerHeadline">
						<h1><a href="{link controller='UsersOnlineList'}{/link}">{lang}wcf.user.usersOnline{/lang}</a> <span class="badge">{#$usersOnlineList->stats[total]}</span></h1>
						<h2>{lang}wcf.user.usersOnline.detail{/lang} {lang}wiki.index.usersOnline.record{/lang}</h2>
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
				<img src="{icon}chartVertical{/icon}" alt="" class="icon24" />
				<div>
					<hgroup class="containerHeadline">
						<h1>{lang}wiki.global.statistics{/lang}</h1>
						<h2>{lang}wiki.global.statistics.description{/lang}</h2>
					</hgroup>
				</div>
			</li>
		{/if}
	</ul>
</div>

{include file='footer'}

</body>
</html>