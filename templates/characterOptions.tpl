{foreach from=$optionTree item=categoryLevel1}
    {foreach from=$categoryLevel1[categories] item=categoryLevel2}
        <fieldset>
            <legend>{lang}gms.character.option.category.{@$categoryLevel2[object]->categoryName}{/lang}</legend>

            {include file='characterProfileOptionFieldList' options=$categoryLevel2[options] langPrefix='gms.character.option.'}
        </fieldset>
    {/foreach}
{/foreach}