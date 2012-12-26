/**
 * Namespace for WCF.Guild
*/
WCF.Guild = {};

/**
 * Loads character profile previews.
 * 
 * @see	WCF.Popover
 */
WCF.Guild.ProfilePreview = WCF.Popover.extend({
	/**
	 * action proxy
	 * @var	WCF.Action.Proxy
	 */
	_proxy: null,
	
	/**
	 * list of user profiles
	 * @var	object
	 */
	_guildProfiles: { },
	
	/**
	 * @see	WCF.Popover.init()
	 */
	init: function() {
		this._super('.guildLink');
		
		this._proxy = new WCF.Action.Proxy({
			showLoadingOverlay: false,
		});
	},
	
	/**
	 * @see	WCF.Popover._loadContent()
	 */
	_loadContent: function() {
		var $element = $('#' + this._activeElementID);
		var $guildID = $element.data('guildID');
		
		if (this._guildProfiles[$guildID]) {
			// use cached user profile
			this._insertContent(this._activeElementID, this._guildProfiles[$guildID], true);
		}
		else {
			this._proxy.setOption('data', {
				actionName: 'getGuildProfile',
				className: 'wcf\\data\\guild\\GuildProfileAction',
				objectIDs: [ $guildID ]
			});
			
			var $elementID = this._activeElementID;
			var self = this;
			this._proxy.setOption('success', function(data, textStatus, jqXHR) {
				// cache user profile
				self._characterProfiles[$characterID] = data.returnValues.template;
				
				// show user profile
				self._insertContent($elementID, data.returnValues.template, true);
			});
			this._proxy.sendRequest();
		}
	}
});
