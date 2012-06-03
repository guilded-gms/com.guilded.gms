{include file='documentHeader'}

<head>
	<title>{lang}wcf.guild.profile{/lang} - {lang}wcf.guild.guilds{/lang} - {PAGE_TITLE|language}</title>
	{include file='headInclude'}
</head>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{capture assign='sidebar'}
    <nav id="sidebarContent" class="sidebarContent">
        <ul>
            <li class="sidebarContainer">
                <dl class="statsDataList">
                    <dt>{lang}wcf.guild.members{/lang}</dt>
                    <dd>42</dd>
                    <dt>Combatants defeated</dt>
                    <dd>23</dd>

                    {event name='statistics'}
                </dl>
            </li>
        </ul>
    </nav>
{/capture}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline userHeadline">
	<hgroup>
		<h1>{$guild->guildName}</h1>
		<h2>
            <ul class="dataList">
                <li>Spiel: World of Warcraft: Mists of Pandaria</li>
                <li>Realm: Arthas</li>
            </ul>
        </h2>
	</hgroup>

	<ul id="profileButtonContainer" class="buttonList">
	</ul>
</header>

<section id="profileContent" class="marginTop tabMenuContainer">
	<nav class="tabMenu">
		<ul>
            <li><a>&Uuml;ber Paradoxum</a></li>
            <li><a>Mitglieder</a></li>
            <li><a>Fortschritt</a></li>
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
