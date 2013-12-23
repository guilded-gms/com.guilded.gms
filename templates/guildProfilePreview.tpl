<div class="box128 guildProfilePreview">
	<header>
		<h1><a href="{link controller='Guild' object=$guild application='gms'}{/link}" title="{$guild->getTitle()}">{@$guild->getTitle()}</a></h1>
	</header>
	
	<div class="guildInformation">
		{include file='guildInformation' object=$guild}
	</div>
</div>