<div class="box128 characterProfilePreview">
	<header>
		<h1><a href="{link controller='Character' object=$character}{/link}" title="{$character->characterName}">{$character->characterName}</a></h1>
	</header>
	
	<div class="characterInformation">
		{include file='characterInformation' object=$character}
	</div>
</div>