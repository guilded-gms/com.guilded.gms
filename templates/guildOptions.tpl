{foreach from=$options item=category}
	{foreach from=$category[categories] item=optionCategory}
		<fieldset>
			<legend>{lang}gms.guild.option.category.{@$optionCategory[object]->categoryName}{/lang}</legend>

			<dl>
				{foreach from=$optionCategory[options] item=guildOption}
					<dt>{lang}gms.guild.option.{@$guildOption[object]->optionName}{/lang}</dt>
					<dd>{@$guildOption[object]->optionValue}</dd>
				{/foreach}
			</dl>
		</fieldset>
	{/foreach}
{/foreach}