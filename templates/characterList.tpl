{include file='documentHeader'}

<head>
	<title>{lang}gms.character.characters{/lang} {if $pageNo > 1}- {lang}wcf.page.pageNo{/lang} {/if}- {PAGE_TITLE|language}</title>
	{include file='headInclude' sandbox=false}
</head>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{include file='header' sidebarOrientation='right'}

<header class="boxHeadline">
    <h1>{lang}gms.character.characters{/lang} <span class="badge">{#$items}</span></h1>
</header>

{include file='userNotice'}

<div class="contentNavigation">
    {pages print=true assign=pagesLinks controller='CharacterList' link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder&letter=$encodedLetter"}
</div>

{if $items}
    <div class="container marginTop">
        <ol class="containerList doubleColumned characterList">
            {foreach from=$objects item=character}
                {include file='characterListItem'}
            {/foreach}
        </ol>
    </div>
{else}
    <p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}


<div class="contentNavigation">
    {@$pagesLinks}
</div>

{include file='footer'}

</body>
</html>
