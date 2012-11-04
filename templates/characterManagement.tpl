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

{foreach from=$games item=game}
	{hascontent}
		<header class="boxHeadline">
			<hgroup>
				<h1>{$game->getTitle()}</h1>
			</hgroup>
		</header>
		
		<div class="container marginTop shadow">
			{foreach from=$characters item=character}
				{if $character->gameID == $game->gameID}
					{content}
						<ol class="containerList userList simpleUserList">
							<li>
								<div class="box48">
									<a class="framed" title="root" href="index.php/User/1-root/"><img alt="Benutzer-Avatarbild" style="width: 48px; height: 48px" src="" /></a>
							
									<div class="userInformation">
										<hgroup class="containerHeadline">
											<h1><a href="{link controller='CharacterEdit' object=$character}{/link}" class="characterLink" data-character-id="{@$character->characterID}">{$character->getTitle()}</a></h1> 
											<h2><ul class="dataList"><li>Mitglied seit 28. September 2012</li></ul></h2>
										</hgroup>
										<ul class="buttonList">
											<li><a href="http://" class=""><img alt="" src="../wcf/icon/home.svg"></a></li>
										</ul>
										<dl class="inlineDataList">
											<dt>Likes erhalten</dt>
											<dd>0</dd>
										</dl>			
									</div>
								</div>
							</li>			
						</ol>
					{/content}
				{/if}
			{/foreach}
		</div>
	{/hascontent}
{/foreach}

{include file='footer'}

</body>
</html>