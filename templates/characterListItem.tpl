<li>
	<div class="box48">
		<div class="containerHeadline">
			<h3><a href="{link controller='Character' object=$character application='gms'}{/link}" title="{$character->name}">{@$character->name}{*{@$character->getPrimaryClass()->getImageTag(48)}*}</a></h3>
			{* @todo show rank (Guild Master, Officer, Raid Lead, etc.) in badge *}
		</div>

		<div class="details characterInformation">
			{include file='characterInformation'}
		</div>
	</div>
</li>