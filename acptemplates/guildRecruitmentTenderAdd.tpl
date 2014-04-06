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

			<div class="options">
				{* @todo add class *}
				{* @todo add role *}
			</div>

			{* @todo add priority *}

			<dl{if $errorField == 'amount'} class="formError"{/if}>
			    <dt><label for="amount">{lang}gms.acp.guild.recruitment.tender.amount{/lang}</label></dt>
			    <dd>
			        <input type="number" id="amount" name="amount" value="{$amount}" required="required" class="short" />
			        {if $errorField == 'amount'}
			            <small class="innerError">
			                {if $errorType == 'empty'}
			                    {lang}wcf.global.form.error.empty{/lang}
			                {else}
			                    {lang}gms.acp.guild.recruitment.tender.amount.error.{@$errorType}{/lang}
			                {/if}
			            </small>
			        {/if}
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