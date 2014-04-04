{include file='header' pageTitle='gms.acp.guild.recruitment.tender.add'}

<header class="boxHeadline">
	<h1>{lang}gms.acp.guild.recruitment.tender.{$action}{/lang}</h1>
</header>

{include file='formError'}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<div class="contentNavigation">
	<nav>
		<ul>
			<li><a href="{link controller='GuildRecruitmentTenderList'}{/link}" class="button"><span class="icon icon16 icon-list"></span> <span>{lang}gms.acp.guild.recruitment.tender.list{/lang}</span></a></li>
			
			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

<form method="post" action="{if $action == 'add'}{link controller='GuildRecruitmentTenderAdd'}{/link}{else}{link controller='GuildRecruitmentTenderEdit' id=$tender->getObjectID()}{/link}{/if}">
	<div class="container containerPadding marginTop">
		<fieldset>
			<legend>{lang}wcf.global.form.data{/lang}</legend>

			{htmlOptions options=$guilds selected=DEFAULT_GUILD_ID name="guildID"}

			{* @todo remove title *}
			<dl{if $errorField == 'title'} class="formError"{/if}>
			    <dt><label for="title">{lang}gms.acp.guild.recruitment.tender.title{/lang}</label></dt>
			    <dd>
			        <input type="text" id="title" name="title" value="{$title}" required="required" class="long" />
			        {if $errorField == 'title'}
			            <small class="innerError">
			                {if $errorType == 'empty'}
			                    {lang}wcf.global.form.error.empty{/lang}
			                {else}
			                    {lang}gms.acp.guild.recruitment.tender.title.error.{@$errorType}{/lang}
			                {/if}
			            </small>
			        {/if}
			    </dd>
			</dl>

			{* @todo add class *}
			{* @todo add role *}
			{* @todo add priority *}
			{* @todo add amount *}
			
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