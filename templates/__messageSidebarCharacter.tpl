{* @todo make this pretty *}
{if GMS_MODULE_ROLE_PLAY && $__wcf->getCharacterHandler()->getPrimaryCharacter()}
	<div class="userCredits userCharacter">
		{$__wcf->getCharacterHandler()->getPrimaryCharacter()->getTitle()}
	</div>
{/if}