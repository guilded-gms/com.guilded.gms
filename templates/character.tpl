{include file='documentHeader'}

<head>
	<title>{lang}wcf.character.profile{/lang} - {lang}wcf.character.characters{/lang} - {PAGE_TITLE|language}</title>
	{include file='headInclude'}
</head>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{capture assign='sidebar'}
    <nav id="sidebarContent" class="sidebarContent">
        <ul>
            <li class="sidebarContainer">
                <dl class="statsDataList">
                    {event name='statistics'}
                </dl>
            </li>
        </ul>
    </nav>
{/capture}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline userHeadline">
	<hgroup>
		<h1>{$character->characterName}</h1>
		<h2>
            <ul class="dataList">
                <li>Spiel: World of Warcraft: Mists of Pandaria</li>
                <li>Gilde: Paradoxum</li>
            </ul>
        </h2>
	</hgroup>

	<ul id="profileButtonContainer" class="buttonList">
	</ul>
</header>

<section id="profileContent" class="marginTop tabMenuContainer">
	<nav class="tabMenu">
		<ul>
            <li><a>&Uuml;ber Kivah</a></li>
            <li><a>Ausrüstung</a></li>
            <li><a>Historie</a></li>
            <li><a>Ereignisse</a></li>
		</ul>
	</nav>
    
    <div class="container tabMenuContent shadow">
        ...list options...<br/>
        ...news...
    </div>
</section>

{include file='footer'}

</body>
</html>
