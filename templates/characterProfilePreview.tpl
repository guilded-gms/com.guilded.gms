<div class="box128 characterProfilePreview">
	<header>
		<h1><a href="{link controller='Character' object=$character application='gms'}{/link}" title="{$character->characterName}">{$character->characterName}</a></h1>
	</header>
	
	<div class="characterInformation">
		{include file='characterInformation' application='gms' object=$character}
	</div>
</div>