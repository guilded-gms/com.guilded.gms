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
			<li><a href="{link controller='GuildRecruitmentTenderList' application='gms'}{/link}" class="button"><span class="icon icon16 icon-list"></span> <span>{lang}gms.acp.guild.recruitment.tender.list{/lang}</span></a></li>
			
			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

<form method="post" action="{if $action == 'add'}{link controller='GuildRecruitmentTenderAdd' application='gms'}{/link}{else}{link controller='GuildRecruitmentTenderEdit' application='gms' id=$tender->getObjectID()}{/link}{/if}">
	<div class="container containerPadding marginTop">
		<fieldset>
			<legend>{lang}wcf.global.form.data{/lang}</legend>

			<dl{if $errorField == 'guildID'} class="formError"{/if}>
				<dt><label for="guildID">{lang}gms.acp.guild.recruitment.tender.guildID{/lang}</label></dt>
				<dd>
					{htmlOptions options=$guilds selected=GMS_DEFAULT_GUILD_ID name="guildID" id="guildID"}
					{if $errorField == 'guildID'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}gms.acp.guild.recruitment.tender.guildID.error.{$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>

			<div class="options">
				{* @todo add class via JavaScript *}
				{* @todo add role via JavaScript *}
			</div>

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

			<dl>
				<dt><label for="priority">{lang}gms.acp.guild.recruitment.tender.priority{/lang}</label></dt>
				<dd>
					<label><input type="radio" value="1" name="priority"> <span class="badge green">{lang}gms.guild.recruitment.tender.priority.1{/lang}</span></label>
					<label><input type="radio" value="2" name="priority"> <span class="badge orange">{lang}gms.guild.recruitment.tender.priority.2{/lang}</span></label>
					<label><input type="radio" value="3" name="priority"> <span class="badge red">{lang}gms.guild.recruitment.tender.priority.3{/lang}</span></label>
					{if $errorField == 'priority'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}gms.acp.guild.recruitment.tender.priority.error.{@$errorType}{/lang}
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