<li>
	<div class="box48">
		<div class="containerHeadline">
			<h3><a href="{link controller='Character' object=$character}{/link}" title="{$character->name}">{@$character->name}{*{@$character->getPrimaryClass()->getImageTag(48)}*}</a></h3>
		</div>

		<div class="details characterInformation">
			{include file='characterInformation'}
		</div>
	</div>
</li>