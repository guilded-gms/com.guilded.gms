{include file='documentHeader'}

<head>
	<title>{lang title=$instance->getTitle()}gms.game.instance.title{/lang} - {PAGE_TITLE|language}</title>
	
	{include file='headInclude'}

    <link rel="canonical" href="{link controller='GameInstance' object=$instance application='gms'}{/link}" />
</head>

<body id="tpl{$templateName|ucfirst}">

{if $__boxSidebar|isset && $__boxSidebar}
	{capture assign='sidebar'}
		{@$__boxSidebar}
	{/capture}
{/if}

{include file='header' sidebarOrientation='right'}

<header class="boxHeadline">
	<h1><a href="{link controller='GameInstance' object=$instance application='gms'}{/link}">{$instance->getTitle()}</a></h1>
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

<section>
	{if $__boxContent|isset}{@$__boxContent}{/if}
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