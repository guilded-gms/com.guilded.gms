{if $__wcf->user->userID}
	<!-- character menu -->
	<li id="characterMenu" class="dropdown">
		<a class="dropdownToggle" data-toggle="characterMenu">{if $__wcf->getCharacterHandler()->getPrimaryCharacter()}{@$__wcf->getCharacterHandler()->getPrimaryCharacter()->getGame()->getImageTag(24)} <span>{$__wcf->getCharacterHandler()->getPrimaryCharacter()->getTitledName()}</span>{else}<span class="icon icon16 icon-male"></span> <span>{lang}gms.character.noPrimary{/lang}</span>{/if}</a>
		<ul class="dropdownMenu characterMenu">
			{if $__wcf->getCharacterHandler()->getCharacters()|count}
				{foreach from=$__wcf->getCharacterHandler()->getCharacters() item=$character}
					<li class="pointer" data-character-id="{$character->characterID}">
						<div class="box32">
							<div>
								<a href="{link controller='Character' object=$character application='gms'}{/link}">{@$character->getGame()->getImageTag(32)}</a>
							</div>

							<div class="containerHeadline">
								{* @todo style with mouse-over (disabled) *}
								<h3><a href="{link controller='Character' object=$character application='gms'}{/link}">{$character->name}</a> <span class="icon icon16 icon-ok jsPrimaryIcon jsTooltip{if !$character->isPrimary} disabled{/if}"{if $character->isPrimary} title="{lang}gms.character.isPrimary{/lang}"{/if}></span></h3>

								{include file='characterInformation' application='gms' character=$character}
							</div>
						</div>
					</li>
				{/foreach}
				<li class="dropdownDivider"></li>
			{/if}
			<li class="characterAddLink"><a href="{link controller='CharacterAdd' application='gms'}{/link}">{lang}gms.character.add{/lang}</a></li>
		</ul>
	</li>
    <script data-relocate="true">
        //<![CDATA[
        $(function(){
            $('.jsPrimaryIcon').on('click', function(event){
				var $listItem = $(this).closest('li');
                if ($listItem.hasClass('active')) {
                    return;
                }

                new WCF.Action.Proxy({
                    autoSend: true,
                    data: {
						className: 'gms\\data\\character\\CharacterAction',
                        actionName: 'setPrimary',
                        objectIDs: [ $listItem.data('characterID') ]
                    },
                    suppressErrors: true,
                    success: $.proxy(function(data, textStatus, jqXHR) {
                        var $element = $(this).find('header > h1 > a');
                        // update menu title
                        $('#characterMenu > a > span').html($element.html());

                        // remove old icon-ok
						var $icon = $('.dropdownMenu.characterMenu > li .jsPrimaryIcon');
                        $icon.parents('li').removeClass('active');
						$icon.removeAttr('title').addClass('disabled');

						// update icon
						$(this).attr('title', '{lang}gms.character.isPrimary{/lang}').removeClass('disabled');
						$listItem.addClass('active');

						// show hint
						var notification = new WCF.System.Notification(WCF.Language.get('wcf.global.success'), 'success');
						notification.show();
                    }, this)
                });
            });
        });
        //]]>
    </script>
{/if}