<div class="containerPadding">
	{hascontent}
		{content}
			{include file='guildOptions' application='gms' optionTree=$options}
		{/content}
	{hascontentelse}
		{lang}gms.guild.content.about.empty{/lang}
	{/hascontent}
</div>