/**
 * Loads character profile previews.
 * 
 * @see	WCF.Popover
 */
WCF.Character.ProfilePreview = WCF.Popover.extend({
	/**
	 * action proxy
	 * @var	WCF.Action.Proxy
	 */
	_proxy: null,
	
	/**
	 * list of user profiles
	 * @var	object
	 */
	_characterProfiles: { },
	
	/**
	 * @see	WCF.Popover.init()
	 */
	init: function() {
		this._super('.characterLink');
		
		this._proxy = new WCF.Action.Proxy({
			showLoadingOverlay: false,
		});
	},
	
	/**
	 * @see	WCF.Popover._loadContent()
	 */
	_loadContent: function() {
		var $element = $('#' + this._activeElementID);
		var $characterID = $element.data('characterID');
		
		if (this._characterProfiles[$characterID]) {
			// use cached user profile
			this._insertContent(this._activeElementID, this._characterProfiles[$characterID], true);
		}
		else {
			this._proxy.setOption('data', {
				actionName: 'getCharacterProfile',
				className: 'wcf\\data\\character\\CharacterProfileAction',
				objectIDs: [ $characterID ]
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