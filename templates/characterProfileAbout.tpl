<div class="containerPadding">
	{hascontent}
		{content}
			{include file='characterOptions' optionTree=$options}
		{/content}
	{hascontentelse}
		{lang}gms.character.content.about.empty{/lang}
	{/hascontent}
</div>