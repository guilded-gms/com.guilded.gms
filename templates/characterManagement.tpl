{include file='documentHeader'}

<head>
	<title>{lang}wcf.user.menu.profile.character{/lang} - {lang}wcf.user.menu.profile{/lang} - {PAGE_TITLE|language}</title>
	
	{include file='headInclude'}
</head>

<body id="tpl{$templateName|ucfirst}">

{include file='userMenuSidebar'}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline">
	<hgroup>
		<h1>{lang}wcf.user.menu.profile{/lang}: {lang}wcf.user.menu.profile.character{/lang}</h1>
	</hgroup>
</header>

<div class="container containerPadding marginTop shadow">
    {foreach from=$games item=game}
        {hascontent}
        <fieldset>
            <legend>{$game->getTitle()}</legend>
            <ul>
                {foreach from=$characters item=character}
                    {if $character->gameID == $game->gameID}
                        {content}
                        <li>
                            <div class="box48">
                                <hgroup class="containerHeadline">
                                    <h1><a href="{link controller='CharacterEdit' object=$character}{/link}" class="characterLink" data-character-id="{@$character->characterID}">{$character->getTitle()}</a></h1>
                                </hgroup>
                                <ul class="buttonList">
                                    <li><a class="jsTooltip" title="Edit"><img src="{icon}edit{/icon}" alt="" /></a></li>
                                    <li><a class="jsTooltip" title="Delete"><img src="{icon}delete{/icon}" alt="" /></a></li>
                                    <li><a class="jsTooltip" title="Synchronize"><img src="{icon}refresh{/icon}" alt="" /></a></li>
                                </ul>
                             </div>
                        </li>
                        {/content}
                     {/if}
                {/foreach}
            </ul>
        </fieldset>
        {/hascontent}
    {/foreach}
</div>

{include file='footer'}

</body>
</html>