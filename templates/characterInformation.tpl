<ul class="dataList information">	<li><small>{@$character->level}</small></li>{* @todo style small font size with CSS *}	<li><small>{@$character->getPrimaryRace()->getTitle()}</small></li>	<li><small>{@$character->getPrimaryClass()->getTitle()}</small></li></ul>{if $character->guildID && $character->getGuild()}	<ul class="dataList guild">		<li><small>{@$character->getGuild()->getTitle()}</small></li>		{if $character->getGuild()->getServer()}<li><small>{@$character->getGuild()->getServer()->getTitle()}{* @todo show only status *}</small></li>{/if}	</ul>{/if}