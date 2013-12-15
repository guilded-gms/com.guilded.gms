<ul class="sidebarBoxList">
	{foreach from=$serverList item=server}
		<li class="box24">
			{@$server->getStatusIcon(32)}
			
			<div class="sidebarBoxHeadline">
				<h3>{$server->getTitle()} <small>({lang}gms.game.server.type.{$server->type}{/lang})</small></h3>
				<small>{$server->getGame()->getTitle()}</small>
			</div>
		</li>
	{/foreach}
</ul>