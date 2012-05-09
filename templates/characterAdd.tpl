{include file='documentHeader'}

<head>
	<title>{lang}wcf.character.{@$action}{/lang} - {lang}wcf.user.menu.settings{/lang} - {PAGE_TITLE|language}</title>
	{include file='headInclude'}
	
	<script type="text/javascript">
	//<![CDATA[
	$(function() {
		var $availableGames = { {implode from=$availableGames key=gameID item=title}{@$gameID}: '{$title}'{/implode} };
		var $optionValues = { };
		new WCF.GameSelectInput('characterName', $optionValues, $availableGames);
	});
	//]]>
</script>
</head>

<body id="tpl{$templateName|ucfirst}">

{include file='userMenuSidebar'}

{include file='header' sidebarOrientation='left'}

<header class="boxHeadline">
	<hgroup>
		<h1>{lang}wcf.character.{@$action}{/lang}</h1>
	</hgroup>
</header>

{if $errorField}
	<p class="error">{lang}wcf.global.form.error{/lang}</p>
{/if}

{if $success|isset}
	<p class="success">{lang}wcf.global.form.{@$action}.success{/lang}</p>	
{/if}

<form method="post" action=" action="{if $action == 'add'}{link controller='CharacterAdd'}{/link}{else}{link controller='CharacterEdit'}{/link}{/if}">
	<div class="container containerPadding marginTop shadow">
		<fieldset>
			<legend>{lang}wcf.character.data{/lang}</legend>
			
			<dl{if $errorType.characterName|isset} class="formError"{/if}>
				<dt><label for="characterName">{lang}wcf.character.characterName{/lang}</label></dt>
				<dd>
					<input type="text" id="characterName" name="characterName" value="{$characterName}" autofocus="autofocus" class="medium" />
					{if $errorType.characterName|isset}
						<small class="innerError">
							{if $errorType.characterName == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}wcf.character.characterName.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
					<small>{lang}wcf.character.characterName.description{/lang}</small>
				</dd>
			</dl>
			
			{event name='dataFields'}
		</fieldset>
		
		{event name='fieldsets'}
		
		<div id="{@$categoryLevel1[object]->categoryName}" class="container containerPadding tabMenuContainer tabMenuContent" data-active="{$activeTabMenuItem}" data-store="activeMenuItem">					
			{foreach from=$categoryLevel1[categories] item=categoryLevel2}
				<div id="{@$categoryLevel1[object]->categoryName}-{@$categoryLevel2[object]->categoryName}" class="hidden">
					{if $categoryLevel2[options]|count}
						<fieldset>
							<legend>{lang}wcf.character.option.category.{@$categoryLevel2[object]->categoryName}{/lang}</legend>
							{hascontent}<small>{content}{lang __optional=true}wcf.character.option.category.{@$categoryLevel2[object]->categoryName}.description{/lang}{/content}</small>{/hascontent}
						
							{include file='optionFieldList' options=$categoryLevel2[options] langPrefix='wcf.character.option.'}
						</fieldset>
					{/if}
					
					{if $categoryLevel2[categories]|count}
						{foreach from=$categoryLevel2[categories] item=categoryLevel3}
							<fieldset>
								<legend>{lang}wcf.character.option.category.{@$categoryLevel3[object]->categoryName}{/lang}</legend>
								{hascontent}<small>{content}{lang __optional=true}wcf.character.option.category.{@$categoryLevel3[object]->categoryName}.description{/lang}{/content}</small>{/hascontent}
						
								{include file='optionFieldList' options=$categoryLevel3[options] langPrefix='wcf.character.option.'}
							</fieldset>
						{/foreach}
					{/if}
				</div>
			{/foreach}
		</div>
	
	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s" />
		<input type="hidden" name="action" value="{@$action}" />
 		{if $characterID|isset}<input type="hidden" name="id" value="{@$characterID}" />{/if}
 		<input type="hidden" id="activeTabMenuItem" name="activeTabMenuItem" value="{$activeTabMenuItem}" />
 		<input type="hidden" id="activeMenuItem" name="activeMenuItem" value="{$activeMenuItem}" />
 	</div>
</form>

{include file='footer'}
