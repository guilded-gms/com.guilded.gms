{include file='header'}

<header class="boxHeadline">
	<h1>{lang}gms.acp.guild.{$action}{/lang}</h1>
</header>

{include file='formError'}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<div class="contentNavigation">
	<nav>
		<ul>
			<li><a href="{link controller='GuildList' application='gms'}{/link}" class="button"><span class="icon icon16 icon-list"></span> <span>{lang}gms.acp.guild.list{/lang}</span></a></li>
			
			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

<form method="post" action="{if $action == 'add'}{link controller='GuildAdd' application='gms'}{/link}{else}{link controller='GuildEdit' id=$object->getObjectID() application='gms'}{/link}{/if}">
	<div class="container containerPadding marginTop">
		<fieldset>
			<legend>{lang}wcf.global.form.data{/lang}</legend>
			
			{* name *}
			<dl{if $errorField == 'name'} class="formError"{/if}>
				<dt><label for="name">{lang}gms.acp.guild.name{/lang}</label></dt>
				<dd>
					<input type="text" id="name" name="name" value="{$name}" required="required" class="long" />
					{if $errorField == 'name'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}gms.acp.guild.name.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>

			{* guild *}
			<dl{if $errorField == 'gameID'} class="formError"{/if}>
				<dt><label for="gameID">{lang}gms.acp.guild.gameID{/lang}</label></dt>
				<dd>
					<select name="gameID" id="gameID">
						{foreach from=$availableGames item=gameItem}
							<option value="{$gameItem->gameID}"{if $gameID == $gameItem->gameID} selected="selected"{/if}>{$gameItem->getTitle()}</option>
						{/foreach}
					</select>
					{if $errorField == 'gameID'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}gms.acp.guild.gameID.error.{$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>
			
			{* isPublic *}
			<dl>
				<dd>
					<label for="isPublic">
						<input type="checkbox" id="isPublic" name="isPublic" value="1"{if $isPublic} checked="checked"{/if} /> {lang}gms.acp.guild.isPublic{/lang}
					</label>
				</dd>
			</dl>
			
			{event name='dataFields'}
		</fieldset>
		
		{event name='fieldsets'}
	</div>
	
	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s" />
		{@SECURITY_TOKEN_INPUT_TAG}
	</div>
</form>

{include file='footer'}