{if $__wcf->user->userID}
	<!-- character menu -->
	<li id="characterMenu" class="dropdown">
		<a class="dropdownToggle" data-toggle="characterMenu">{if $__wcf->getCharacterHandler()->getPrimaryCharacter()}{@$__wcf->getCharacterHandler()->getPrimaryCharacter()->getGame()->getImageTag(24)} <span>{$__wcf->getCharacterHandler()->getPrimaryCharacter()->getTitledName()}</span>{else}<img alt="" style="width: 24px; height: 24px" src="{$__wcf->getPath()}/images/avatars/avatar-default.svg">{* @todo change image *} <span>{lang}gms.character.noPrimary{/lang}</span>{/if}</a>
		<ul class="dropdownMenu characterMenu">
			{if $__wcf->getCharacterHandler()->getCharacters()|count}
				{foreach from=$__wcf->getCharacterHandler()->getCharacters() item=$character}
					<li class="pointer" data-character-id="{$character->characterID}">
						<div class="box32">
							<div>
								<a href="{link controller='Character' object=$character application='gms'}{/link}">{@$character->getPrimaryClass()->getImageTag(32)}</a>
							</div>

							<div class="containerHeadline">
								<h3><a href="{link controller='Character' object=$character application='gms'}{/link}">{$character->name}</a>{if $character->isPrimary} <span class="icon icon16 icon-ok jsPrimaryIcon jsTooltip" title="{lang}gms.character.isPrimary{/lang}"></span>{/if}</h3>

								{include file='characterInformation' application='gms' object=$character}
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
            $('.dropdownMenu.characterMenu > li').on('click', function(event){
                if ($(this).hasClass('active')) {
                    return;
                }

                new WCF.Action.Proxy({
                    autoSend: true,
                    data: {
						className: 'gms\\data\\character\\CharacterAction',
                        actionName: 'setPrimary',
                        objectIDs: [ $(this).data('characterID') ]
                    },
                    suppressErrors: true,
                    success: $.proxy(function(data, textStatus, jqXHR) {
                        var $element = $(this).find('header > h1 > a');
                        // update menu title
                        $('#characterMenu > a > span').html($element.html());

                        // remove old icon-ok
						var $icon = $('.dropdownMenu.characterMenu > li .jsPrimaryIcon');
                        $icon.parents('li').removeClass('active');
						$icon.remove();

						// update icon
						$(this).find('h3').append(' <span class="icon icon16 icon-ok jsPrimaryIcon jsTooltip" title="{lang}gms.character.isPrimary{/lang}"></span>');
						$(this).addClass('active');

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