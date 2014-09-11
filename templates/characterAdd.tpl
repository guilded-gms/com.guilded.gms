{include file='documentHeader'}

<head>
	<title>{lang}gms.character.{@$action}{/lang} - {lang}wcf.user.menu.settings{/lang} - {PAGE_TITLE|language}</title>
	{include file='headInclude'}

	<script data-relocate="true">
		//<![CDATA[
		$(function() {
			var availableGames = { {implode from=$availableGames key=__gameID item=__game}{@$__gameID}: { title: '{$__game->getTitle()}', icon: '{@$__game->getIcon(24)}' }{/implode} };
			new GMS.Character.OptionHandler('characterName', '.optionList', availableGames, {@$gameID});
		})
		//]]>
	</script>
</head>

<body id="tpl{$templateName|ucfirst}">

{include file='userMenuSidebar'}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline">
    <h1>{lang}gms.character.{@$action}{/lang}</h1>
</header>

{include file='formError'}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<form method="post" action="{if $action == 'add'}{link controller='CharacterAdd' application='gms'}{/link}{else}{link controller='CharacterEdit' application='gms'}{/link}{/if}">
    <input type="hidden" name="gameID" value="{@$gameID}" />

	<div class="container containerPadding marginTop shadow">
		<fieldset>
			<legend>{lang}gms.character.information{/lang}</legend>
			
			<dl{if $errorField == 'characterName'} class="formError"{/if}>
				<dt><label for="characterName">{lang}gms.character.characterName{/lang}</label></dt>
				<dd>
					<input type="text" id="characterName" name="characterName" value="{$characterName}" autofocus="autofocus" class="medium" />
					{if $errorField == 'characterName'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}gms.character.characterName.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
					<small>{lang}gms.character.characterName.description{/lang}</small>
				</dd>
			</dl>
			
			{event name='fields'}
		</fieldset>
		
		{event name='fieldsets'}
	</div>

    <div class="container marginTop containerPadding optionList">
        {include file='characterOptions' application='gms'}
    </div>

	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s" />
		<input type="hidden" name="action" value="{@$action}" />
 		{if $characterID|isset}<input type="hidden" name="id" value="{@$characterID}" />{/if}
 		<input type="hidden" id="activeTabMenuItem" name="activeTabMenuItem" value="{$activeTabMenuItem}" />
 		<input type="hidden" id="activeMenuItem" name="activeMenuItem" value="{$activeMenuItem}" />
		{@SECURITY_TOKEN_INPUT_TAG}
 	</div>
</form>

{include file='footer'}

</body>
</html>