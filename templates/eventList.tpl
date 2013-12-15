{include file='documentHeader'}

<head>
	<title>{lang}wcf.event.view.{$activeView}{/lang} - {lang}gms.calendar.events{/lang} - {PAGE_TITLE|language}</title>
	{include file='headInclude' sandbox=false}
	
	<script type="text/javascript">
		//<![CDATA[
		$(function() {
			WCF.TabMenu.init();
			$('#viewContent').bind('wcftabsselect', function(event, ui){
				// \todo update title, save active view to user_table (ui.index)
			});
		});
		//]]>
	</script>	
</head>

<body{if $templateName|isset} id="tpl{$templateName|ucfirst}"{/if}>

{include file='header' sandbox=false sidebarOrientation='left'}

<header class="boxHeadline userHeadline">
	<hgroup>
		<h1>{lang}wcf.event.view.{$activeView}{/lang}</h1> {* \todo change this dynamic *}
	</hgroup>
</header>

<section id="viewContent" class="marginTop tabMenuContainer" data-active="{$activeView}">
	<nav class="tabMenu">
		<ul>
			{foreach from=$views item=view}
				<li><a href="{$__wcf->getAnchor($view->getIdentifier())}" title="{lang}wcf.event.view.{@$view->getIdentifier()}{/lang}">{lang}wcf.event.view.{@$view->getIdentifier()}{/lang}</a></li>
			{/foreach}
		</ul>
	</nav>

	{foreach from=$views item=view}
		<div id="{$view->getIdentifier()}" class="container tabMenuContent shadow" data-menu-item="{$view->getIdentifier()}">
			{@$view->getOutput()}
		</div>
	{/foreach}
</section>

{include file='footer' sandbox=false}

</body>
</html>