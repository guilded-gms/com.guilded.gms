<div class="containerPadding">
	{foreach from=$options item=category}
		{foreach from=$category[categories] item=optionCategory}
			<fieldset>
				<legend>{lang}wcf.character.option.category.{@$optionCategory[object]->categoryName}{/lang}</legend>
				
				<dl>
					{foreach from=$optionCategory[options] item=characterOption}
						<dt>{lang}wcf.character.option.{@$characterOption[object]->optionName}{/lang}</dt>
						<dd>{@$characterOption[object]->optionValue}</dd>
					{/foreach}
				</dl>
			</fieldset>
		{/foreach}
	{/foreach}
</div>