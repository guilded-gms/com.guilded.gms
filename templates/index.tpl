{include file='documentHeader'}

<head>
	<title>{lang}gms.header.menu.index{/lang} - {PAGE_TITLE|language}</title>
	
	{include file='headInclude' sandbox=false}
</head>

<body id="tpl{$templateName|ucfirst}">
{include file='header' sandbox=false}

{if $__boxSidebar|isset && $__boxSidebar}
	{capture assign='sidebar'}
		<nav id="sidebarContent" class="sidebarContent">
			<ul>
				{@$__boxSidebar}
			</ul>
		</nav>
	{/capture}
{/if}

{include file='header' sidebarOrientation='right'}

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

{include file='footer'}

</body>
</html>