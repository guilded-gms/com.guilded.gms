{hascontent}
	<p>{content}{@DASHBOARD_GUILD_RECRUITMENT_INTRO}{/content}</p>
{/hascontent}

{foreach from=$tenderList->getGames() item=__game}
	<div class="marginTop">
		<h2 class="boxHeadline">{@$__game->getTitle()}</h2>

		<ul class="sidebarBoxList recruitmentTenderList marginTop">
			{foreach from=$tenderList->getClasses() item=__classification}
				{if $__game->gameID== $__classification->gameID}
				<li class="box24">
					{@$__classification->getImageTag()}

					<div class="sidebarBoxHeadline">
						<h3>{@$__classification->getTitle()}</h3>

						<dl class="plain statsDataList">
							{foreach from=$tenderList item=__tender}
								{if $__tender->classificationID == $__classification->classificationID}
									<dt>{@$__tender->getRole()->getImageTag(16)} {@$__tender->getRole()->getTitle()} {@$__tender->getBadge()}</dt>
									<dd>{#$__tender->quantity}</dd>
								{/if}
							{/foreach}
						</dl>
					</div>
				</li>
				{/if}
			{/foreach}
		</ul>
	</div>
{/foreach}