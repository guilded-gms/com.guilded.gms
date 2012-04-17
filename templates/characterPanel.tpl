{if $__wcf->user->userID}
	<!-- character menu -->
	<li id="characterMenu" class="dropdown">
		<a class="dropdownToggle" data-toggle="characterMenu">Icon Primary-Character</a>
		<ul class="dropdownMenu">
			{*
				Iterates through all characters; onClick set to primary an refresh innerHtml "charactermenu span"
			*}
			<li><a href="{link controller='Character'}{/link}" class="box48">
				<div><img src="/gms_complete/wcf/icon/wowL.png" /></div>
				
				<hgroup class="containerHeadline">
					<h1>Niridia</h1>
					<h2>85 / Mensch / Hexenmeister</h2>
					<h2>Paradoxum / Arthas</h2>
				</hgroup>
			</a></li>
			<li><a href="{link controller='Character'}{/link}" class="box48">
				<div><img src="/gms_complete/wcf/icon/wowL.png" /></div>
				
				<hgroup class="containerHeadline">
					<h1>Kivah</h1>
					<h2 style="color: #000;">85 / Mensch / Priester</h2>
					<h2>Paradoxum / Arthas</h2>
				</hgroup>
			</a></li>
			<li><a href="{link controller='Character'}{/link}" class="box48">
				<div><img src="/gms_complete/wcf/icon/riftL.png" /></div>
				
				<hgroup class="containerHeadline">
					<h1>Fayh</h1>
					<h2 style="color: #8F8FEE;">35 / Mathosianer / Krieger</h2>
					<h2>Le Guild / Tr&uuml;bkopf</h2>
				</hgroup>
			</a></li>
			<li class="dropdownDivider"></li>
			<li><a href="{link controller='CharacterEdit'}t={@SECURITY_TOKEN}{/link}" onclick="WCF.System.Confirmation.show('{lang}wcf.user.logout.sure{/lang}', $.proxy(function (action) { if (action == 'confirm') window.location.href = $(this).attr('href'); }, this)); return false;">{lang}wcf.character.manage{/lang}</a></li>
		</ul>
	</li>
{/if}