{include file='header' pageTitle='gms.acp.guild.rank.add'}

<header class="boxHeadline">
	<h1>{lang}gms.acp.guild.rank.{$action}{/lang}</h1>
</header>

{include file='formError'}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<div class="contentNavigation">
	<nav>
		<ul>
			<li><a href="{link controller='GuildRankList' application='gms'}{/link}" class="button"><span class="icon icon16 icon-list"></span> <span>{lang}gms.acp.guild.rank.list{/lang}</span></a></li>
			
			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

<form method="post" action="{if $action == 'add'}{link controller='GuildRankAdd' application='gms'}{/link}{else}{link controller='GuildRankEdit' id=$rank->rankID application='gms'}{/link}{/if}">
	<div class="container containerPadding marginTop">
		<fieldset>
			<legend>{lang}wcf.global.form.data{/lang}</legend>

			<dl{if $errorField == 'guildID'} class="formError"{/if}>
				<dt><label for="guildID">{lang}gms.acp.guild.rank.guildID{/lang}</label></dt>
				<dd>
					{htmlOptions options=$guilds selected=DEFAULT_GUILD_ID name="guildID" id="guildID"}
					{if $errorField == 'guildID'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}gms.acp.guild.rank.guildID.error.{$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>

			<dl{if $errorField == 'name'} class="formError"{/if}>
			    <dt><label for="name">{lang}gms.acp.guild.rank.name{/lang}</label></dt>
			    <dd>
			        <input type="text" id="name" name="name" value="{$name}" required="required" class="long" />
			        {if $errorField == 'name'}
			            <small class="innerError">
			                {if $errorType == 'empty'}
			                    {lang}wcf.global.form.error.empty{/lang}
			                {else}
			                    {lang}gms.acp.guild.rank.name.error.{@$errorType}{/lang}
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