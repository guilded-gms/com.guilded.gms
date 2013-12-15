{include file='documentHeader'}

<head>
	<title>{lang}gms.character.guilds{/lang} {if $pageNo > 1}- {lang}wcf.page.pageNo{/lang} {/if}- {PAGE_TITLE|language}</title>
	{include file='headInclude' sandbox=false}
</head>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{include file='header' sandbox=false sidebarOrientation='right'}

<header class="box48 boxHeadline">
    <h1>{lang}gms.character.guilds{/lang} <span class="badge">{#$items}</span></h1>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller='GuildList' link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
</div>

<div class="container marginTop shadow">
	<ol class="containerList guildList">
		{*
		{foreach from=$objects item=guild}
			<li>
				<div class="box48">
					<a href="{link controller='Guild' object=$guild}{/link}" title="{$guild->name}" class="framed">IMAGE</a>
						
					<div>
						
					</div>
				</div>
			</li>
		{/foreach}
		*}
	</ol>
</div>

<div class="contentNavigation">
	{@$pagesLinks}
</div>

{include file='footer' sandbox=false}

</body>
</html>