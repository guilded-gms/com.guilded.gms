{hascontent}
	<p>{content}{@DASHBOARD_GUILD_RECRUITMENT_INTRO}{/content}</p>
{/hascontent}

<ul class="sidebarBoxList recruitmentTenderList marginTop">
	{foreach from=$tenderList->getClasses() item=classification}
		<li class="box24">
			{@$classification->getImageTag()}

			<div class="sidebarBoxHeadline">
				<h3>{@$classification->getTitle()}</h3>

				<dl class="plain statsDataList">
					{foreach from=$tenderList item=tender}
						<dt>{@$tender->getRole()->getImageTag(16)} {@$tender->getRole()->getTitle()} {@$tender->getBadge()}</dt>
						<dd>{#$tender->quantity}</dd>
					{/foreach}
				</dl>
			</div>
		</li>
	{/foreach}
</ul>