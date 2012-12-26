<div class="box128 guildProfilePreview">
	<hgroup>
		<h1><a href="{link controller='Guild' object=$guild}{/link}" title="{$guild->getTitle()}">{$guild->getTitle()}</a></h1>
	</hgroup>
	
	<div class="guildInformation">
		{include file='guildInformation' object=$guild}
	</div>
</div>