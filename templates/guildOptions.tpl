<div class="containerPadding">
	{foreach from=$options item=category}
		{foreach from=$category[categories] item=optionCategory}
			<fieldset>
				<legend>{lang}wcf.guild.option.category.{@$optionCategory[object]->categoryName}{/lang}</legend>
				
				<dl>
					{foreach from=$optionCategory[options] item=guildOption}
						<dt>{lang}wcf.guild.option.{@$guildOption[object]->optionName}{/lang}</dt>
						<dd>{@$guildOption[object]->optionValue}</dd>
					{/foreach}
				</dl>
			</fieldset>
		{/foreach}
	{/foreach}
</div>