{include file='documentHeader'}

<head>
	<title>{lang}wcf.user.menu.profile.character{/lang} - {lang}wcf.user.menu.profile{/lang} - {PAGE_TITLE|language}</title>
	
	{include file='headInclude'}
</head>

<body id="tpl{$templateName|ucfirst}">

{include file='userMenuSidebar'}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline">
    <h1>{lang}wcf.user.menu.profile{/lang}: {lang}wcf.user.menu.profile.character{/lang}</h1>
</header>

<div class="contentNavigation">
    {if $__wcf->session->getPermission('user.character.canManageCharacter')}
        <nav>
            <ul>
                <li><a href="{link controller='CharacterAdd'}{/link}" title="{lang}gms.character.add{/lang}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}gms.character.add{/lang}</span></a></li>
            </ul>
        </nav>
    {/if}
</div>

{if $games|count > 0}
	{foreach from=$games item=game}
		{hascontent}
			<header class="boxHeadline">
				<h1>{$game->getTitle()}</h1>
			</header>

			<div class="container marginTop shadow">
				<ol class="containerList characterList doubleColumned">
				{foreach from=$characters item=character}
					{if $character->gameID == $game->gameID}
						{content}
							{include file='characterListItem'}
						{/content}
					{/if}
				{/foreach}
				</ol>
			</div>
		{/hascontent}
	{/foreach}
{else}
    <p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}

{include file='footer'}

</body>
</html>