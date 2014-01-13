<div class="containerPadding">
	{hascontent}
		{content}
			{include file='characterOptions' application='gms' optionTree=$options}
		{/content}
	{hascontentelse}
		{lang}gms.character.content.about.empty{/lang}
	{/hascontent}
</div>