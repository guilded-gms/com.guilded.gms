<ul class="dataList information">	<li><small>{@$character->level}</small></li>{* @todo style small font size with CSS *}	<li><small>{@$object->getPrimaryRace()->getTitle()}</small></li>	<li><small>{@$character->getPrimaryClass()->getTitle()}</small></li></ul>{if $character->guildID}	<ul class="dataList guild">		<li><small>{@$character->getGuild()->getTitle()}</small></li>		<li><small>{@$character->getGuild()->getServer()->getTitle()}</small></li>	</ul>{/if}